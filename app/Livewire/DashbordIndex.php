<?php

namespace App\Livewire;

use App\Models\ecole;
use App\Models\eleve;
use App\Models\fiche;
use Livewire\Component;

class DashbordIndex extends Component
{
    public $eleve6eme= 0;
    public $eleve2nde= 0;
    public $ecole=0; 
    public $fiche=0; 
    public $yearsearch="";
    public $eleve6emeRea;
    public $eleve2nderea;
    public $eleve6emeOmi;
    public $eleve2ndeOmi;
    public $eleve6emePermu;
    public $eleve2ndeReo;
    public $ficheRea;
    public $ficheOmi;
    public $fichePermu;
    

    public function changeYear(){
        $this->yearsearch= $this->yearsearch;
        $this->eleve6eme = eleve::where('annee', $this->yearsearch)->where('classe', '6eme')->count();   
        $this->eleve2nde = eleve::where('annee', $this->yearsearch)->where('classe', '2nde')->count();  
        $this->ecole = ecole::count();
        $this->ficheRea = fiche::where('annee', $this->yearsearch)->where('type_fiche', 'reaffectation')->count();
        $this->ficheOmi = fiche::where('annee', $this->yearsearch)->where('type_fiche', 'omission')->count();
        $this->fichePermu = fiche::where('annee', $this->yearsearch)->where('type_fiche', 'permutation')->count();
        $this->fiche = fiche::where('annee', $this->yearsearch)->count();
        //selectionne les eleve en reaffectation une annee donnee
        $this->eleve6emeRea = eleve::wherehas('eleve_fiche', function($query){
            $query->where('type_fiche', 'reaffectation');
        })->where('classe', '6eme')->where('annee', $this->yearsearch)->count();
        
        $this->eleve2nderea = eleve::wherehas('eleve_fiche', function($query){//permet de selectionner l'élève et la relation de fiche avec eleve qui est eleve_fiche et faire un where sur les propriete de la fiche aussi
            $query->where('type_fiche', 'reaffectation');
        })->where('classe', '2nde')->where('annee', $this->yearsearch)->count();

        //selectionne les eleve en omission toute annees
        $this->eleve6emeOmi = eleve::wherehas('eleve_fiche', function($query){
            $query->where('type_fiche', 'omission');
        })->where('classe', '6eme')->where('annee', $this->yearsearch)->count();
        
        $this->eleve2ndeOmi = eleve::wherehas('eleve_fiche', function($query){
            $query->where('type_fiche', 'omission');
        })->where('classe', '2nde')->where('annee', $this->yearsearch)->count();

        //selectionne les eleve en 6eme en permutation  annees donnee
        $this->eleve6emePermu = eleve::wherehas('eleve_fiche', function($query){
            $query->where('type_fiche', 'permutation');
        })->where('classe', '6eme')->where('annee', $this->yearsearch)->count();
        
        //selectionne les eleve en 2nde en reorientation une annee donnee
        $this->eleve2ndeReo = eleve::wherehas('eleve_fiche', function($query){
            $query->where('type_fiche', 'reorientation');
        })->where('classe', '2nde')->where('annee', $this->yearsearch)->count();
    }
    
   public function goStudent($niveau){
    session(['shareYear' => $this->yearsearch,'shareNiveau'=>$niveau]);
    
    return redirect()->route('student');
   }
   public function goFiche(){
    session(['shareYear' => $this->yearsearch]);
    
    return redirect()->route('fiche');
   }

    public function render()
    {
        if($this->yearsearch==""){
            
            $this->eleve6eme = eleve::where('classe', '6eme')->count();
            $this->eleve2nde = eleve::where('classe', '2nde')->count();
            $this->ecole = ecole::count();
            
            //selectionne les eleve en reaffectation toute annees
            $this->eleve6emeRea = eleve::wherehas('eleve_fiche', function($query){
                $query->where('type_fiche', 'reaffectation');
            })->where('classe', '6eme')->count();
            
            $this->eleve2nderea = eleve::wherehas('eleve_fiche', function($query){
                $query->where('type_fiche', 'reaffectation');
            })->where('classe', '2nde')->count();
            //selectionne les eleve en omission toute annees
            $this->eleve6emeOmi = eleve::wherehas('eleve_fiche', function($query){
                $query->where('type_fiche', 'omission');
            })->where('classe', '6eme')->count();
            
            $this->eleve2ndeOmi = eleve::wherehas('eleve_fiche', function($query){
                $query->where('type_fiche', 'omission');
            })->where('classe', '2nde')->count();

            //selectionne les eleve en 6eme en permutation toute annees
        $this->eleve6emePermu = eleve::wherehas('eleve_fiche', function($query){
            $query->where('type_fiche', 'permutation');
        })->where('classe', '6eme')->count();
        
        //selectionne les eleve en 2nde en reorientation toute annees
        $this->eleve2ndeReo = eleve::wherehas('eleve_fiche', function($query){
            $query->where('type_fiche', 'reorientation');
        })->where('classe', '2nde')->count();

            $this->fiche = fiche::count();
            $this->ficheRea = fiche::where('type_fiche', 'reaffectation')->count();
            $this->ficheOmi = fiche::where('type_fiche', 'omission')->count();
            $this->fichePermu = fiche::where('type_fiche', 'permutation')->count();
        }

        $tableArray=['nombre_eleve6eme'=>$this->eleve6eme,
        'nombre_eleve2nde'=>$this->eleve2nde,
        'nombre_ecole'=>$this->ecole,
        'nombre_fiche'=>$this->fiche,
        'nombre_ficheRea'=>$this->ficheRea,
        'nombre_ficheOmi'=>$this->ficheOmi,
        'nombre_fichePermu'=>$this->fichePermu,
        'nombre_rea6eme'=>$this->eleve6emeRea,
        'nombre_rea2nde'=>$this->eleve2nderea,
        'nombre_Omi6eme'=>$this->eleve6emeOmi,
        'nombre_Omi2nde'=>$this->eleve2ndeOmi,
        'nombre_Permu6eme'=>$this->eleve6emePermu,
        'nombre_Reo2nde'=>$this->eleve2ndeReo
        ];
        
        return view('livewire.dashbord-index', $tableArray);
    }
}
