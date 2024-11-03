<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentTerm;
use App\Models\Term;
use GuzzleHttp\Exception\GuzzleException;
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

    /**
     * @param Request $request
     * @return View
     * @throws GuzzleException
     */
    public function findSemanticSimilarity(Request $request): view
    {
        $summary = $request->input('summary');
        $method = $request->input('method');

        $client = new Client();
        $results = null;
        $errorMessage = null;

        try {
            // Replace 192.168.0.84 with the IP address of your Flask application
            $response = $client->request('POST', env('DEV_IP') . ":5000/compare", [
                'query' => [
                    'summary' => $summary,
                    'method' => $method,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            $results = $data;
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

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector|Application
     */
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

    /**
     * @param Request $request
     * @return View
     */
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

        return view('documents.single_classification_documents', compact('relevantDocuments', 'classificationName','classificationId'));
    }

    public function deleteSingleDocumentClassification(Request $request): RedirectResponse
    {
        $classificationId = $request->input('classification_id');
        $classificationName = $request->input('classification_name');
        $documentId = $request->input('document_id');

        $isClassificationDeleted = DocumentTerm::where(['document_id' => $documentId, 'term_id' => $classificationId])->delete();

        if ($isClassificationDeleted) {
            return redirect()->route('view-single-classification', [
                'classification_id' => $classificationId,
                'classification_name' => $classificationName
            ])->with('success', 'Classification deleted successfully.');
        } else {
            return redirect()->route('view-single-classification', [
                'classification_id' => $classificationId,
                'classification_name' => $classificationName
            ])->with('error', 'Failed to delete classification.');
        }
    }


    /**
     * @return View
     */
    public function documentStatistics(): View
    {
        $statistics = Term::withCount('documentTerms')
            ->get()
            ->groupBy('subfield');

        $subfieldStats = [];
        $totalDocuments = 0;
        foreach ($statistics as $subfield => $terms) {
            $subfieldStats[$subfield] = [
                'total_documents' => $terms->sum('document_terms_count'),
                'terms' => $terms->map(function ($term) {
                    return [
                        'term' => $term->term,
                        'document_count' => $term->document_terms_count,
                    ];
                }),
            ];
            $totalDocuments += $subfieldStats[$subfield]['total_documents'];
        }

        return view('documents.document_statistics', compact('subfieldStats', 'totalDocuments'));
    }

    /**
     * @param Request $request
     * @return View
     */
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

    public function importDocumentFromDataset()
    {
        $filePath = public_path('dataset/llm_result.csv');
        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $title = $data[0]; // First column (Title)
                $summary = $data[1]; // Second column (Summary)
                $classifications = isset($data[3]) ? explode(',', $data[3]) : []; // Third column (Classification)
                $document = new Document();
                $document->document_name = now()->timestamp . '-document'; // Unique timestamp-document name
                $document->title = $title;
                $document->summary = $summary;
                $document->save();

                foreach ($classifications as $classification) {
                    $classification = trim($classification); // Trim any extra spaces
                    $term = Term::where('term', $classification)->first();

                    if ($term) {
                        $documentTerm = new DocumentTerm();
                        $documentTerm->document_id = $document->id;
                        $documentTerm->term_id = $term->id;
                        $documentTerm->save();
                    }
                }
            }

            fclose($handle);
        }

        return "Documents and classifications have been imported successfully!";
    }

    public function performanceMetric(): view
    {
        return view('documents.performance_metric');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Delete related terms
        $document->terms()->delete(); // If terms are in a one-to-many or many-to-many relationship

        // Then delete the document
        $document->delete();

        return redirect()->back()->with('success', 'Document deleted successfully.');
    }


}
