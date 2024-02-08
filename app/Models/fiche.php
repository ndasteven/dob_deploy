<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fiche extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom','fiche_nom','classe','type_fiche','ecole_id','dren_id','annee','remarkFiche'
    ];

    public function fiche_dren(){
        return 	$this->belongsTo(dren::class,'dren_id','id');
    }
    public function fiche_ecole(){
        return 	$this->belongsTo(ecole::class,'ecole_id','id');
    }
    public function fiche_eleve(){
        return 	$this->hasMany(eleve::class, 'fiche_id');
    }
    public function eleveS(){
        return $this->belongsToMany(eleve::class);
    }

}
