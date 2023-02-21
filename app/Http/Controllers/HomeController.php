<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\Traits\ForModelTrait;


class HomeController extends Controller
{
    use ForModelTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        return redirect('/');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $departments=$this->showAll(Department::class);
        return view('home',compact('departments'));

    }

}

