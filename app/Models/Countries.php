<?php

namespace App\Models;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
