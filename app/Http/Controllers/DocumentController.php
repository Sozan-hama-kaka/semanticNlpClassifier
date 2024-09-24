<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentTerm;
use App\Models\Term;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Routing\Redirector;

class DocumentController extends Controller
{
    public function documentClassification(): view
    {
        $classifications = Term::all();
        return view('documents.document_classification', compact('classifications'));
    }

    public function classifyDocument(): view
    {
        return view('documents.classify_document');
    }

    public function findSemanticSimilarity(Request $request): view
    {
        $summary = $request->input('summary');
        $method = $request->input('method');

        $client = new Client();
        $result = null;
        $errorMessage = null;

        try {
            $response = $client->request('POST', env('DEV_IP') . ":5000/compare", [
                'query' => [
                    'summary' => $summary,
                    'method' => $method
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            $results = $data;
            //dd($results);
            $termIds = [];
            foreach ($results as $result) {
                if (array_key_exists('term', $result)) {
                    $termIds[] = Term::where(['term' => $result['term']])->first()->id;
                }
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        return view('documents.classify_document', compact('results', 'termIds', 'errorMessage'));
    }

    public function saveClassification(Request $request): RedirectResponse|Redirector|Application
    {
        $termId = $request->input('termId');
        $documentAbstract = $request->input('summary');

        $document = new Document();
        $document->document_name = date('Y-m-d-His') . '_Document';
        $document->title = date('Y-m-d-His') . '_Title';
        $document->summary = $documentAbstract;

        if ($document->save()) {
            $savedDocumentId = $document->id;

            $documentTerm = new DocumentTerm();

            $documentTerm->document_id = $savedDocumentId;
            $documentTerm->term_id = $termId;
            $documentTerm->save();

            if ($documentTerm->save()) {
                return redirect('/classified-documents')->with('success', 'Document classification saved successfully.');
            }
        }
        return redirect('/classified-documents')->with('error', 'Document classification Failed');
    }

    public function viewSingleClassification(Request $request): view
    {
        $classificationId = $request->input('classification_id');
        $classificationName = $request->input('classification_name');

        $relevantDocumentTerms = DocumentTerm::where(['term_id' => $classificationId])->get();
        $documentIds = [];
        foreach ($relevantDocumentTerms as $termDocument) {
            $documentIds[] = $termDocument->document_id;
        }

        $relevantDocuments = [];

        foreach ($documentIds as $documentId) {
            $relevantDocuments[] = Document::where(['id' => $documentId])->first();
        }

        return view('documents.single_classification_documents', compact('relevantDocuments', 'classificationName'));
    }

    public function viewDocument(Request $request): view
    {
        $documentId = $request->input('document_id');
        $document = Document::where(['id' => $documentId])->first();
        $classification = DocumentTerm::join('tbl_terms', 'tbl_document_term.term_id', '=', 'tbl_terms.id')
            ->where('tbl_document_term.document_id', $documentId)
            ->select('tbl_terms.term')
            ->first()->term;
        return view('documents.view-document', compact('document','classification'));
    }
}
