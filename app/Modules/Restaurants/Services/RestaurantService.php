<?php

namespace App\Modules\Restaurants\Services;

use App\Models\Restaurant;
use App\Modules\Core\Services\Service;

class RestaurantService extends Service
{
    protected $_rules = [
        "name" => "required",
        "kitchen" => "required",
        "owner" => "required",
        "stars" => "required",
        "address" => "required",
        "restaurant_id" => "required"
    ];
    public function __construct(Restaurant $model)
    {
        parent::__construct($model);
    }

    public function all() {
        return $this->_model->with("translations")->get();
    }

    public function list($lang) {
        return $this->_model->with(
            ["translations" => function ($query) use ($lang) {
                if ($lang)
                    return $query->where("lang", $lang);
            }]
        )->get(['restaurant_id', 'kitchen', 'name', 'owner', 'stars']);
    }
    public function getRestaurantById($lang, int $id) {
        return $this->_model->with(
            ["translations" => function ($query) use ($lang) {
                if ($lang)
                    return $query->where("lang", $lang);
            }]
        )
            ->where("restaurant_id", "=", $id)
            ->get();
    }
    public function addRestaurant($data) {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }
        $model = $this->_model->create($data);
        return $model;
    }
    public function updateRestaurant(int $id, $data) {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }
        $model = $this->_model->where("restaurant_id", "=", $id)->first();
        $model->update($data);
        return $model;
    }
    public function deleteRestaurant(int $id) {
        $model = $this->_model->where("restaurant_id", "=", $id)->first();
        $model->delete();
        return $model;
    }
}
