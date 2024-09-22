<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Term;
//use Illuminate\Contracts\View\View;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;
//use GuzzleHttp\Client;
//
//class DocumentController extends Controller
//{
//    public function documentClassification(): view
//    {
//        $classifications = Term::all();
//        return view('documents.document_classification',compact('classifications'));
//    }
//
//    public function classifyDocument(): view
//    {
//        return view('documents.classify_document');
//    }
//
//    public function findSemanticSimilarity(Request $request): JsonResponse
//    {
//        $summary = $request->input('summary');
//        $method = $request->input('method');
//
//        $client = new Client();
//
//        try {
//            // Replace 172.24.95.247 with the IP address of your Flask application
//            $response = $client->request('POST', "http://192.168.0.84:5000/compare", [
//                'query' => [
//                    'summary' => $summary,
//                    'method' => $method
//                ],
//            ]);
//
//            $data = json_decode($response->getBody()->getContents(), true);
//
//            // Process $data as needed
//            return response()->json($data);
//        } catch (\Exception $e) {
//            // Handle any errors or exceptions
//            return response()->json(['error' => $e->getMessage()], 500);
//        }
//    }
//}
//
//
//
//


namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentTerm;
use App\Models\Term;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
            // Replace 192.168.0.84 with the IP address of your Flask application
            $response = $client->request('POST', "http://192.168.0.84:5000/compare", [
                'query' => [
                    'summary' => $summary,
                    'method' => $method
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            // Store the result data to pass to the view
            $results = $data; // Assuming $data contains the classification or similarity result
            $termIds = [];
            foreach ($results as $result) {
                if(array_key_exists('term', $result)) {
                    $termIds[] = Term::where(['term' => $result['term']])->first()->id;
                }
            }
        } catch (\Exception $e) {
            // If an error occurs, set the error message to be displayed
            $errorMessage = $e->getMessage();
        }

        // Pass the result or error message back to the Blade view
        return view('documents.classify_document', compact('results','termIds', 'errorMessage'));
    }

    public function saveClassification(Request $request)
    {
        $termId = $request->input('termId');
        $documentAbstract = $request->input('summary');

        $document = new Document();
        $document->document_name = 'Document-001';
        $document->title = 'test Title-001';
        $document->summary = $documentAbstract;

        if($document->save()) {
            $savedDocumentId = $document->id;

            $documentTerm = new DocumentTerm();

            $documentTerm->document_id = $savedDocumentId;
            $documentTerm->term_id = $termId;
            $documentTerm->save();

        }

    }
}
