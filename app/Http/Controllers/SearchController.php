<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index() {
        $houses = DB::table('houses')->get();

        return response()->json($houses, 200);
    }

    public function search(Request $request)
    {
        $name = $request->get('name') ?? '';
        $bathrooms = $request->get('bathrooms');
        $bedrooms = $request->get('bedrooms');
        $storeys = $request->get('storeys');
        $garages = $request->get('garages');
        $priceFrom = $request->get('priceFrom');
        $priceUpto = $request->get('priceUpto');

        $searchResult = House::where('name', 'LIKE', '%' . $name . '%')
                    ->whereEqualAndNotEmpty('bathrooms', $bathrooms)
                    ->whereEqualAndNotEmpty('bedrooms', $bedrooms)
                    ->whereEqualAndNotEmpty('storeys', $storeys)
                    ->whereEqualAndNotEmpty('garages', $garages);

        if (!empty($priceFrom) || !empty($priceUpto)) {
            if (empty($priceFrom)) {
                $priceFrom = 0;
            } elseif (empty($priceUpto)) {
                $priceUpto = PHP_INT_MAX;
            }
            $searchResult = $searchResult->whereBetween('price', [$priceFrom, $priceUpto]);
        }

        $searchResult = $searchResult->get();
        if (count($searchResult) > 0) {
            return response()->json($searchResult, 200);
        }

        return response()->json([ ["id" => 1, "message" => 'Not found!']], 200);
    }
}
