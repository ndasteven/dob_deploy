<?php

namespace App\Livewire;

use App\Models\fiche;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
use Illuminate\Support\Facades\Auth;

final class ficheTable extends PowerGridComponent
{
    use WithExport;
    public int $perPage = 5;
    public $shareAnnee;
    public array $perPageValues = [1, 5, 10, 20, 50];

    #[\Livewire\Attributes\On('update')] //lors d'une mise a jour il ecoute le dispatch update qui lui a ete transferer par le comtrolleur studentindex.php et met a jout datatable powergrid
    #[\Livewire\Attributes\On('create')] //lors d'une mise a jour il ecoute le dispatch create qui lui a ete transferer par le comtrolleur studentindex.php et met a jout datatable powergrid
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            /*
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),*/
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
                
        ];
    }

    public function datasource(): Builder
    {
        return fiche::query()
        ->where('fiches.annee',"LIKE", "%".$this->shareAnnee."%");
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('nom')

           /** Example of custom column using a closure **/
            ->addColumn('nom_lower', fn (fiche $model) => strtolower(e($model->nom)))

            ->addColumn('fiche_nom', function(fiche $fiche){
                return(<<<HTML
                <div style="text-align:center">
                    <a href="pdf/$fiche->fiche_nom" target="_blank">
                        <i class="bi bi-file-earmark-pdf-fill" style="color:red; font-size:22px"></i>
                    </a>
                </div>
                HTML);
            })
            ->addColumn('classe')
            ->addColumn('type_fiche')
            ->addColumn('annee');
           
    }

    public function columns(): array
    {
        return [
            
            Column::make('Nom', 'nom')
                ->sortable()
                ->searchable(),

            Column::make('Fiche en PDF', 'fiche_nom')
                ->sortable()
                ->searchable(),

            Column::make('Classe', 'classe')
                ->sortable()
                ->searchable(),

            Column::make('Type fiche', 'type_fiche')
                ->sortable()
                ->searchable(),
            Column::make('Annee', 'annee'),
         

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('nom')->operators(['contains']),
            Filter::inputText('classe')->operators(['contains']),
            Filter::inputText('type_fiche')->operators(['contains']),
            Filter::inputText('annee')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        //$this->js('alert('.$rowId.')');
    }
    #[\Livewire\Attributes\On('addFiche')]
    public function addFiche(){
        
    }
    public function actions(\App\Models\fiche $row): array
    {
        return [
            Button::add('edit')
                ->slot('voir +')
                ->id()
                ->class('btn btn-sm  checkinfo')
                ->dispatch('edit', ['rowId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */

    public function header(): array
    
    {
        if (Auth::check() && Auth::user()->role === 'superAdmin' || Auth::user()->role === 'admin'){
        return [
            Button::add()
            ->slot('Ajouter une fiche')
            ->id()
            ->class('btn btn-sm  checkinfo')
            ->dispatch('addFiche',[])
        ];
    }else{
        return [];
    }
    }
}
