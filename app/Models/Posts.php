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
        'image',
        'approved',
        'deleted',
        'business_id',
        'created_at',
        'updated_at',
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
