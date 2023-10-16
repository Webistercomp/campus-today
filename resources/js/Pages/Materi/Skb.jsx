import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DocRafiki from "@/images/document-rafiki.png";
import WebinarRafiki from "@/images/webinar-rafiki.png";

export default function SKD({ title }) {
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
                <div className="flex gap-8 mt-6">
                    <Link
                        href={route("materi.skb.teks")}
                        className="bg-white shadow-lg basis-1/2 rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all"
                    >
                        <img
                            src={DocRafiki}
                            alt=""
                            className="basis-1/5 aspect-auto w-40"
                        />
                        <div className="flex flex-col gap-2 pr-14">
                            <h4 className="uppercase text-black font-semibold text-2xl">
                                Materi Teks
                            </h4>
                            <p className="text-curious-blue">
                                Belajar TWK, TIU dan TKP untuk persiapan belajar
                                tes SKD kami dengan teks
                            </p>
                        </div>
                    </Link>
                    <Link
                        href={route("materi.skb.video")}
                        className="bg-white shadow-lg basis-1/2 rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all"
                    >
                        <img
                            src={WebinarRafiki}
                            alt=""
                            className="basis-1/5 aspect-auto w-40"
                        />
                        <div className="flex flex-col gap-2 pr-14">
                            <h4 className="uppercase text-black font-semibold text-2xl">
                                Materi Video
                            </h4>
                            <p className="text-curious-blue">
                                Belajar TWK, TIU dan TKP untuk persiapan belajar
                                tes SKD kami dengan video
                            </p>
                        </div>
                    </Link>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
