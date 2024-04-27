<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'categoryName',
        'categorylevel',
        'categoryID',
        'categoryParentID'
    ];

    public function parentCategories()
    {
        return $this->belongsTo(Categories::class, 'categoryParentID');
    }
    public function subCategories()
    {
        return $this->belongsTo(Categories::class,'categoryParentID')->with('parentCategories');
    }
}
