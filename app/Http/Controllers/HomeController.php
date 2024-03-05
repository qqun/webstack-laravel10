<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Category;
use App\Models\System;

class HomeController extends Controller
{
    public function __construct()
    {
        $system = System::all();
        $system = array_build($system, function($key, $val){
            return [$val->key,$val->value];
        });
        view()->share('system', $system);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $category = Category::with(['children' => function ($query) {
            $query->orderBy('order');
        }, 'sites'])
        ->withCount('children')
        ->orderBy('order')
        ->get();

        return view('index', compact('category'));


    }

    public function about()
    {
        $category = (object)[];
        return view('about', compact('category'));
    }

}


