<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithChunkReading, ShouldQueue,WithStartRow
{
    /**
    * @param array $row
    *
//    * @return \Illuminate\Database\Eloquent\Model|null          WithHeadingRow
    */
    public function model(array $row)
    {
        return new Product([
            'name'         => $row[0],
            'salary'       => $row[1],
            'hours'        => $row[2],
            'total'        =>( ( $row[1] / (8*26) ) * $row[2] ),
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
    public function chunkSize(): int
    {
        return 10000;
    }
}
