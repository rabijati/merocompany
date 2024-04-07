<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function __construct(){

    }

    public function index(){
        //posts->comment
        $posts=Post::all();
        
        return view('index',[
            'posts'=>$posts,
        ]);

    }
}
