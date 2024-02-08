<?php

namespace App\Livewire;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Livewire\StudentIndex;

class TableRow extends Component
{
    #[Reactive]
    public $eleves;
    public function render()
    {   
        return view('livewire.table-row');
    }
}
