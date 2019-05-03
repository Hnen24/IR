<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public $table = "words";
    protected $fillable = [
        'word',
    ];

    public function document_words(){
        return $this->hasMany('App\DocumentWord', 'word_id');
    }
}
