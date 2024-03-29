<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'title',
        'description',
        'location',
        'image',
        'places',
        'date',
        'time',
        'price',
        'category_id',
        'user_id',
        'spots'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function users(){
        return $this->belongsToMany(User::class , 'reservation');
    }
}
