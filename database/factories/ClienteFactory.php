<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'nom_cliente' => $this->faker->name,
            'direccion' => $this->faker->address,
            'correo' => $this->faker->email,
            'telefono' => $this->faker->phoneNumber,
        ];
    }
}
