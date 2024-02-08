<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dren extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_dren','nom_dren'
    ];
    public function dren_ecole(){
        return $this->hasMany(ecole::class,'CODE_DREN', 'code_dren');
    }
    public function dren_fiche(){
        return $this->hasMany(fiche::class);
    }
}
