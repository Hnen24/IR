<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $table = "documents";
    protected $fillable = [
        'path', 'weight',
    ];

    public function document_words(){
        return $this->hasMany('App\DocumentWord', 'document_id');
    }
}
