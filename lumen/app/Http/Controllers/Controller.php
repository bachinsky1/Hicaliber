<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{

    public function index(Request $request)
    {
        $this->validate($request, [
            'name'      => 'string|max:64|nullable',
            'min_price' => 'integer|min:0|nullable',
            'max_price' => 'integer|min:0|nullable',
            'bedrooms'  => 'integer|min:0|nullable',
            'bathrooms' => 'integer|min:0|nullable',
            'storeys'   => 'integer|min:0|nullable',
            'garages'   => 'integer|min:0|nullable',
        ]);

        $name       = $request->get('name');
        $min_price  = $request->get('min_price');
        $max_price  = $request->get('max_price');
        $bedrooms   = $request->get('bedrooms');
        $bathrooms  = $request->get('bathrooms');
        $storeys    = $request->get('storeys');
        $garages    = $request->get('garages');

        $append = "";

        if ($min_price && $max_price) {
            $append .= " AND price BETWEEN $min_price AND $max_price";
        } else if ($min_price) {
            $append .= " AND price >= $min_price";
        } else if ($max_price) {
            $append .= " AND price <= $max_price";
        }

        $append .= ($name)      ? " AND name LIKE '%$name%'"    : "";
        $append .= ($bedrooms)  ? " AND bedrooms = $bedrooms"   : "";
        $append .= ($bathrooms) ? " AND bathrooms = $bathrooms" : "";
        $append .= ($storeys)   ? " AND storeys = $storeys"     : "";
        $append .= ($garages)   ? " AND garages = $garages"     : "";

        $query = "SELECT id, name, price, bedrooms, bathrooms, storeys, garages
                    FROM data
                    WHERE 1=1 $append";

        $results = app('db')->select($query);
        return $results;
    }
}
