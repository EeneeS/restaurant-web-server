<?php

namespace App\Modules\Restaurants\Services;
use App\Models\RestaurantLanguage;
use App\Modules\Core\Services\Service;

class RestaurantLanguageService extends Service
{

    protected $_rules = [
        "restaurant_id" => "required",
        "lang" => "required",
        "description" => "required"
    ];

    public function __construct(RestaurantLanguage $model)
    {
        parent::__construct($model);
    }

    public function addRestaurantLanguage($data) {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }
        $model = $this->_model->create($data);
        return $model;
    }

    public function updateRestaurantLanguage($id, $language, $data) {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }
        $model = $this->_model->where("restaurant_id", "=", $id)->where("lang", "=", $language)->first();
        $model->update($data);
        return $model;
    }
}
