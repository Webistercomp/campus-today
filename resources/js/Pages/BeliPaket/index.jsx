import React from "react";
import PacketCard from "@/Components/PacketCard";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function BeliPaket({ title, packets }) {
    const mandiriPacket = packets.filter((dt) => dt.type === "mandiri");
    const bimbelPacket = packets.filter((dt) => dt.type === "bimbel");

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
                        {mandiriPacket.map((dt, i) => (
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
