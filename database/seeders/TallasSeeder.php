<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TallasSeeder extends Seeder
{
    public function run()
    {
     
        $tallasData = [
            ['nom_talla' => 'XS'],
            ['nom_talla' => 'S'],
            ['nom_talla' => 'M'],
            ['nom_talla' => 'L'],
            ['nom_talla' => 'XL'],
            ['nom_talla' => 'XXL'],
           
        ];

    
        DB::table('tallas')->insert($tallasData);
    }
}
