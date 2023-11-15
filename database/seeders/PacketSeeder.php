<?php

namespace Database\Seeders;

use App\Models\Packet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // mandiri
        $benefits = [
            'Akses Try Out Gratis',
            'Try Out Premium SKD Sistem CAT',
            'Try Out Premium UTBK',
            'Kunci dan Pembahasan Try Out Lengkap',
            'Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)',
            'Latihan Soal UTBK',
            'Materi SKD, UTBK, UM Terupdate',
            'Ranking Try Out Nasional',
            'Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video',
            'Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)',
            'Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)',
            'Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.',
            'Kalkulator TIU',
            'Video Series SKD, UTBK, dan UM.',
        ];
        $benefit1 = [];
        $benefit2 = [];
        $benefit3 = [];
        for($i=1; $i<=3; $i++) {
            if($i == 1) {
                $benefit1['v'] = array_slice($benefits, 0, 1);
                $benefit1['x'] = array_slice($benefits, 1, 14);
            } else if($i == 2) {
                $benefit2['v'] = array_slice($benefits, 0, 7);
                $benefit2['x'] = array_slice($benefits, 7, 14);
            } else if($i == 3) {
                $benefit3['v'] = array_slice($benefits, 0, 14);
                $benefit3['x'] = array_slice($benefits, 14, 14);
            }
        }

        $benefit4 = [];
        $benefit4v = [
            'Fokus Seleksi Kemampuan Dasar (SKD)',
            '20 Kali Pertemuan via zoom',
            'Free Akses dashboard Campus Today',
            'Free 1 Paket buku SKD ',
            'Akses Try Out Gratis',
            'Try Out Premium SKD Sistem CAT',
            'Kunci dan Pembahasan Try Out Lengkap',
            'Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)',
            'Materi SKD',
            'Ranking Try Out Nasional ',
            'Try Out Exclusive Platinum SKD Sistem CAT dengan Pembahasan Video',
            'Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)',
            'Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)',
            'Video Materi SKD (TWK, TIU dan TKP)',
            'Kalkulator TIU',
            'Video Series SKD',
        ];
        $benefit5 = [];
        $benefit5v = [
            'Fokus SNBP, UTBK dan Sekolah Kedinasan',
            '40 kali Pertemuan via zoom',
            'Tes Minat dan Bakat',
            'Free Akses Recording',
            '1 kelas maksimal 10 orang',
            'Free Akses dashboard Campus Today',
            'Free 2 Paket buku UTBK dan Kedinasan ',
            'Akses Try Out Gratis',
            'Try Out Premium SKD Sistem CAT',
            'Try Out Premium UTBK dan Sekolah Kedinasan',
            'Kunci dan Pembahasan Try Out Lengkap',
            'Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)',
            'Latihan Soal UTBK ',
            'Materi Sekolah Kedinasan dan UTBK Terupdate',
            'Ranking Try Out Nasional ',
            'Try Out Exclusive Platinum SKD Sistem CAT, dan UTBK dengan Pembahasan Video',
            'Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)',
            'Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)',
            'Video Materi SKD (TWK, TIU dan TKP) dan UTBK',
            'Kalkulator TIU',
            'Video Series SKD dan UTBK.',
        ];
        $benefit6 = [];
        $benefit6v = [
            'Fokus SNBP, UTBK, UM, dan Sekolah Kedinasan',
            '80 kali Pertemuan via zoom',
            'Tes Minat dan Bakat',
            'Free Akses Recording',
            '1 kelas maksimal 5 orang',
            'Free 3 Paket Buku UTBK, UM, dan Sekolah Kedinasan',
            'Free Akses dashboard Campus Today',
            'Free 2 Paket buku UTBK dan Kedinasan ',
            'Akses Try Out Gratis',
            'Try Out Premium SKD Sistem CAT',
            'Try Out Premium UTBK',
            'Kunci dan Pembahasan Try Out Lengkap',
            'Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)',
            'Latihan Soal UTBK dan UM',
            'Materi SKD, UTBK, UM Terupdate',
            'Ranking Try Out Nasional ',
            'Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video',
            'Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)',
            'Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)',
            'Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.',
            'Kalkulator TIU',
            'Video Series SKD, UTBK, dan UM.',
        ];
        for($i=4; $i<=6; $i++) {
            if($i == 4) {
                $benefit4['v'] = $benefit4v;
                $benefit4['x'] = [];
            } else if($i == 5) {
                $benefit5['v'] = $benefit5v;
                $benefit5['x'] = [];
            } else if($i == 6) {
                $benefit6['v'] = $benefit6v;
                $benefit6['x'] = [];
            }
        }
    
        Packet::create([
            'role_id' => 1,
            'name' => 'Gratis',
            'price_not_discount' => 0,
            'price_discount' => null,
            'discount' => null,
            'description' => 'Paket Gratis',
            'benefits' => json_encode($benefit1),
            'icon' => null,
            'type' => 'mandiri'
        ]);
        Packet::create([
            'role_id' => 2,
            'name' => 'Friendly',
            'price_not_discount' => 180000,
            'price_discount' => 120000,
            'discount' => 33,
            'description' => 'Paket Friendly',
            'benefits' => json_encode($benefit2),
            'icon' => null,
            'type' => 'mandiri'
        ]);
        Packet::create([
            'role_id' => 3,
            'name' => 'Ambisius',
            'price_not_discount' => 300000,
            'price_discount' => 200000,
            'discount' => 33,
            'description' => 'Paket Ambisius',
            'benefits' => json_encode($benefit3),
            'icon' => null,
            'type' => 'mandiri'
        ]);
        
        Packet::create([
            'role_id' => 4,
            'name' => 'Premium',
            'price_not_discount' => 4000000,
            'price_discount' => 3000000,
            'discount' => 25,
            'description' => 'Paket Premium',
            'benefits' => json_encode($benefit4),
            'icon' => null,
            'type' => 'bimbel'
        ]);

        Packet::create([
            'role_id' => 5,
            'name' => 'Platinum',
            'price_not_discount' => 7000000,
            'price_discount' => 6000000,
            'discount' => 14,
            'description' => 'Paket Platinum',
            'benefits' => json_encode($benefit5),
            'icon' => null,
            'type' => 'bimbel'
        ]);
        
        Packet::create([
            'role_id' => 6,
            'name' => 'Gold',
            'price_not_discount' => 17000000,
            'price_discount' => 15000000,
            'discount' => 12,
            'description' => 'Paket Gold',
            'benefits' => json_encode($benefit6),
            'icon' => null,
            'type' => 'bimbel'
        ]);
    }
}
