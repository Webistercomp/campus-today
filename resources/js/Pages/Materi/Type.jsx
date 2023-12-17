import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DocRafiki from "@/images/document-rafiki.png";
import WebinarRafiki from "@/images/webinar-rafiki.png";

export default function SKD({ auth, title, type }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li className="capitalize">
                        {title}&nbsp;
                        <span className="uppercase">{type}</span>
                    </li>
                </ul>
            </div>

            <section>
                <h1 className="text-2xl xl:text-3xl text-curious-blue font-semibold capitalize">
                    {title} <span className="uppercase">{type}</span>
                </h1>
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-6 pb-8">
                    <Link
                        href={route("material.type.teks", type)}
                        className="bg-white shadow-lg rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all"
                    >
                        <img
                            src={DocRafiki}
                            alt=""
                            className="basis-1/5 aspect-auto w-40"
                        />
                        <div className="flex flex-col gap-2 pr-6">
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
                        href={route("material.type.video", type)}
                        className="bg-white shadow-lg rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all"
                    >
                        <img
                            src={WebinarRafiki}
                            alt=""
                            className="basis-1/5 aspect-auto w-40"
                        />
                        <div className="flex flex-col gap-2 pr-6">
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
