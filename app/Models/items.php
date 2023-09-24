<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'price', 'image', 'description', 'inValue', 'category', 'subcategory'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
