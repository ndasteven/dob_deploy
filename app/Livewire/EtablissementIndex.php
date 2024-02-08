<?php

namespace App\Livewire;

use App\Models\dren;
use App\Models\ecole;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class EtablissementIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $CODSERVs, $NOMCOMPLs, $GENREs, $CODE_DREN;
    public $search;
    public $icon;
    public $idecole;
    public $ecoleInfo;
    public $nbre2nde = 0;
    public $nbre6eme = 0;
    public $serieA=0;
    public $serieC=0;
    public $serieG1=0;
    public $serieG2=0;
    public $serieF1=0;
    public $serieF2=0;
    public $affectation=0;
    public $change_ordre=0;
    public $change_serie=0;
    public $omission=0;
    public $orientation=0;
    public $permutation=0;
    public $reaffectation=0;
    public $reorientation=0;
    public $ide;
    public $creer,$edit;

    private function resetInput(){
        $this->CODSERVs=$this->NOMCOMPLs=$this->GENREs=$this->CODE_DREN='';
    }
    public function create(){
        $this->creer = true;
        $this->edit = false;
        $this->resetInput();
    }
    protected $queryString = [
        'search'=> ['except'=>''],
        'orderField'=> ['except'=>'title'],
        'oderDirection'=> ['except'=>'ASC']
         ];
    public function research(){
        $this->search = $this->search; 
    }
    public function close(){
        $this->ecoleInfo="";
        $this->creer = false;
        $this->edit = false;
    }
    public function ecoleinfo(){
        $this->ecoleInfo=ecole::with('ecole_dren')->with('ecole_eleve_A')->with('ecole_fiche')->where('ecoles.id', $this->idecole)->get();
        if($this->ecoleInfo[0]["ecole_eleve_A"]){ //script pour avoir le nombre sur les different item
            foreach($this->ecoleInfo[0]["ecole_eleve_A"] as $iteme ) {
                if($iteme['classe']=="6eme"){
                    $this->nbre6eme++;
                }
                if($iteme['classe']=="2nde"){
                    $this->nbre2nde++;
                }
                if($iteme['serie']=="A"){
                    $this->serieA++;
                }
                
                if($iteme['serie']=="C"){
                    $this->serieC++;
                }
                if($iteme['serie']=="G1"){
                    $this->serieG1++;
                }
                if($iteme['serie']=="G2"){
                    $this->serieG2++;
                }
                if($iteme['serie']=="F1"){
                    $this->serieF1++;
                }
                if($iteme['serie']=="F2"){
                    $this->serieF2++;
                }
            }
            
        } 

        if($this->ecoleInfo[0]["ecole_fiche"]){
            foreach ($this->ecoleInfo[0]["ecole_fiche"] as $item) {
                if($item['type_fiche']=="affectation"){
                    $this->affectation++;
                }
                if($item['type_fiche']=="changement_ordre"){
                    $this->change_ordre;
                }
                if($item['type_fiche']=="changement_serie"){
                    $this->change_serie++;
                }
                if($item['type_fiche']=="omission"){
                    $this->omission++;
                }
                if($item['type_fiche']=="orientation"){
                    $this->orientation++;
                }
                if($item['type_fiche']=="permutation"){
                    $this->permutation++;
                }
                if($item['type_fiche']=="reaffectation"){
                    $this->reaffectation++;
                }
                if($item['type_fiche']=="reorientation"){
                    $this->reorientation++;
                }
            }
        }
    }
    public function closeSchool(){
        $this->ecoleInfo="";
        $this->nbre2nde =$this->nbre6eme=$this->serieA=$this->serieC=$this->serieG1=$this->serieG2=$this->serieF1=$this->serieF2=0;
        $this->affectation=$this->change_ordre=$this->change_serie=$this->omission=$this->orientation=$this->permutation=$this->reaffectation=$this->reorientation=0;
    }
    public string $orderField= 'NOMCOMPLs';
    public string $orderDirection = 'ASC';



    public function storeEtablissement(){

        $validate = $this->validate([
            'CODSERVs'=>'required|min:6',
            'NOMCOMPLs'=>'required|min:3', 
            'GENREs'=>'required|min:1',
            'CODE_DREN'=>'required:min:1|integer',    
        ]);
 
        if(!ecole::where('CODSERVs', $this->CODSERVs)->exists() || !ecole::where('NOMCOMPLs', $this->CODSERVs)->exists() ){
            ecole::create($validate);
            session()->flash("success", "Enregistrement effectué avec succès");
            $this->resetInput();
            
        }
        else
        {
            session()->flash('error', 'le code Etablissement existe déjà');
        }

    }
    public function update($id){
        $this->ide = $id;
        $this->creer = false;
        $this->edit = true;
        $ficheEdit = ecole::where("id", $id)->get();
        $this->CODSERVs =  $ficheEdit[0]->CODSERVs;
        $this->NOMCOMPLs =  $ficheEdit[0]->NOMCOMPLs;
        $this->GENREs =  $ficheEdit[0]->GENREs;
        $this->CODE_DREN =  $ficheEdit[0]->CODE_DREN;
        $this->dispatch('check');
    }
    public function updateEtablissement(){

        $validate = $this->validate([
            'CODSERVs'=>'required|min:6',
            'NOMCOMPLs'=>'required|min:3', 
            'GENREs'=>'required|min:1',
            'CODE_DREN'=>'required:min:1',    
        ]);
        $schoolInfo = ecole::find($this->ide);
        if($schoolInfo->update($validate)){
            session()->flash("success", "Mise à jour effectué avec succès");
            $this->dispatch('save');
        }else{
            session()->flash("error", "Erreur de mise à jour");
            $this->dispatch('error');
        } 

    }
    public function render()
    {
        
        
        return view('livewire.etablissement-index',[
            'etablissements'=> ecole::with('ecole_dren')
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(10),
            
            'codeDren'=>  dren::select('code_dren','nom_dren')
            ->orderBy('code_dren', 'ASC')
            ->get()  
        ]);
        
    }
}
