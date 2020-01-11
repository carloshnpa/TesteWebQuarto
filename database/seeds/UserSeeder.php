<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = array(
            [
                "name" => 'Carlos Henrique Pereira Abreu',
                "email" => 'carloshpa.mg4@me.com',
                "password" => Hash::make('1234'),
            ],
            [
                "name" => 'Dyego Nery',
                "email" => 'dyego@3nw.com.br',
                "password" => Hash::make('1234')
            ]
        );

        DB::table('users')->insert($dados);
    }
}
