<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Countries;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'country',
        'state',
        'city',
        'image',
        'birthdate'
    ];


    public static function allcategory(){

        $categories = Countries::leftJoin('categories', 'categories.country', '=', 'countries.id')
                ->leftJoin('states','categories.state','=','states.id')
                ->leftJoin('cities','categories.city','=','cities.id')
                ->select('categories.*','countries.name AS country_name','states.name AS state_name','cities.name AS city_name')
                ->paginate(4);
                // ->get();
                //dd($categories->toarray());

                return $categories;


    }

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * The attributes that should be cast.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

}
