<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompaniesExport implements FromCollection, WithHeadings
{
    protected $data;

    function __constuct($data) {
        $this->data = $data;
    }
    public function collection() {
        return $this->data->all();
    }
    // protected $users;

    // public function __construct($users) {
    //     // dd($id);
    //         $this->users = $users;

    // }

    // public function collection()
    // {
    //     // $data = Company::all();
    //     $users=  Company::where('id', $this->id)->get();



    //     // dd(Company::where('id',$this->id)->get()([
    //     //     'name', 'email','address','phone'
    //     // ]));

    //     // return Company::all();
    //     // return Category::select("id", "name", "email")->get();
    // }

    public function headings(): array
    {
        // return ["ID", "Name", "Email"];
        return ["ID", "Name", "Email","Address", "Phone", "Created_at", "Updated_at", "Deleted_at"];
    }

}
