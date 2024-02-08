<?php

namespace App\Livewire;

use App\Models\dren;
use Livewire\Component;




class Drenindex extends Component
{
    
    protected $paginationTheme = 'bootstrap';
    public $code_dren, $nom_dren;
    public $search;
    public $icon;
    private function resetInput(){
        $this->code_dren=$this->nom_dren='';
    }
    protected $queryString = [
        'search'=> ['except'=>''],
        'orderField'=> ['except'=>'title'],
        'oderDirection'=> ['except'=>'ASC']
         ];
    public function research(){
        $this->search = $this->search; 
    }

    public string $orderField= 'code_dren';
    public string $orderDirection = 'ASC';


    //FONCTION DE FILTRRE
    public function setOrderField(string $nom){
        if($nom === $this->orderField){
            $this->orderDirection = $this->orderDirection ==='ASC' ? 'DESC': 'ASC';
            $this->icon ='check';
        }else{
            $this->orderField = $nom;
            $this->reset('orderDirection');
            
        }
       
    }

    public function storeDren(){

        $validate = $this->validate([
            'code_dren'=>'required|min:1|',
            'nom_dren'=>'required|min:3', 
        ]);

        if(!Dren::where('code_dren', $this->code_dren)->exists() || !Dren::where('nom_dren', $this->nom_dren)->exists()){
           
            Dren::create($validate);
            session()->flash("success", "Enregistrement effectué avec succès");
            $this->resetInput();
            
        }else
        {
            session()->flash('error', 'le code DREN ou le nom DREN existe déjà');
        }

    }

    public function show(){

    }

    public function render()
    {
        return view('livewire.dren-index', [
          
            
        ]);
    }
}
