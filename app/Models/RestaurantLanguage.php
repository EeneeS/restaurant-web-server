<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantLanguage extends Model
{
    use HasFactory;

    protected $table = "restaurants_language";

    protected $fillable = [
        'restaurant_id',
        'description',
        'lang',
    ];
    protected $hidden = ['created_at', 'updated_at', 'id', 'restaurant_id'];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class, "restaurant_id", "restaurant_id");
    }
}
