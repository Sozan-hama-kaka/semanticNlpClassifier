<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function documentClassification()
    {
        $classifications = Term::all();
        return view('documents.document_classification',compact('classifications'));
    }
}
