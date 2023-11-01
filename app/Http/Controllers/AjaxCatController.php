<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

use Illuminate\Support\Str;

use Datatables;

use App\Exports\CompaniesExport;

use App\Imports\CompaniesImport;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;

class AjaxCatController extends Controller
{

    // protected $request;
    // public function __construct($request)
    // {
    //     $this->request = $request;
    // }

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Company::latest()->get();

            // $users = DB::table('companies')->get();
            // $countries = DB::table('countries')->union($users)->get();
            return datatables()->of($data)
            // ->addColumn('action', 'company-action')
            // ->rawColumns(['action'])
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('email'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['email'], $request->get('email')) ? true : false;
                    });
                }

                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))){
                            return true;
                        }else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                            return true;
                        }

                        return false;
                    });
                }

            })

            ->addColumn('action', 'company-action')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('categories');
    }


    public function store(Request $request)
    {

        $id = $request->id;

        $company   =  Company::updateOrCreate(
                    [
                     'id' => $id
                    ],
                    [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' =>$request->phone
                    ]);

        return Response()->json($company);

    }



    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $company  = Company::where($where)->first();

        return Response()->json($company);
    }


    public function destroy(Request $request)
    {
        $company = Company::where('id',$request->id)->delete();

        return Response()->json($company);
    }



    public function export(Request $request)
    {
        // dd($request->email);
        $data = DB::table('companies')
        ->where('email', 'like','%'.$request->email)
        ->get();

        // $data = Company::where('email','like','%'.$request->email)->get();

        // $id = $request->id;
        // dd($data);
        return Excel::download(new CompaniesExport($data), 'companies.xlsx');
    }

    public function import()
    {
        Excel::import(new CompaniesImport,request()->file('file'));

        return back();
    }
}
