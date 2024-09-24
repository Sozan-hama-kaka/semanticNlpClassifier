<?php

//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
//class Term extends Model
//{
//    use HasFactory;
//    protected $fillable = ['term','description'];
//    protected $table = 'tbl_terms';
//}

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    // Allow mass assignment for the 'term', 'description', and 'subfield'
    protected $fillable = ['term', 'description', 'subfield'];

    protected $table = 'tbl_terms';

    // Relationship with DocumentTerm
    public function documentTerms()
    {
        return $this->hasMany(DocumentTerm::class, 'term_id');
    }
}
