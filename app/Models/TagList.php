<?php


namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TagList extends Model
{

    use HasFactory;

    public $table = "tagslist";
    public $fillable = ['name'];
}
