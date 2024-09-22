<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['document_name','title','summary'];
    protected $table = 'tbl_documents';
}
