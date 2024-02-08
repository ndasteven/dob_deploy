<?php
namespace App\Imports;

use App\Models\dren;
use App\Models\ecole;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ecoleImport implements ToCollection, WithBatchInserts, WithChunkReading,  ShouldQueue,  WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public $CODE_DREN;
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if(!ecole::where('NOMCOMPLs', $row['nom_ecole'])->exists()){
                ecole::create([
                    'NOMCOMPLs'=>$row['nom_ecole'],
                    'CODSERVs'=>isset($row['code_etablissement']) ? $row['code_etablissement'] : '000000',
                    'GENREs'=>isset($row['type']) ? $row['type'] : null,
                    'CODE_DREN'=>(strlen($row['dren'])>0)? (function() use($row){//ce script verifie si il a un caractere dans la colone dren du fichier excel si oui alors il verifie le nom de la dren dans la base s'il existe alors il donne le code_dren a la colone CODE_DREN dans la DB dans la table ecole
                        $dren = dren::where('nom_dren', 'like', '%'.$row['dren'].'%')->get();
                        return (count($dren)>0)? $this->CODE_DREN = $dren[0]->code_dren : $this->CODE_DREN = 51;
                    } )() :51 ,
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
        return 250;
    }
   
}
