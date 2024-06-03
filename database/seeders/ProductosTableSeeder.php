<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Models\Producto;

class ProductosTableSeeder extends Seeder
{
    public function run()
    {
        Producto::create([
            'nom_producto' => 'I am the high',
            'descripcion' => 'Experimenta el estilo urbano al máximo con nuestra camiseta "I Am at the High". Una declaración audaz para quienes desean destacar en la ciudad.',
            'precio' => 19.99,
            'categoria' => 'Camiseta',
            'talla' => 'M',
        ]);

        Producto::create([
            'nom_producto' => 'Lesson',
            'descripcion' => 'Descubre el toque urbano y moderno con nuestra camiseta "Lesson". Una lección de estilo que resalta tu autenticidad en las calles.',
            'precio' => 29.99,
            'categoria' => 'Camiseta',
            'talla' => 'L',
        ]);
        Producto::create([
            'nom_producto' => 'Blood urban',
            'descripcion' => 'Explora la oscura elegancia y la rebeldía en cada costura con nuestra camiseta "Blood Urban". Diseñada para aquellos que abrazan la singularidad y desafían las normas, esta prenda te sumergirá en la esencia intrépida de la moda urbana. ',
            'precio' => 29.99,
            'categoria' => 'Sudadera',
            'talla' => 'L',
        ]);
        Producto::create([
            'nom_producto' => 'Street heart',
            'descripcion' => 'Street Heart, la camiseta que late al ritmo de la ciudad. Con un diseño vibrante y moderno, esta prenda captura la esencia del corazón urbano. Perfecta para aquellos que viven y respiran el pulso de la calle.',
            'precio' => 29.99,
            'categoria' => 'Sudadera',
            'talla' => 'L',
        ]);
        Producto::create([
            'nom_producto' => 'Bearxx',
            'descripcion' => 'Sumérgete en el estilo urbano con nuestra camiseta "Bearxx". Un diseño audaz y contemporáneo que captura la esencia única de la moda en la ciudad.',
            'precio' => 29.99,
            'categoria' => 'Camiseta',
            'talla' => 'L',
        ]);
        Producto::create([
            'nom_producto' => 'Big steps in silence',
            'descripcion' => 'Conquista las calles con nuestra camiseta "Big Steps in Silence". Un estilo urbano que habla a través de la elegancia y la simplicidad, dando pasos firmes hacia la moda contemporánea.',
            'precio' => 29.99,
            'categoria' => 'Camiseta',
            'talla' => 'L',
        ]);
        Producto::create([
            'nom_producto' => 'Street urban smile',
            'descripcion' => 'Descubre el auténtico encanto urbano con nuestra camiseta "Street Urban Smile". Una fusión de estilo y comodidad que refleja la alegría y la esencia de la vida en la ciudad. Sonríe y muestra tu verdadero estilo en las calles.',
            'precio' => 29.99,
            'categoria' => 'Sudadera',
            'talla' => 'L',
        ]);
        Producto::create([
            'nom_producto' => 'Urban melting smile',
            'descripcion' => 'Sumérgete en la esencia del estilo urbano con nuestra exclusiva camiseta "Sonrisa Derretida Urbana". Esta prenda fusiona la frescura del diseño urbano con una dosis de creatividad derretida, creando una pieza única que captura la energía de la ciudad.',
            'precio' => 29.99,
            'categoria' => 'Sudadera',
            'talla' => 'L',
        ]);
    }
}