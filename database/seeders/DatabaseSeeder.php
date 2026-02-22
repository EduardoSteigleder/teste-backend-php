<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('precos_base')->delete();
        DB::table('produtos_base')->delete();

        DB::table('produtos_base')->insert([
            [
                'sku' => 'PROD001',
                'nome' => '  Produto A  ',
                'descricao' => '  Descrição do Produto A  ',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'PROD002',
                'nome' => 'PRODUTO B',
                'descricao' => 'Descrição do Produto B',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'PROD003',
                'nome' => 'produto c',
                'descricao' => 'descrição do produto c',
                'ativo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'PROD004',
                'nome' => '  Produto D  ',
                'descricao' => null,
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('precos_base')->insert([
            [
                'sku' => 'PROD001',
                'preco' => 100.50,
                'moeda' => 'brl',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'PROD002',
                'preco' => 250.75,
                'moeda' => 'BRL',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'PROD003',
                'preco' => 50.00,
                'moeda' => 'brl',
                'ativo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'PROD004',
                'preco' => 150.25,
                'moeda' => 'BRL',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
