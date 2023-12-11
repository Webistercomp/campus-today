import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import TesKoranImg from "@/images/tes-koran.png";
import TesWarteggImg from "@/images/tes-wartegg.png";
import TesAnalogi from "@/images/tes-analogi.png";
import TesEPPS from "@/images/tes-epps.png";
import TesMatematika from "@/images/tes-matematika.png";

export default function MinatBakat({ auth, title }) {
    const tesMinatBakat = [
        {
            name: "Tes Koran",
            desc: "Pengukuran Konsentrasi",
            route: route("minatbakat.teskoran"),
            img: TesKoranImg,
        },
        {
            name: "Tes Wartegg",
            desc: "Penilaian Kepribadian",
            route: route("minatbakat.teswartegg"),
            img: TesWarteggImg,
        },
        {
            name: "Tes Analogi Verbal",
            desc: "Penilaian Kepribadian",
            route: route("minatbakat.tesanalogiverbal"),
            img: TesAnalogi,
        },
        {
            name: "EPPS",
            desc: "Penilaian Kepribadian",
            route: route("minatbakat.epps"),
            img: TesEPPS,
        },
        {
            name: "Tes Matematika",
            desc: "Penilaian Kepribadian",
            route: route("minatbakat.tesmatematika"),
            img: TesMatematika,
        },
    ];

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
                    {tesMinatBakat.map((tes, i) => (
                        <Link href={tes.route} key={i}>
                            <div className="shadow-lg rounded-lg p-2 flex gap-4 items-center cursor-pointer hover:bg-slate-100 duration-150 transition-all">
                                <img
                                    src={tes.img}
                                    alt=""
                                    className="aspect-square rounded-md basis-1/3 max-w-[100px]"
                                />
                                <div className="flex flex-col basis-2/3">
                                    <h2 className="text-slate-800 font-semibold text-2xl">
                                        {tes.name}
                                    </h2>
                                    <p className="text-curious-blue">
                                        {tes.desc}
                                    </p>
                                </div>
                            </div>
                        </Link>
                    ))}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
