<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('documents.document_statistics');
});


Route::get('/classified-documents',[DocumentController::class,'documentClassification']);
Route::get('/classify-document',[DocumentController::class,'classifyDocument']);
Route::post('/findSemanticSimilarity', [DocumentController::class, 'findSemanticSimilarity']);
Route::post('/save-classification', [DocumentController::class, 'saveClassification']);
Route::post('/view-single-classification', [DocumentController::class, 'viewSingleClassification']);


Route::get('/document-statistics', [DocumentController::class, 'documentStatistics']);

