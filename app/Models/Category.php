<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function boot(){
        parent::boot();

        static::creating(function ($category){
            $category->category_slug = Str::slug(trim($category->category_name));
        });
    }
}
