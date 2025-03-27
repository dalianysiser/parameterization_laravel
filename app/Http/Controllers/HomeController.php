<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function index(){
        // return "hola vv";
        //::all();
        //reguest->all();
        //request->name();
        //$fieldType = FieldType::orderBy('id','desc')->paginate();
    //     return view('home');
    // }

    // public function ex(){
    //     $var ='siii';
    //     return view('ex.ex', compact('var'));
    // }

    public function index(){
        return view('home');
    }
}
