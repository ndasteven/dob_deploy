<?php

namespace App\Http\Controllers;

use App\Imports\elevesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import() 
    {
        
        Excel::import(new elevesImport, public_path('15.xlsx'));
        
        return 'success All good!';
    }
}
