<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentWord extends Model
{
    public $table = "document_word";
    protected $fillable = [
        'freq',
    ];

    public function document(){
        return $this->belongsTo('App\Document', 'document_id');
    }

    public function word(){
        return $this->belongsTo('App\Word', 'word_id');
    }
}
