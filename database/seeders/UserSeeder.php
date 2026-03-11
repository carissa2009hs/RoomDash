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

        $user2 = User::create([
            'name' => 'Hana',
            'email' => 'hana@gmail.com',
            'password' => Hash::make('karisagallagher'),
        ]);
        Penyewa::create([
            'user_id' => $user2->id,
            'nomor_kamar' => 'A09',
            'status_bayar' => 'Belum Lunas',
            'jatuh_tempo' => '2026-03-02',
            'tagihan' => 950000,
        ]);
    }
}
