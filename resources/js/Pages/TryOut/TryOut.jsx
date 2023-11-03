import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DocRaf from "@/images/document-rafiki.png";
import WebRaf from "@/images/webinar-rafiki.png";

export default function TryOut({ auth, title }) {
    return (
        <AuthenticatedLayout user={auth.user}>
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
                <div className="grid grid-cols-2 gap-4 mt-6">
                    <Link href={route("tryout.skd")}>
                        <div className="bg-white shadow-lg basis-1/2 rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all">
                            <img
                                src={DocRaf}
                                alt=""
                                className="basis-1/5 aspect-auto w-40"
                            />
                            <div className="flex flex-col basis-4/5 gap-2 pr-20">
                                <h4 className="uppercase text-black font-semibold text-2xl">
                                    TryOut SKD
                                </h4>
                                <p className="text-curious-blue">
                                    Tantang dirimu untuk meraih skor tertinggi
                                    dibanding peserta lain
                                </p>
                            </div>
                        </div>
                    </Link>
                    <div className="bg-white shadow-lg basis-1/2 rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all">
                        <img
                            src={WebRaf}
                            alt=""
                            className="basis-1/5 aspect-auto w-40"
                        />
                        <div className="flex flex-col basis-4/5 gap-2 pr-20">
                            <h4 className="uppercase text-black font-semibold text-2xl">
                                TryOut SKB
                            </h4>
                            <p className="text-curious-blue">
                                Kerjain SKB sesuai bidang formasi yang kamu
                                pilih
                            </p>
                        </div>
                    </div>
                    <Link href={route("tryout.hasil")}>
                        <div className="bg-white shadow-lg basis-1/2 rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all">
                            <img
                                src={WebRaf}
                                alt=""
                                className="basis-1/5 aspect-auto w-40"
                            />
                            <div className="flex flex-col basis-4/5 gap-2 pr-20">
                                <h4 className="uppercase text-black font-semibold text-2xl">
                                    Hasil TryOut
                                </h4>
                                <p className="text-curious-blue">
                                    Lihat kembali Tryout Yang pernah anda
                                    kerjakan
                                </p>
                            </div>
                        </div>
                    </Link>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
