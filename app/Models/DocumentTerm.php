<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTerm extends Model
{
    use HasFactory;
    protected $fillable = ['document_id','term_id'];
    protected $table = 'tbl_document_term';
}
