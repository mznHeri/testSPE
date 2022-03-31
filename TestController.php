<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class TestController extends Controller
{


    public function apites1(Request $request)
    {
        $your_val = 111; // set your val
        if($request->val != '') $your_val = $request->val; // from request
        dd(self::narcissistic($your_val));
    }

    public function narcissistic($value ='')
    {
        if($value){
            $lenght = strlen($value);
            $re = '/(.)/m';
            $sum = 0;
            preg_match_all($re, $value, $matches);
            foreach($matches as $vnal){
                $sum += pow((int)$vnal[1], $lenght);
            } 
            return $sum == $value;
        }
    }


    public function apites2(Request $request)
    {
        $your_val = [11, 13, 15, 19, 9, 13, -21];
        dd(self::find_outlier($your_val));
    }

    public function find_outlier($data = array()){
        $odds = $evens = [];
        foreach($data as $val) {
            if ($val % 2 > 0) array_push($odds, $val);
            if ($val % 2 == 0) array_push($evens, $val);
        }

        if (count($evens) > count($odds)) return $odds[0]." (the only odd number)";
        else {
            if(isset($evens[0])) return $evens[0]." (the only even number)";
            else return "false (all odd integer, no outlier)";
        }
    }

    public function apites3(Request $request)
    {
        $your_val = ['red', 'blue', 'yellow', 'black', 'grey'];
        $needle = 'yellow';
        dd(self::findNeedle($your_val, $needle)); // return index
    }


    public function findNeedle($haystack, $neddle){
        $re = '/(.)+":"'.$neddle.'"/m';
        preg_match_all($re, json_encode($haystack, JSON_FORCE_OBJECT), $matches);
        if(isset($matches[1][0]))
            return $matches[1][0];
    }


    public function apites4(Request $request)
    {
        $your_val = [1,2,3,4,6,10];
        $needle = [4];
        dd(self::blueOcean($your_val, $needle));
    }


    public function blueOcean($haystack, $neddle){
        foreach($neddle as $key => $n) {
            if(array_search($n, $haystack)) unset($haystack[array_search($n, $haystack)]);
        }

        return $haystack;
    }
        
}
