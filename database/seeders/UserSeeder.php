<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Penyewa;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Carissa',
            'email' => 'carissa@gmail.com',
            'password' => Hash::make('cayica'),
        ]);
        Penyewa::create([
            'user_id' => $user1->id,
            'nomor_kamar' => 'A07',
            'status_bayar' => 'Lunas',
            'jatuh_tempo' => '2026-03-05',
            'tagihan' => 1200000,
        ]);

    }
}
