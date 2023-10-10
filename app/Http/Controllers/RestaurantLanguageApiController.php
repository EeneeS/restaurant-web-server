<?php

namespace App\Http\Controllers;

use App\Modules\Restaurants\Services\RestaurantLanguageService;
use Illuminate\Http\Request;

class RestaurantLanguageApiController extends Controller
{
    private $_service;

    public function __construct(RestaurantLanguageService $service)
    {
        $this->_service = $service;
    }

    public function addRestaurantLanguage(Request $request) {
        $data = $request->all();
        $restaurantLanguage = $this->_service->addRestaurantLanguage($data);
        if ($this->_service->hasErrors()) {
            return ["errors" => $this->_service->getErrors()];
        }
        return ["data" => $restaurantLanguage];
    }

    public function updateRestaurantLanguage(int $id, Request $request) {
        $data = $request->all();
        $language = $request->input('lang');
        $restaurantLanguage = $this->_service->updateRestaurantLanguage($id, $language, $data);
        if ($this->_service->hasErrors()) {
            return ["errors" => $this->_service->getErrors()];
        }
        return ["data" => $restaurantLanguage];
    }
}
