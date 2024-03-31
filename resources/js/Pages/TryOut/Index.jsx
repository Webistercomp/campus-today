import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DocRaf from "@/images/document-rafiki.png";
import WebRaf from "@/images/webinar-rafiki.png";
import IconTryoutSKD from "@/svg/icon-tryoutskd.svg";
import IconTryoutSKB from "@/svg/icon-tryoutskb.svg";
import IconTryoutUM from "@/svg/icon-tryoutum.svg";
import IconTryoutUTBK from "@/svg/icon-tryoututbk.svg";
import IconHasilTryout from "@/svg/icon-hasiltryout.svg";

export default function Index({ auth, title, materialTypes }) {
    const icons = [
        IconTryoutSKD,
        IconTryoutSKB,
        IconTryoutUM,
        IconTryoutUTBK,
        IconHasilTryout,
    ]
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
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 row">
                    {materialTypes.map((materialType, i) => {
                        return (
                            <Link
                                href={route("tryout.type", materialType.code)}
                                key={i}
                            >
                                <div className="bg-white shadow-lg basis-1/2 rounded-xl p-1 flex gap-4 items-center md:items-start lg:items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all h-full">
                                    <img
                                        src={icons[i]}
                                        alt=""
                                        className="basis-1/5 aspect-auto w-40 hidden sm:block md:hidden lg:block"
                                    />
                                    <div className="flex flex-col basis-4/5 gap-2 w-full p-4 sm:p-0 md:p-4">
                                        <h4 className="uppercase text-black font-semibold text-2xl">
                                            Tryout {materialType.name}
                                        </h4>
                                        <p className="text-curious-blue">
                                            {materialType.description}
                                        </p>
                                    </div>
                                </div>
                            </Link>
                        );
                    })}
                    <Link href={route("tryout.hasil")} className="mb-10">
                        <div className="bg-white shadow-lg basis-1/2 rounded-xl p-1 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all h-full">
                            <img
                                src={icons[4]}
                                alt=""
                                className="basis-1/5 aspect-auto w-40 hidden sm:block md:hidden lg:block"
                            />
                            <div className="flex flex-col basis-4/5 gap-2 w-full p-4 sm:p-0 md:p-4">
                                <h4 className="uppercase text-black font-semibold text-2xl">
                                    Hasil TryOut
                                </h4>
                                <p className="text-curious-blue">
                                    Hasil tryout memberikan gambaran prestasi dan kelemahan peserta dalam menghadapi ujian sesungguhnya, membantu perbaikan dan persiapan lebih lanjut.
                                </p>
                            </div>
                        </div>
                    </Link>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
