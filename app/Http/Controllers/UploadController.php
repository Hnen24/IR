<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Word;
use App\DocumentWord;
use App\Http\Controllers\PorterStemmer;
use App\Http\Controllers\textopirationController;
use \File;
use App\Stemmer;
use Illuminate\Support\Arr;

ini_set('max_execution_time', 999999);

class UploadController extends Controller
{
    public function uploadFile(Request $request)
    {

        $file = $request->file('path');
        $file->move(storage_path('app'), $file->getClientOriginalName());
        $file = storage_path('app') . "\\" . $file->getClientOriginalName();
        $docId = app('App\Http\Controllers\textopirationController')->saveDoc($file);
        $removeStop = app('App\Http\Controllers\textopirationController')->RemoveStopWord(strtolower(File::get($file)));
        //$changedText = PorterStemmer::Stem($removeStop);
        $cleanDoc = app('App\Http\Controllers\textopirationController')->changWord($removeStop);

        $arr = explode(' ', $cleanDoc);
        $arr1 = array();
        foreach ($arr as $r) {
            array_push($arr1, PorterStemmer::Stem($r));
        }
        //print_r($arr1);
        foreach ($arr1 as $term) {
            if ($term != '\n' && $term != '' && $term != '\t') {
                $term_id = app('App\Http\Controllers\textopirationController')->saveItem($term);
                app('App\Http\Controllers\textopirationController')->saveDocterm($term_id, $docId, $cleanDoc, $term);
                if (array_has(app('App\Http\Controllers\textopirationController')->term_fre_files, $term)) {
                    app('App\Http\Controllers\textopirationController')->term_fre_files[$term]++;
                } else {
                    app('App\Http\Controllers\textopirationController')->term_fre_files[$term] = 1;
                }
            }
        }

        return redirect()->back()->with('success', 'Document was uploaded successfully');
    }

    public function uploadAllFiles()
    {
        app('App\Http\Controllers\textopirationController')->test();
        $this->addWeight();
        return redirect()->back();
    }

    public function search(Request $request){
        $query =  $request->input('query');

        $result = app('App\Http\Controllers\textopirationController')->matchFun($query);
        return view('welcome', compact('result'));
    }

    public function delete(){
        return view('delete');
    }
    public function deleteAll(){
        app('App\Http\Controllers\textopirationController')->delete();
        return redirect()->back();
    }

    public function addWeight(){
        $docs = Document::all();
        foreach ($docs as $doc){
            $weight = 0;
            $dw = DocumentWord::where('document_id', $doc->id)->get();
            foreach ($dw as $d)
                $weight += $d->freq * $d->freq;
            $doc->weight = $weight;
            $doc->save();
        }
    }

}
