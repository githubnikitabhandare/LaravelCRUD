<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        return Category::all();
        // return Category::select("id", "name", "email")->get();
    }

    public function headings(): array
    {
        // return ["ID", "Name", "Email"];
        return ["ID", "Name", "Email","Address", "Phone", "Country", "State", "City", "Image", "Data", "Created_at", "Updated_at", "Deleted_at"];
    }

}
