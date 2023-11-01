<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Rules\BirthYearRule;
class CustomValidationController extends Controller
{

    public function create(): View
    {
        return view('forms');
    }


    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'email'=> 'required_without:name',
                'birth_year' => [
                    'required',
                    new BirthYearRule()
                ]
            ]);
        return back()->with('success', 'User created successfully.');
    }
}
