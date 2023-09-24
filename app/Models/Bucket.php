<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $table = 'Bucket';
    use HasFactory;
    protected $fillable=['user_id', 'items_id'];
}
