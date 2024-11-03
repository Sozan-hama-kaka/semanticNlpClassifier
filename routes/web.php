<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DocumentController::class, 'documentStatistics']);
Route::get('/document-statistics', [DocumentController::class, 'documentStatistics']);

Route::get('/classified-documents', [DocumentController::class, 'documentClassification']);
Route::get('/classify-document', [DocumentController::class, 'classifyDocument']);
Route::get('//performance-metric', [DocumentController::class, 'performanceMetric']);
Route::post('/findSemanticSimilarity', [DocumentController::class, 'findSemanticSimilarity']);
Route::post('/save-classification', [DocumentController::class, 'saveClassification']);
Route::get('/view-single-classification', [DocumentController::class, 'viewSingleClassification'])->name('view-single-classification');
Route::post('/view-single-classification', [DocumentController::class, 'viewSingleClassification']);
Route::post('/view-document',[DocumentController::class,'viewDocument']);
Route::get('/import-document-from-dataset',[DocumentController::class,'importDocumentFromDataset']);
Route::post('/delete-single-classification',[DocumentController::class,'deleteSingleDocumentClassification']);



