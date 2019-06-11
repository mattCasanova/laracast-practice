<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    function home() {
        $tasks = [
            'Go to the Store',
            'Go to the market',
            'Go to Work'
        ];
    
        return view('welcome', [
            'tasks' => $tasks
        ]);
    }

    function about() {
        return view('about');
    }

    function contact() {
        return view('contact');
    }
}
