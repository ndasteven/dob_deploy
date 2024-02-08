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

class drenImport implements ToCollection, WithBatchInserts, WithChunkReading,  ShouldQueue,  WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if(!dren::where('nom_dren', $row['nom_dren'])->exists()){
                dren::create([
                    'code_dren'=>$row['code_dren'],
                    'nom_dren'=>$row['nom_dren'],
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
}
