import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DocRaf from "@/images/document-rafiki.png";
import WebRaf from "@/images/webinar-rafiki.png";

export default function Index({ title , materialTypes}) {
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
                <div className="grid grid-cols-2 gap-4 mt-6">
                    {materialTypes.map((materialType, i) => {
                        return <Link href={route("tryout.type", materialType.code)} key={i}>
                            <div className="bg-white shadow-lg basis-1/2 rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all">
                                <img
                                    src={DocRaf}
                                    alt=""
                                    className="basis-1/5 aspect-auto w-40"
                                />
                                <div className="flex flex-col basis-4/5 gap-2 pr-20">
                                    <h4 className="uppercase text-black font-semibold text-2xl">
                                        {materialType.name}
                                    </h4>
                                    <p className="text-curious-blue">
                                        {materialType.description}
                                    </p>
                                </div>
                            </div>
                        </Link>;
                    })}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
