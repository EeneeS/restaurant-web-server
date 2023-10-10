<?php

namespace App\Http\Controllers;

use App\Modules\Restaurants\Services\RestaurantService;
use Illuminate\Http\Request;

class RestaurantApiController extends Controller
{
    private $_service;
    public function __construct(RestaurantService $service)
    {
        $this->_service = $service;
    }

    public function all() {
        return $this->_service->all();
    }

    public function list(Request $request) {
        $lang = $request->get("lang", app()->getLocale());
        return $this->_service->list($lang);
    }

    public function getRestaurantById(Int $id, Request $request) {
        $lang = $request->get("lang", app()->getLocale());
        return $this->_service->getRestaurantById($lang, $id);
    }

    public function addRestaurant(Request $request) {
        $data = $request->all();
        $restaurant = $this->_service->addRestaurant($data);
        if ($this->_service->hasErrors()) {
            return ["errors" => $this->_service->getErrors()];
        }
        return ["data" => $restaurant];
    }

    public function updateRestaurant(Int $id, Request $request) {
        $data = $request->all();
        $restaurant = $this->_service->updateRestaurant($id, $data);
        if ($this->_service->hasErrors()) {
            return ["errors" => $this->_service->getErrors()];
        }
        return ["data" => $restaurant];
    }

    public function deleteRestaurant(Int $id) {
        $restaurant = $this->_service->deleteRestaurant($id);
        if ($this->_service->hasErrors()) {
            return ["errors" => $this->_service->getErrors()];
        }
        return ["data" => $restaurant];
    }

}
