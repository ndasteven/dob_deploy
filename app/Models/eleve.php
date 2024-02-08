<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule','nom','prenom','genre','dateNaissance','ecole_id','classe','serie','ecole_A','fiche_id','annee','ecole_origine'
    ];

    public function eleve_ecole_O() {
        return $this->belongsTo(ecole::class, 'ecole_id', 'id');
    }
    public function eleve_ecole_A() {
        return $this->belongsTo(ecole::class, 'ecole_A', 'id');
    }
    public function eleve_fiche() {
        return $this->belongsTo(fiche::class, 'fiche_id', 'id');
    }
    public function ficheS(){
        return $this->belongsToMany(fiche::class);
    }
}
