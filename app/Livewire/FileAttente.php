<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FileAttente extends Component
{
    public $fileAttente;
    public $countTache;

    public function checkFileAttente(){
        //@dump("hello");
        $countJobs = DB::table('jobs')->count();
        $countFailedJobs = DB::table('failed_jobs')->count();
        if($countJobs>0){
            $this->countTache = $countJobs;
            $this->fileAttente=true;
            $this->dispatch('desableForm');
            
        }else{
            $this->fileAttente=false;
            $this->countTache = 0;
            $this->dispatch('ActiveForm');
        }
        //importation echoue
        if($countFailedJobs>0){
            $this->dispatch('errorImport');
            DB::table('failed_jobs')->truncate();
            
        }
    }
    public function render()
    {
        return view('livewire.file-attente');
    }
}
