import React from "react";
import PacketCard from "@/Components/PacketCard";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function BeliPaket({ title }) {
    const tryOutPacket = [
        {
            type: "Gratis",
            price: 0,
            benefit: ["Akses Tryout Gratis"],
            nonBenefit: [
                "Try Out Premium SKD Sistem CAT",
                "Try Out Premium UTBK",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Latihan Soal UTBK",
                "Materi SKD, UTBK, UM Terupdate",
                "Ranking Try Out Nasional",
                "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.",
                "Video Series SKD, UTBK, dan UM",
            ],
            isPopular: false,
        },
        {
            type: "Friendly",
            price: 120000,
            benefit: [
                "Akses Tryout Gratis",
                "Try Out Premium SKD Sistem CAT",
                "Try Out Premium UTBK",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Latihan Soal UTBK",
                "Materi SKD, UTBK, UM Terupdate",
                "Ranking Try Out Nasional",
            ],
            nonBenefit: [
                "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.",
                "Video Series SKD, UTBK, dan UM",
            ],
            isPopular: true,
        },
        {
            type: "Ambisius",
            price: 200000,
            benefit: [
                "Akses Tryout Gratis",
                "Try Out Premium SKD Sistem CAT",
                "Try Out Premium UTBK",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Latihan Soal UTBK",
                "Materi SKD, UTBK, UM Terupdate",
                "Ranking Try Out Nasional",
                "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.",
                "Video Series SKD, UTBK, dan UM",
            ],
            nonBenefit: [],
            isPopular: false,
        },
    ];

    const bimbelPacket = [
        {
            type: "Gratis",
            price: 3000000,
            benefit: [
                "Fokus Seleksi Kemampuan Dasar (SKD)",
                "20 Kali Pertemuan via zoom",
                "Free Akses dashboard Campus Today",
                "Free 1 Paket buku SKD",
                "Akses Try Out Gratis",
                "Try Out Premium SKD Sistem CAT",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Ranking Try Out Nasional",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Materi SKD",
                "Try Out Exclusive Platinum SKD Sistem CAT dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP)",
                "Video Series SKD",
            ],
            nonBenefit: [],
            isPopular: false,
        },
        {
            type: "Friendly",
            price: 6000000,
            benefit: [
                "Fokus SNBP, UTBK dan Sekolah Kedinasan",
                "40 Kali Pertemuan via zoom",
                "Free Akses Recording",
                "1 kelas maksimal 10 orang",
                "Free Akses dashboard Campus Today",
                "Free 2 Paket buku UTBK dan Kedinasan Soal UTBK",
                "Akses Try Out Gratis",
                "Try Out Premium UTBK dan Sekolah Kedinasan",
                "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Materi Sekolah Kedinasan dan UTBK Terupdate",
                "Video Series SKD, UTBK, dan UM",
                "Ranking Try Out Nasional",
                "Try Out Exclusive Platinum SKD Sistem CAT, dan UTBK dengan Pembahasan Video",
                "Try Out Exclusive Platinum SKD Sistem CAT dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP)",
                "Video Series SKD dan UTBK",
            ],
            nonBenefit: [],
            isPopular: true,
        },
        {
            type: "Ambisius",
            price: 15000000,
            benefit: [
                "Fokus SNBP, UTBK, UM dan Sekolah Kedinasan",
                "80 Kali Pertemuan via zoom",
                "Tes Minat Bakat",
                "Free Akses Recording",
                "1 kelas maksimal 5 orang",
                "Free Akses dashboard Campus Today",
                "Free 3 Paket buku UTBK, UM dan Sekolah Kedinasan",
                "Free 2 Paket buku UTBK dan Kedinasan",
                "Akses Try Out Gratis",
                "Try Out Premium UTBK dan Sekolah Kedinasan",
                "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Materi Sekolah Kedinasan dan UTBK Terupdate",
                "Video Series SKD, UTBK, dan UM",
                "Ranking Try Out Nasional",
                "Try Out Exclusive Platinum SKD Sistem CAT, dan UTBK dengan Pembahasan Video",
                "Try Out Exclusive Platinum SKD Sistem CAT dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP)",
                "Video Series SKD dan UTBK",
            ],
            nonBenefit: [],
            isPopular: false,
        },
    ];

    return (
        <AuthenticatedLayout>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>{title}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {title}
                </h1>
                <div className="text-center my-14 relative">
                    <div className="w-screen bg-curious-blue h-1/2 absolute -left-28 top-0"></div>
                    <h2 className="text-4xl text-white font-bold relative pt-8">
                        Paket TryOut
                    </h2>
                    <p className="relative mt-4 text-white">
                        Silahkan pilih paket yang sesuai kebutuhan belajar
                        #SobatCampus
                    </p>
                    <div className="flex gap-4 relative px-14 mt-12">
                        {tryOutPacket.map((dt, i) => (
                            <PacketCard key={i} {...dt} />
                        ))}
                    </div>
                </div>
                <div className="text-center my-14 relative">
                    <div className="w-screen bg-curious-blue h-1/2 absolute -left-28 top-0"></div>
                    <h2 className="text-4xl text-white font-bold relative pt-8">
                        Kelas Bimbel Online
                    </h2>
                    <p className="relative mt-4 text-white max-w-4xl mx-auto">
                        Program bimbel online hadir untuk meningkatkan kemampuan
                        analitis dan berpikir cepat dalam menyelesaikan tipe
                        soal yang beragam. Selain itu, #SobatCampus akan
                        dibimbing oleh Mentor terbaik dari Campus Today.
                    </p>
                    <div className="flex gap-4 relative px-14 mt-12">
                        {bimbelPacket.map((dt, i) => (
                            <PacketCard key={i} {...dt} />
                        ))}
                    </div>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
