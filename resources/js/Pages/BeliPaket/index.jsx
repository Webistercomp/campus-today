import React from "react";
import PacketCard from "@/Components/PacketCard";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function BeliPaket({
    auth,
    title,
    packetMandiri,
    packetBimbel,
}) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6 px-4 md:px-14 lg:px-24 xl:px-32">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>{title}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold px-4 md:px-14 lg:px-24 xl:px-32">
                    {title}
                </h1>
                <div className="text-center my-14 relative">
                    <div className="w-screen bg-curious-blue h-1/2 absolute left-0 top-0"></div>
                    <h2 className="text-4xl text-white font-bold relative pt-8 px-4 md:px-14 lg:px-24 xl:px-32">
                        Paket TryOut
                    </h2>
                    <p className="relative mt-4 text-white px-4 md:px-14 lg:px-24 xl:px-32">
                        Silahkan pilih paket yang sesuai kebutuhan belajar
                        #SobatCampus
                    </p>
                    <div
                        className="overflow-x-scroll w-full snap-x snap-mandatory relative mt-8"
                        id="scroll-container-tryout"
                    >
                        <div
                            className="flex px-24 lg:px-14 gap-4 w-[1200px] md:w-[1500px] lg:max-w-5xl xl:max-w-7xl justify-center items-stretch xl:mx-auto"
                            id="scroll-element"
                        >
                            {packetMandiri.map((dt) => (
                                <PacketCard key={dt.id} {...dt} />
                            ))}
                        </div>
                    </div>
                </div>
                <div className="text-center my-14 relative">
                    <div className="w-screen bg-curious-blue h-1/2 absolute left-0 top-0"></div>
                    <h2 className="text-4xl text-white font-bold relative pt-8 px-4 md:px-14 lg:px-24 xl:px-32">
                        Kelas Bimbel Online
                    </h2>
                    <p className="relative mt-4 text-white max-w-4xl mx-auto px-4 md:px-14 lg:px-24 xl:px-32">
                        Program bimbel online hadir untuk meningkatkan kemampuan
                        analitis dan berpikir cepat dalam menyelesaikan tipe
                        soal yang beragam. Selain itu, #SobatCampus akan
                        dibimbing oleh Mentor terbaik dari Campus Today.
                    </p>
                    <div
                        className="overflow-x-scroll w-full snap-x snap-mandatory relative mt-8"
                        id="scroll-container-tryout"
                    >
                        <div
                            className="flex px-24 lg:px-14 gap-4 w-[1200px] md:w-[1500px] lg:max-w-5xl xl:max-w-7xl justify-center items-stretch xl:mx-auto"
                            id="scroll-element"
                        >
                            {packetBimbel.map((dt) => (
                                <PacketCard key={dt.id} {...dt} />
                            ))}
                        </div>
                    </div>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
