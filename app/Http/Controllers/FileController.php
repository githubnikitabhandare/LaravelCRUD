<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;


class FileController extends Controller
{

    public function index()
    {
        return view('fileUpload');
    }


    public function store(Request $request)
    {
        $request->validate([
            'uname' => 'required',
            'files' => 'required',
            'files.*' => 'required|mimes:pdf,csv,xls,xlsx,doc,docx|max:2048',
        ]);

        // $uname = new File;
        // $uname->uname = $request->uname;



        $files = [];

        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                // $fileName = time().rand(1,100).'.'.$file->extension();
                $fileName = $file->getClientOriginalName();

                if ($file->move(public_path('uploads'), $fileName)) {
                    $files[] = $fileName;
                    // File::create([
                    //     "name" => $fileName,
                    //     "uname" => $uname,
                    // ]);

                    $category = new File;
                    $category->name = $fileName;
                    $category->uname = $request->uname;

                    $category->save();


                }
            }
        }
        if (count($files) > 0) {
            return back()->with('success','Success! File(s) has been uploaded');
        }

        else {
            return back()->with("failed", "Alert! Unable to upload file");
        }
    }

}

