<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $produtos = [
            [
                'nome' => "MEN'S BETTER THAN NAKED & JACKET",
                'descricao' => 'Jaqueta Masculina',
                'unidades' => 21,
                'preco' =>  200.10,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/mens-better-than-naked-jacket-AVMH_LC9_hero.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'nome' => "WOMEN'S BETTER THAN NAKED™ JACKET",
                'descricao' => 'Jaqueta Feminina',
                'unidades' => 400,
                'preco' => 1600.21,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/womens-better-than-naked-jacket-AVKL_NN4_hero.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'nome' => "WOMEN'S SINGLE-TRACK SHOE",
                'descricao' => 'Sapato Feminino',
                'unidades' => 10,
                'preco' => 21.10,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/enduro-boa-hydration-pack-AJQZ_JK3_hero.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ]
            ];

            DB::table('produtos')->insert($produtos);
    }
}
