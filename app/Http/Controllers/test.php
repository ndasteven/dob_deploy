<?php

namespace App\Http\Controllers;

use App\Models\ecole;
use App\Models\dren;
use App\Models\eleve;
use Illuminate\Http\Request;

class test extends Controller
{
    public function index(){   
      return view('test');
    }
}
