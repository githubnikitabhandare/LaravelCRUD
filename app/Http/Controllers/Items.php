<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class Items extends Controller
{
    public function index(){
        $items = Item::get();//getting without deleted records.
        //$items = Item::onlyTrashed()->get();// onlyTrashed for getting deleted record
        //$items = Item::withTrashed()->get();// withTrashed for getting all records.
        dd($items->toarray());
    }

}
