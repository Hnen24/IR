<?php

namespace App\Http\Controllers;

//use Storage;
use PhpParser\Node\Expr\Cast\Object_;
use Stemmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \File;
use App\Http\Controllers\PorterStemmer;
use App\Word;
use App\Document;
use App\DocumentWord;
use League\Flysystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;


ini_set('max_execution_time', 999999);

class textopirationController extends Controller
{
    public $term_fre_files;

    public function RemoveStopWord($input)
    {

        $commonWords = array('a', 'able', 'about', 'above', 'abroad', 'according', 'accordingly', 'across', 'actually', 'adj',
            'after', 'afterwards', 'again', 'against', 'ago', 'ahead', 'ain\'t', 'all', 'allow', 'allows', 'almost', 'alone',
            'along', 'alongside', 'already', 'also', 'although', 'always', 'am', 'amid', 'amidst', 'among', 'amongst', 'an',
            'and', 'another', 'any', 'anybody', 'anyhow', 'anyone', 'anything', 'anyway', 'anyways', 'anywhere', 'apart',
            'appear', 'appreciate', 'appropriate', 'are', 'aren\'t', 'around', 'as', 'a\'s', 'aside', 'ask', 'asking', 'associated', 'at', 'available', 'away', 'awfully', 'b', 'back', 'backward', 'backwards', 'be', 'became', 'because', 'become', 'becomes', 'becoming', 'been', 'before', 'beforehand', 'begin', 'behind', 'being', 'believe', 'below', 'beside', 'besides', 'best', 'better', 'between', 'beyond', 'both', 'brief', 'but', 'by', 'c', 'came', 'can', 'cannot', 'cant', 'can\'t', 'caption', 'cause', 'causes', 'certain', 'certainly', 'changes', 'clearly', 'c\'mon', 'co', 'co.', 'com', 'come', 'comes', 'concerning', 'consequently', 'consider', 'considering', 'contain', 'containing', 'contains', 'corresponding', 'could', 'couldn\'t', 'course', 'c\'s', 'currently', 'd', 'dare', 'daren\'t', 'definitely', 'described', 'despite', 'did', 'didn\'t', 'different', 'directly', 'do', 'does', 'doesn\'t', 'doing', 'done', 'don\'t', 'down', 'downwards', 'during', 'e', 'each', 'edu', 'eg', 'eight', 'eighty', 'either', 'else', 'elsewhere', 'end', 'ending', 'enough', 'entirely', 'especially', 'et', 'etc', 'even', 'ever', 'evermore', 'every', 'everybody', 'everyone', 'everything', 'everywhere', 'ex', 'exactly', 'example', 'except', 'f', 'fairly', 'far', 'farther', 'few', 'fewer', 'fifth', 'first', 'five', 'followed', 'following', 'follows', 'for', 'forever', 'former', 'formerly', 'forth', 'forward', 'found', 'four', 'from', 'further', 'furthermore', 'g', 'get', 'gets', 'getting', 'given', 'gives', 'go', 'goes', 'going', 'gone', 'got', 'gotten', 'greetings', 'h', 'had', 'hadn\'t', 'half', 'happens', 'hardly', 'has', 'hasn\'t', 'have', 'haven\'t', 'having', 'he', 'he\'d', 'he\'ll', 'hello', 'help', 'hence', 'her', 'here', 'hereafter', 'hereby', 'herein', 'here\'s', 'hereupon', 'hers', 'herself', 'he\'s', 'hi', 'him', 'himself', 'his', 'hither', 'hopefully', 'how', 'howbeit', 'however', 'hundred', 'i', 'i\'d', 'ie', 'if', 'ignored', 'i\'ll', 'i\'m', 'immediate', 'in', 'inasmuch', 'inc', 'inc.', 'indeed', 'indicate', 'indicated', 'indicates', 'inner', 'inside', 'insofar', 'instead', 'into', 'inward', 'is', 'isn\'t', 'it', 'it\'d', 'it\'ll', 'its', 'it\'s', 'itself', 'i\'ve', 'j', 'just', 'k', 'keep', 'keeps', 'kept', 'know', 'known', 'knows', 'l', 'last', 'lately', 'later', 'latter', 'latterly', 'least', 'less', 'lest', 'let', 'let\'s', 'like', 'liked', 'likely', 'likewise', 'little', 'look', 'looking', 'looks', 'low', 'lower', 'ltd', 'm', 'made', 'mainly', 'make', 'makes', 'many', 'may', 'maybe', 'mayn\'t', 'me', 'mean', 'meantime', 'meanwhile', 'merely', 'might', 'mightn\'t', 'mine', 'minus', 'miss', 'more', 'moreover', 'most', 'mostly', 'mr', 'mrs', 'much', 'must', 'mustn\'t', 'my', 'myself', 'n', 'name', 'namely', 'nd', 'near', 'nearly', 'necessary', 'need', 'needn\'t', 'needs', 'neither', 'never', 'neverf', 'neverless', 'nevertheless', 'new', 'next', 'nine', 'ninety', 'no', 'nobody', 'non', 'none', 'nonetheless', 'noone', 'no-one', 'nor', 'normally', 'not', 'nothing', 'notwithstanding', 'novel', 'now', 'nowhere', 'o', 'obviously', 'of', 'off', 'often', 'oh', 'ok', 'okay', 'old', 'on', 'once', 'one', 'ones', 'one\'s', 'only', 'onto', 'opposite', 'or', 'other', 'others', 'otherwise', 'ought', 'oughtn\'t', 'our', 'ours', 'ourselves', 'out', 'outside', 'over', 'overall', 'own', 'p', 'particular', 'particularly', 'past', 'per', 'perhaps', 'placed', 'please', 'plus', 'possible', 'presumably', 'probably', 'provided', 'provides', 'q', 'que', 'quite', 'qv', 'r', 'rather', 'rd', 're', 'really', 'reasonably', 'recent', 'recently', 'regarding', 'regardless', 'regards', 'relatively', 'respectively', 'right', 'round', 's', 'said', 'same', 'saw', 'say', 'saying', 'says', 'second', 'secondly', 'see', 'seeing', 'seem', 'seemed', 'seeming', 'seems', 'seen', 'self', 'selves', 'sensible', 'sent', 'serious', 'seriously', 'seven', 'several', 'shall', 'shan\'t', 'she', 'she\'d', 'she\'ll', 'she\'s', 'should', 'shouldn\'t', 'since', 'six', 'so', 'some', 'somebody', 'someday', 'somehow', 'someone', 'something', 'sometime', 'sometimes', 'somewhat', 'somewhere', 'soon', 'sorry', 'specified', 'specify', 'specifying', 'still', 'sub', 'such', 'sup', 'sure', 't', 'take', 'taken', 'taking', 'tell', 'tends', 'th', 'than', 'thank', 'thanks', 'thanx', 'that', 'that\'ll', 'thats', 'that\'s', 'that\'ve', 'the', 'their', 'theirs', 'them', 'themselves', 'then', 'thence', 'there', 'thereafter', 'thereby', 'there\'d', 'therefore', 'therein', 'there\'ll', 'there\'re', 'theres', 'there\'s', 'thereupon', 'there\'ve', 'these', 'they', 'they\'d', 'they\'ll', 'they\'re', 'they\'ve', 'thing', 'things', 'think', 'third', 'thirty', 'this', 'thorough', 'thoroughly', 'those', 'though', 'three', 'through', 'throughout', 'thru', 'thus', 'till', 'to', 'together', 'too', 'took', 'toward', 'towards', 'tried', 'tries', 'truly', 'try', 'trying', 't\'s', 'twice', 'two', 'u', 'un', 'under', 'underneath', 'undoing', 'unfortunately', 'unless', 'unlike', 'unlikely', 'until', 'unto', 'up', 'upon', 'upwards', 'us', 'use', 'used', 'useful', 'uses', 'using', 'usually', 'v', 'value', 'various', 'versus', 'very', 'via', 'viz', 'vs', 'w', 'want', 'wants', 'was', 'wasn\'t', 'way', 'we', 'we\'d', 'welcome', 'well', 'we\'ll', 'went', 'were', 'we\'re', 'weren\'t', 'we\'ve', 'what', 'whatever', 'what\'ll', 'what\'s', 'what\'ve', 'when', 'whence', 'whenever', 'where', 'whereafter', 'whereas', 'whereby', 'wherein', 'where\'s', 'whereupon', 'wherever', 'whether', 'which', 'whichever', 'while', 'whilst', 'whither', 'who', 'who\'d', 'whoever', 'whole', 'who\'ll', 'whom', 'whomever', 'who\'s', 'whose', 'why', 'will', 'willing', 'wish', 'with', 'within', 'without', 'wonder', 'won\'t', 'would', 'wouldn\'t', 'x', 'y', 'yes', 'yet', 'you', 'you\'d', 'you\'ll', 'your', 'you\'re', 'yours', 'yourself', 'yourselves', 'you\'ve', 'z', 'zero');

        $ss = preg_replace('/\b(' . implode('|', $commonWords) . ')\b/', '', $input);
        $unwantedChars = array(',', '!', '?', '.', '#', '@', '^', '*', '(', ')', '_', '-', '--', '/'); // create array with unwanted chars
        $hello = str_replace($unwantedChars, ' ', $ss); // remove them
        return $hello;
    }

    public function changWord($input)
    {
        $search = array('jan', 'feb', 'mar', 'apr', 'may', 'june', 'july', 'aug', 'sept', 'oct', 'nov', 'dec', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
        $replace = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $result = str_replace($search, $replace, $input);
        return $result;
    }

    public function isExist($term)
    {
        $Terms = Word::where('word', '=', $term)->first();
        if ($Terms) {
            return $Terms->id;
        }
    }

    public function saveItem($term)
    {
        $exist = $this->isExist($term);
        if ($exist) {
            return $exist;
        } else {
            $t = new Word();
            $t->word = $term;
            $t->save();
            return $t->id;
        }
    }

    public function saveDoc($file)
    {
        $doc = new Document();
        $doc->path = $file;
        $doc->weight = 0;
        $doc->save();
        return $doc->id;
    }

    public function saveDocterm($term_id, $doc_id, $cleanDoc, $docterm)
    {
        $t = new DocumentWord();
        $t->document_id = $doc_id;
        $t->word_id = $term_id;
        $arr = explode(' ', $cleanDoc);
        $counter = 0;
        foreach (array_filter($arr) as $term) {
            if ($term == $docterm) {
                $counter += 1;
            }
        }
        $tf = $counter / sizeof(array_filter($arr));
        $t->freq = $tf;
        $t->save();
        return $t->id;
    }

    public function test()
    {
        $files = glob('C:\wamp\www\IR\public\app\*');

        foreach ($files as $file) {

            $docId = $this->saveDoc($file);
            $removeStop = $this->RemoveStopWord(strtolower(File::get($file)));
            // $changedText = app('App\Http\Controllers\PorterStemmer')::Stem($removeStop);
             $cleanDoc = $this->changWord($removeStop);

            $arr = explode(' ', $cleanDoc);
            $arr1 = array();
            foreach ($arr as $r) {
                array_push($arr1, PorterStemmer::Stem($r));
            }
            foreach ($arr1 as $term) {
                if ($term != '\n' && $term != '' && $term != '\t') {
                    $term_id = $this->saveItem($term);
                    $this->saveDocterm($term_id, $docId, $cleanDoc, $term);

                    if (array_has($this->term_fre_files, $term)) {
                        $this->term_fre_files[$term]++;
                    } else {
                        $done = true;
                        $this->term_fre_files[$term] = 1;
                    }
                }
            }
        }
    }

    public function documents_with_term($termId)
    {
        $files = DB::table('item_docs')->where('term_id', '=', $termId)->distinct()->get(['doc_id'])->count();
        // $files = term_doc::all()->where('term_id','=',$termId)->count();
        return $files;
    }

    public function tfidf()
    {
        echo "start << wait\n\n\n\n\n\n\n\n";
        $files = term_doc::all();
        echo "term_doc\n\n\n\n\n\n\n\n";
        $total_document_count = doc::all()->count();
        echo "total_document_count\n\n\n\n\n\n\n\n";

        foreach ($files as $termDoc) {
//            $res = $this->documents_with_term($termDoc->term_id);
            /* $arr1 = array();
             $arr = array();
             foreach ($files as $file)
             {
                 if ($file->term_id == $termDoc->term_id){
                     array_push($arr,$termDoc->id);
                 }
             }*/
//           $ss= sizeof(array_unique($arr));
            $rr = DB::table('terms')->where('id', '=', $termDoc->term_id)->first();
            $termDoc->weight = $termDoc->tf * log($total_document_count /$this->term_fre_files[

                    $rr->name

                    ] , 2);
//            echo $res ;
            $termDoc->indexflag = 1;
            $termDoc->save();
        }

        echo "\n\n";
        print_r( $this->term_fre_files);


    }

    public function tall()
    {
        $files = doc::all();

        foreach ($files as $Doc) {
            $terms = term_doc::where('doc_id', '=', $Doc->id)->where('weight', '>', '0')->get();
            $cost = 0;
            foreach ($terms as $term) {
                // $tt = term_doc::find($term->id);
                $cost += $term->weight * $term->weight;

            }
            $tt = doc::find($Doc->id);
            $tt->tall = $cost;
            $tt->save();
        }
    }



    public function matchFun($quary)
    {
        $docs = Document::all();
        $removeStop = $this->RemoveStopWord(strtolower($quary));
        $changedText = $this->changWord($removeStop);
        //$cleanDoc = app('App\Http\Controllers\PorterStemmer')::Stem($changedText);
        $arr = explode(' ', $changedText);
        $arr1 = array();
        foreach ($arr as $r) {

            array_push($arr1, PorterStemmer::Stem($r));
        }
        //return array_filter($arr);
        $cost = 0;
        // $cost += $tf* $tf;
        //$arr = $this->wordnet(array_filter($arr1));
//dd(array_filter($arr));
        foreach (array_filter($arr1) as $t) {
            $tf = substr_count(implode($arr1, ' '), $t) / sizeof(array_filter($arr1));
            $cost += $tf * $tf;
        }
        //echo  $cost;
        $result = array();
        foreach ($docs as $doc) {
            if($doc->weight > 0) {
                $cosin = $this->match($doc->id, $doc->weight, $cost, implode($arr1, ' '));
                if ($cosin > 0.1) {
                    $a = new \stdClass();
                    $a->path = $doc->path;
                    $a->cosin = $cosin;
                    array_push($result, $a);
                }
            }
        }

        return $result;
    }



    private function match($doc, $tall, $cost, $quary)
    {

        $cosin = $this->getQD($doc, $quary) / (sqrt($cost) * sqrt($tall));
        return $cosin;
    }

    public function getQD($doc_id, $quary)
    {
        $arr = explode(' ', $quary);
        $docs = DocumentWord::where('document_id', '=', $doc_id)->where('freq', '<>', 0)->get();
        $total = 0;
        foreach (array_filter($arr) as $t) {
            foreach ($docs as $d) {
                if ($t == $d->word->word) {
                    $total += $d->freq * $this->tf($quary, $t);
                }
            }
        }
        return $total;
    }

    private function tf($cleanQuary, $term)
    {
        $arr = explode(' ', $cleanQuary);
        $tf = substr_count($cleanQuary, $term) / sizeof(array_filter($arr));


        return $tf;
    }

    public function delete()
    {
        Document::truncate();
        DocumentWord::truncate();
        Word::truncate();

    }

    public function wordnet($ss)
    {
        $a = array();
        foreach ($ss as $s) {
            $cards = DB::select("select words.lemma from synsets join (select synsets.synsetid, synsets.definition from words join senses on words.wordid=senses.wordid join synsets on synsets.synsetid=senses.synsetid where words.lemma='$s' ) as syns on syns.synsetid=synsets.synsetid join senses on synsets.synsetid=senses.synsetid join words on senses.wordid=words.wordid order by words.lemma;");
            foreach ($cards as $card) {
                // array_push($a,DB::select("select words.lemma from synsets join (select synsets.synsetid, synsets.definition from words join senses on words.wordid=senses.wordid join synsets on synsets.synsetid=senses.synsetid where words.lemma='$card' ) as syns on syns.synsetid=synsets.synsetid join senses on synsets.synsetid=senses.synsetid join words on senses.wordid=words.wordid order by words.lemma;"));
                array_push($a, $card->lemma);
            }
            //array_merge($a,DB::select("select words.lemma from synsets join (select synsets.synsetid, synsets.definition from words join senses on words.wordid=senses.wordid join synsets on synsets.synsetid=senses.synsetid where words.lemma='$s' ) as syns on syns.synsetid=synsets.synsetid join senses on synsets.synsetid=senses.synsetid join words on senses.wordid=words.wordid order by words.lemma;"));
        }
        //  $cards = DB::select("select words.lemma from synsets join (select synsets.synsetid, synsets.definition from words join senses on words.wordid=senses.wordid join synsets on synsets.synsetid=senses.synsetid where words.lemma='$ss' ) as syns on syns.synsetid=synsets.synsetid join senses on synsets.synsetid=senses.synsetid join words on senses.wordid=words.wordid order by words.lemma;");
        return array_unique($a);
    }


}

