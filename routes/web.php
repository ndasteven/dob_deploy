<?php

use App\Http\Controllers\test;
use App\Livewire\Admin\Admin;
use App\Livewire\DrenIndex;
use App\Livewire\EtablissementIndex;
use App\Livewire\FicheIndex;
use App\Livewire\StudentIndex;
use App\Models\ecole;
use App\Models\eleve;
use App\Models\fiche;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/phpinfo', function(){
dd(phpinfo());
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
       
       session(['shareYear' => '','shareNiveau'=>'']);// on renitialise les session au cas ou on revient à l'accueil
        return view('dashboard');
    })->name('dashboard');
});



Route::get('/student',StudentIndex::class)->name('student')->middleware('auth');
Route::get('/dren',Drenindex::class)->name('dren')->middleware('auth');
Route::get('/etablissement',EtablissementIndex::class)->name('etablissement')->middleware('auth');
Route::get('/fiche',FicheIndex::class)->name('fiche')->middleware('auth');
Route::get('/admin',Admin::class)->name('admin')->middleware('auth')->middleware('checkRole:superAdmin');//verifie si utilisateur connecter a pour role superAdmin pour pouvoir aller sur le lien /admin
Route::get('/test', [test::class, 'index'])->middleware('auth');

Route::get('/import-excel', 'App\Http\Controllers\ExcelController@import');
Route::get('pdf/{fileName}', [StudentIndex::class, 'show'])->name('pdf.show'); //route pour afficher les pdf en etant authentifier grace a la fonction show dans studentIndex

Route::fallback(function() {
    return view('errorpage'); // la vue 404.blade.php
 });


