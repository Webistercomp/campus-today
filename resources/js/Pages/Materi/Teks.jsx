import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import DocumentIcon from "@/icons/DocumentIcon";
import { Head, Link } from "@inertiajs/react";

export default function Teks({ title, type, materials }) {
    return (
        <AuthenticatedLayout>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link href={route("material.type", 'skd')}>Materi SKD</Link>
                    </li>
                    <li>{title}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {title}
                </h1>

                <div className="flex justify-between gap-8 items-center mt-4 border-b-2 pb-3">
                    <div className="flex gap-14 w-full">
                        <a className="text-center relative cursor-pointer tab-active">
                            Tes Wawasan Kebangsaan
                        </a>
                        <a className="text-center relative cursor-pointer">
                            Tes Intelegensia Umum
                        </a>
                        <a className="text-center relative cursor-pointer">
                            Tes Karakteristik Pribadi
                        </a>
                    </div>
                    <div className="form-control">
                        <input
                            type="text"
                            placeholder="Cari"
                            className="input input-bordered w-24 md:w-auto"
                        />
                    </div>
                </div>

                <div className="flex gap-6 mt-6">
                    {materials.map((material, i) => {                      
                        // Return the element. Also pass key     
                        return (<Link
                            href={route("material.type.teks.subtype", [material.material_type.code, material.code])}
                            key={i}
                            className="bg-white shadow-lg basis-1/3 rounded-xl p-4 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all"
                        >
                            <div className="bg-curious-blue aspect-square flex items-center justify-center h-full rounded-lg p-4">
                                <DocumentIcon className="w-12" />
                            </div>
                            <div className="flex flex-col gap-2">
                                <h4 className="uppercase text-curious-blue font-semibold text-lg">
                                    {material.title}
                                </h4>
                                <p className="text-black">{material.description}</p>
                            </div>
                        </Link>) 
                    })}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
