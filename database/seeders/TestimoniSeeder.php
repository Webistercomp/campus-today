<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Testimoni::create([
        //     'name' => 'John Doe',
        //     'institusi_sebelumnya' => 'SMK Negeri 1 Jakarta',
        //     'institusi_sekarang' => 'Universitas Indonesia',
        //     'testimoni' => 'Saya sangat senang bisa belajar di SMK Negeri 1 Jakarta. Saya mendapatkan banyak ilmu yang bermanfaat.',
        //     'photo' => 'default.jpeg',
        // ]);
        $dataTesti = [
            [
                "name" => "Fawas Fatchur Rois Riadi",
                "as" => "Alumni SMAN 1 AJIBARANG",
                "agency" => "Universitas Jenderal Soedirman",
                "testi" => "Bimbel SPASI ini sangat bagus. Cara pembelajarannya tidak terlalu terburu buru dan mulai dari awal jadi tidak takut untuk ketinggalan materi.",
                "photo" => "fawas.jpg",
            ],
            [
                "name" => "Anatasia Permata Sari Manurung",
                "as" => "Alumni SMAN 10 TANGERANG",
                "agency" => "Universitas Pertamina",
                "testi" => "Kakaknya ngajarnya seru, jadi kita nggak bosen saat belajar. Selain itu, cara ngajarnya juga pelan-pelan jadi lebih mudah dimengerti materi pembelajarannya.",
                "photo" => "anatasia.jpg",
            ],
            [
                "name" => "Shifa Dwi Pramudita",
                "as" => "Alumni SMAN 1 JALAKSANA",
                "agency" => "Universitas Jenderal Achmad Yani",
                "testi" => "Kesan saya selama bimbel disini saya merasa nyaman, santai, dan pastinya juga seru. Dari penyampaian materinya pun berurut sehingga ketika memasuki materi lain yang bergubungan dapat dimengerti. Dalam belajar kita saling support dan mendukung satu sama lain apabila ada yang belum dimengerti, dengan senang hati pasti akan dijelaskan kembali.",
                "photo" => "shifa.jpg",
            ],
            [
                "name" => "Rasya Kharomah Putri",
                "as" => "Alumni SMA N 7 Bengkulu",
                "agency" => "Universitas Islam Indonesia",
                "testi" => "Bimbel di SPASI sangat membantu, banyak diberi latihan soal, aplikasi Try Out gratis dan kuis di akhir pertemuan. pengajar juga ramah dan bagus dalam menjelaskan materi pelajaran. Pake sistem daring (online) jadi lebih konsentrasi dan nggak banyak orang. plus lagi, kita dapet buku latihan super lengkap.",
                "photo" => "rasya.jpg",
            ],
            [
                "name" => "Dimas Ghifar Farisi",
                "as" => "Alumni SMA N 2 Cibinong",
                "agency" => "Universitas Brawijaya",
                "testi" => 'Bimbel sama Kak Nizar tuh pastinya trusted. Sistem belajarnya step by step. Pembelajaran juga menarik, detail, nggak ngebosenin dan mudah dipahami. Tentu saja benefitnya kita dapat mengerjakan soal HOTS dari yang termudah hingga tersulit sehingga membuat kita lebih terbiasa untuk mengerjakan tipe tipe soal lainnya. 1 kata bimbel bersama kak nizar yaitu “AWESOME".',
                "photo" => "dimas.jpg",
            ],
        ];

        foreach($dataTesti as $testi) {
            Testimoni::create([
                'name' => $testi['name'],
                'institusi_sebelumnya' => $testi['as'],
                'institusi_sekarang' => $testi['agency'],
                'testimoni' => $testi['testi'],
                'photo' => $testi['photo'],
            ]);
        }
    }
}
