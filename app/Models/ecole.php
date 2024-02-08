<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ecole extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'CODSERVs','NOMCOMPLs','GENREs','CODE_DREN'
    ];
    public function ecole_dren(){
        return $this->belongsTo(dren::class, 'CODE_DREN', 'code_dren');//CODE_DREN : cle etrangere dans ecole et code_dren est la cle primaire
    }
    public function ecole_eleve_A(){
        return $this->hasMany(eleve::class, 'ecole_A'); // tous les eleve €  ecole accueil donc ecole_A de eleves fais reference a id ecole
    }
    public function ecole_eleve_O(){
        return $this->hasMany(eleve::class, 'ecole_id'); // tous les eleve €  ecole origine donc ecole_id de eleves fais reference a id ecole
    }
    public function ecole_fiche(){
        return $this->hasMany(fiche::class); // toute les fiches appartenant a ecole
    }
}

