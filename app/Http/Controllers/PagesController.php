<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
       # return "A way of working with controllers";
       $title = "Web Development Blog";
       #return view('pages.index', compact('title'));
       return view('pages.index')->with('title',$title);#passing multiple parameters to a a view from a controler

    }
    public function services(){
        $title = "Services Page";
        $data = array(
            'title'=>$title,
            'services'=>[
                'Web Design','Android Development', 'Machine Learning','Coding Events'
            ]
        );
        return view('pages.services')->with($data);
    }
    
    public function about(){
        $title = "About Page";
        return view('pages.about')->with('title', $title);
    }

    public function team(){
        $title = "Our Awesome Team";
        return view('pages.team')->with('title', $title);
    }

    public function contact(){
        $title = "Contact Page";
        return view('pages.contact')->with('title', $title);
    }

    public function footer(){
        return view('includes.footer');
    }
}
