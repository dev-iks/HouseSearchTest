<?php

use App\House;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $houses = array_map('str_getcsv', file(__DIR__.'/houses.csv'));

        foreach ($houses as $i => $house) {
            if ($i === 0) {
                continue;
            }
            DB::table('houses')->insert([
                'name'      => $house[0],
                'price'     => $house[1],
                'bedrooms'  => $house[2],
                'bathrooms' => $house[3],
                'storeys'   => $house[4],
                'garages'   => $house[5]
            ]);
        }
    }
}
