<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'user_id' => 1,
                'title' => 'Casa na Praia',
                'photo' => 'img3.jpg',
                'description' => 'Casa na praia do forte, 400 m², 3 banheiros, 4 quartos sendo 1 suíte. Faxineira todas as segundas-feira.',
                'value' => 1250.00,
                'street' => 'Rua Francisco Teles',
                'number' => '27',
                'postal_code' => '35930021',
                'city' => 'João Monlevade',
                'state' => 'MG',
            ],
            [
                'user_id' => 1,
                'title' => 'Casa 4 quartos - Cristais',
                'photo' => 'img2.jpg',
                'description' => 'Casa 4 quartos com ampla cozinha, 2 banheiros, piscina, cachorrinho mais lindo do mundo. Mercado e padaria perto da casa.',
                'value' => 650.00,
                'street' => 'Rua Paraná',
                'number' => '165',
                'postal_code' => '34001155',
                'city' => 'Nova Lima',
                'state' => 'MG',
            ],
            [
                'user_id' => 1,
                'title' => 'República Erva Doce',
                'photo' => 'img1.png',
                'description' => 'Casa em apartamento localizada no centro de João Monlevade. Somos 4 morados e procuramos o quinto elemento. Seja você agua, ar, terra, fogo ou amor, estamos aceitando =).',
                'value' => 1250.00,
                'street' => 'Rua Joana Darc',
                'number' => '135',
                'postal_code' => '35930022',
                'city' => 'João Monlevade',
                'state' => 'MG',
            ],
        );

        DB::table('properties')->insert($data);
    }
}
