<?php

namespace App\Livewire;

use App\Models\eleve;
use App\Models\ecole;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;



final class studentTable extends PowerGridComponent
{
    use WithExport;
    public string $sortField = 'eleves.nom';
    public string $primaryKey = 'eleves.id';
 
    //public bool $multiSort = true;
    public $globalsIds;
    public $shareAnnee;
    public $shareNiveau;
    public int $perPage = 5;
    public array $perPageValues = [1, 5, 10, 20, 50];
    
    #[\Livewire\Attributes\On('update')] //lors d'une mise a jour il ecoute le dispatch update qui lui a ete transferer par le comtrolleur studentindex.php et met a jout datatable powergrid
    #[\Livewire\Attributes\On('create')] //lors d'une mise a jour il ecoute le dispatch create qui lui a ete transferer par le comtrolleur studentindex.php et met a jout datatable powergrid
  
    
       
    
    
    public function setUp(): array
    
    {
        $this->showCheckBox();
        
        return [
            
            Exportable::make('Exportation DOB')
            ->striped()
            ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
            ->columnWidth([
                2 => 30,
                4 => 20,
            ]),
            Header::make()
                    ->showToggleColumns()
                    ->showSearchInput(),
      
                                        
            Footer::make()
                ->showPerPage()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

   

    public function datasource(): Builder
    {
        
        return eleve::query()
        ->leftJoin('ecoles', function($ecole){
            $ecole->on('eleves.ecole_A','=','ecoles.id');  
        })
        
        ->leftJoin('fiches', function($fiche){
            $fiche->on('eleves.fiche_id','=','fiches.id');
        })
        //->where('eleves.annee',"LIKE", "%".$this->shareAnnee."%")
        //->where('eleves.classe',"LIKE", "%".$this->shareNiveau."%")
        ->select('eleves.*','eleves.id as id_eleves', 'eleves.classe as eleve_classe','eleves.matricule as eleve_matricule','eleves.nom as eleve_nom', 'eleves.prenom as eleve_prenom',
         'ecoles.NOMCOMPLs as ecole_nom', 'fiches.nom as fiche_nom','fiches.fiche_nom',
            'eleves.annee as eleve_annee'); 
 
    }

    public function relationSearch(): array
    {
        return [
            'eleve_ecole_A'=>['NOMCOMPLs']
        ] ;
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            //->addColumn('id')
            ->addColumn('matricule')

           /** Example of custom column using a closure **/
            //->addColumn('matricule_lower', fn (eleve $model) => strtolower(e($model->matricule)))
            ->addColumn('nom')
            ->addColumn('prenom')
            ->addColumn('genre')
            ->addColumn('dateNaissance', function(eleve $eleve){
                
                if($eleve->dateNaissance==null ){
                    return 'pas de date de naissance';
                }else{
                    if(strtotime($eleve->dateNaissance)!=false){
                        $date = Carbon::parse($eleve->dateNaissance);
                    if ($date->year=='2023' or $date->year=='0000' or $date->year>=date('Y')) {
                        return 'pas de date de naissance';
                    }    
                    }else{
                        return 'pas de date de naissance'; 
                    }
                   
                }
                if(strtotime($eleve->dateNaissance)!=false){
                    return $date->format('d-m-Y');     
                }else{
                    return 'pas de date de naissance'; 
                }
                
            })
            //->addColumn('ecole_id')
            ->addColumn('eleve_classe')
            ->addColumn('serie')
            ->addColumn('eleve_annee', function(eleve $eleve){
                if($eleve->annee=='0001'){
                    return 'pas année';
                }
                return $eleve->annee;
            })
            ->addColumn('fiche',function(eleve $fiche){
                if($fiche->fiche_nom){
                    return(<<<HTML
                <div style="text-align:center">
                    <a href="pdf/$fiche->fiche_nom" target="_blank">
                        <i class="bi bi-file-earmark-pdf-fill" style="color:red; font-size:22px"></i>
                    </a>
                </div>
                HTML);
                }
                })
            
            ->addColumn('ecole_nom');
            //->addColumn('fiche_id');
            //->addColumn('created_at_formatted', fn (eleve $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            //Column::make('Id', 'id_eleves', 'eleves.id'),
            Column::make('Matricule', 'eleve_matricule' ,'eleves.matricule')
                ->sortable()
                ->searchable(),

            Column::make('Nom', 'eleve_nom', 'eleves.nom')
                ->sortable()
                ->searchable(),

            Column::make('Prenom', 'eleve_prenom', 'eleves.prenom')
                ->sortable()
                ->searchable(),

            Column::make('Genre', 'genre', 'eleves.genre')
                ->sortable()
                ->searchable(),

            Column::make('Date naissance', 'dateNaissance', 'eleves.dateNaissance')
                ->sortable()
                ->searchable(),

            //Column::make('Ecole id', 'ecole_id'),
            Column::make('Niveau', 'eleve_classe','eleves.classe')
                ->sortable()
                ->searchable(),
            
            Column::make('Serie', 'serie', 'eleves.serie')
                ->sortable()
                ->searchable(),

            Column::make('Année orientation', 'eleve_annee', 'eleves.annee')
                ->sortable()
                ->searchable(),
            Column::make('Fiches d\'orientations', 'fiche'),
                

            Column::make('Ecole Affectée', 'ecole_nom', 'ecoles.NOMCOMPLs')
                ->sortable()
                ->searchable(),
            //Column::make('Fiche id', 'fiche_id'),
            //Column::make('Created at', 'created_at_formatted', 'created_at')
            //    ->sortable(),

            Column::action('Action'),
            
        ];
    }



    public function filters(): array
    {
        
        return [
            Filter::inputText('eleve_matricule',('eleves.matricule'))->operators(['contains']),
            Filter::inputText('eleve_nom', ('eleves.nom'))->operators(['contains']),
            Filter::inputText('ecole_nom', ('ecoles.NOMCOMPLs'))->operators(['contains']),
            Filter::inputText('eleve_prenom', ('eleves.prenom'))->operators(['contains']),
            Filter::inputText('genre',('eleves.genre'))->operators(['contains']),
            Filter::inputText('eleve_classe',('eleves.classe'))->operators(['contains']),
            Filter::inputText('serie',('eleves.serie'))->operators(['contains']),
            Filter::inputText('eleve_annee', ('eleves.annee'))->operators(['contains']),
            Filter::inputText('dateNaissance', ('eleves.dateNaissance'))->operators(['contains']),
            //Filter::datetimepicker('created_at'),
        ];
    
        
    }
    public function editting($myId){
        
    }
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {    
        //$this->js('console.log('.$rowId.')');
    }
    #[\Livewire\Attributes\On('multipleSetting')]
    public function multipleSetting(){
        if(count($this->showCheckBox()->checkboxValues)>=1){
            $this->dispatch('editting',['myId'=>$this->showCheckBox()->checkedValues()]);
        }else{
            $this->js('alert("veillez cocher au moin un élève")');
        }
        
    }
    #[\Livewire\Attributes\On('addStudent')]
    public function addStudent(){
        
    }
    public function actions(\App\Models\eleve $row): array
    {
        return [
            
            Button::add('edit')
                ->slot('voir +')
                ->id()
                ->class('btn btn-sm  checkinfo')
                ->dispatch('edit', ['rowId' => $row->id]),
               /* Button::add('new-modal')
                ->slot('Edit: '.$row->id)
                ->render(function (eleve $eleve) {
                    return (<<<HTML
            <button class="btn btn-sm checkinfo" id="$eleve->id"  style="background-color: #39b315;color:#fff" >selectionner</button>
            HTML);}),*/
            
        ];
    }

    /*
    ->render(function (eleve $eleve) {
                    return (<<<HTML
            <button class="btn btn-sm checkinfo" id="$eleve->id"  style="background-color: #39b315;color:#fff" >selectionner</button>
            HTML);}),
            */
    public function actionRules($row): array
    {
       return [
        /*
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
                */
        ];
    }

    public function header(): array
    
    {
        if (Auth::check() && Auth::user()->role === 'superAdmin' || Auth::user()->role === 'admin'){
         return [
        Button::add()
        ->slot('Modification multiple '.count($this->showCheckBox()->checkedValues()) )
        ->id()
        ->class('btn btn-sm mt-2  checkinfo' )
        ->dispatch('multipleSetting',['ids'=>$this->showCheckBox()->checkedValues()]),

        Button::add()
        ->slot('Ajouter élève')
        ->class('btn btn-sm  mt-2 checkinfo')
        ->dispatch('addStudent',[])
         ]; 
        }else{
            return[];
        }

      
    }
    
}
