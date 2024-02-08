<?php

namespace App\Imports;

use App\Models\ecole;
use App\Models\eleve;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class elevesImport implements ToCollection,   WithBatchInserts, WithChunkReading,  WithUpserts,ShouldQueue,  WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*
    public function model(array $row)
    {
        
        return new eleve([
            'classe'=>"6eme",
            'matricule'=> $row[1],
            'nom'=>$row[2],
            'prenom'=>$row[3],
            'genre'=>$row[4],
            'dateNaissance'=>$row[5],
            'serie'=>'null',
            'annee'=>"2019",
        ]);        
    }
    */
    public $ecole_id;
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            
            if(!eleve::where('matricule', $row['matricule'])->exists()){
              eleve::create([
                'classe'=>$row['classe'],
                'matricule'=>(!eleve::where('matricule', $row['matricule'])->exists())? $row['matricule'] : '',
                'nom'=>$row['nom'],
                'prenom'=>$row['prenom'],
                'annee'=>(isset($row['annee_orientation']) && $row['annee_orientation'] != 'null') ? $row['annee_orientation']  : '0001',
                'genre'=>$row['genre'],
                'dateNaissance' => (isset($row['datenaissance']) && $row['datenaissance'] != 'null') ? date('Y-m-d', strtotime($row['datenaissance']))  : '0000-01-01',
                'serie'=>isset($row['serie']) ? $row['serie'] : null,
                'ecole_origine'=>$row['ecole_origine'],
                'ecole_id' => (strlen($row['ecole_origine']) > 0) ? 
                (function () use ($row) { //function qui verifie dans la table ecole si le nom exist et donnner le bon id a la cole ecole_id qui correspond a la vrai ecole 
                    $son_ecole_origin = ecole::where('NOMCOMPLs', 'like', '%' . $row['ecole_origine'] . '%')->get();
                    return (count($son_ecole_origin) > 0) ? $this->ecole_id = $son_ecole_origin[0]->id : $this->ecole_id= null;
                })() : null,
            ]);  
            }
               
        }
        
    }

    public function batchSize(): int
    {
        
        return 1000;
        
    }
    public function chunkSize(): int
    {
        return 500;
    }
    public function uniqueBy()
    {
        return 'matricule';
    }
}
