<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;

class CompaniesImport implements ToModel
{
    //when you call this function, you need to pass an array as an argument
    public function model(array $row)
    {
        return new Company([
        'name'      => $row['name'],
        'email'     => $row['email'],
        // 'address'   => $row['address'],
        // 'phone'     => $row['phone'],
        // 'country'   => $row['country'],
        // 'state'     => $row['state'],
        // 'city'      => $row['city'],
        // 'image'     => $row['image'],
        // 'data'      => $row['data'],
        // 'created_at'=>$row['created_at'],
        // 'updated_at'=>$row['updated_at'],
        // 'deleted_at'=>$row['deleted_at'],
        ]);
    }
}
