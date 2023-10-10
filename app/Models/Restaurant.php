<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "kitchen",
        "stars",
        "address",
        "description",
        "owner",
        "restaurant_id"
    ];
    protected $hidden = ['created_at', 'updated_at', 'id'];

    public function translations() {
        return $this->hasMany(RestaurantLanguage::class, "restaurant_id", "restaurant_id");
    }

}
