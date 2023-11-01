<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;

// use App\Http\Requests\UserStoreRequest;

class CategoryController extends Controller
{
    public function index()
    {

        $categories =  Category::allcategory();
        //dd($categories);
        return view('categories.list', compact('categories'));
    }

    public function create()
    {
        // return URL::temporarySignedRoute(
        //     'user.create', now()->addMinutes(30)
        // );
        $category = new Category;
        // $countries = DB::table('countries')->orderBy('name','ASC')->get();
        // $data['countries'] = $countries;
        return view('categories.add',compact('category'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'data' => 'required|mimes:pdf,xlx,csv,xlsx|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);

        $fileName = time().'.'.$request->data->extension();
        $request->data->move(public_path('uploads'),$fileName);

        $category = new Category;
        $category->image = $imageName;
        $category->data = $fileName;
        $category->name = $request->name;
        $category->email = $request->email;
        $category->address = $request->address;
        $category->phone = $request->phone;
        $category->country = $request->country;
        $category->state = $request->state;
        $category->city = $request->city;

        $category->save();


        return redirect('/user')->withSuccess('New User Created Successfully!!!');
    }

    public function edit($id = null)
    {

        // if ($id === null) {
        //      return redirect()->route('user.index');
        //  }


        // $category = Category::find($id);

        // if (!$category) {
        //     return redirect()->route('user.index');
        // }

        // return view('categories.edit', compact('category'));

        $id = Crypt::decrypt($id);
        $category = Category::where('id',$id)->first();
         // return view('categories.edit',['category' =>$category]);
        return view('categories.add',compact('category'));
    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::where('id',$id)->first();
        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'),$imageName);
            $category->image = $imageName;
        }
        $category->name = $request->name;
        $category->email = $request->email;
        $category->address = $request->address;
        $category->phone = $request->phone;

        $category->save();
        return redirect('/user')->withSuccess('User Updated Successfully!!!');
    }


    public function destroy ($id)
    {
        // $category = Category::where('id',$id)->first();
        // $category->delete();

        // if ($category != null) {
        //     $category->delete();
        //     return redirect()->route('/user')->with(['message'=> 'Successfully deleted!!']);
        // }


        try {
            $category = Category::where('id',$id)->first();
          } catch (ModelNotFoundException $e) {
            return redirect()->route('/user')->with(['message'=> 'Failed']);
          }

          $category->delete();

        return redirect('/user')->withSuccess('User Deleted Successfully!!!');
    }

    public function fetchStates($country_id = null) {
        $states = \DB::table('states')->where('country_id',$country_id)->get();

        return response()->json([
            'status' => 1,
            'states' => $states
        ]);
    }

    public function fetchCities($state_id = null) {
        $cities = \DB::table('cities')->where('state_id',$state_id)->get();

        return response()->json([
            'status' => 1,
            'cities' => $cities
        ]);
    }

    public function export()
    {
        return Excel::download(new CategoriesExport, 'categories.xlsx');
    }

    public function import()
    {
        Excel::import(new CategoriesImport,request()->file('file'));

        return back();
    }

}
