import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import XIcon from "@/icons/XIcon";
import { Head, Link } from "@inertiajs/react";
import { useState } from "react";

export default function HasilWartegg({ auth, title, hasil_wartegg }) {
    const [openModal, setOpenModal] = useState(true);
    const [currentWartegg, setCurrentWartegg] = useState(null);

    const handleOnClickDetailWartegg = (wartegg) => {
        setCurrentWartegg(wartegg);
        setOpenModal(true);
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link href={route("minatbakat")}>Tes Minat Bakat</Link>
                    </li>
                    <li>
                        <Link href={route("minatbakat.teswartegg")}>
                            Tes Wartegg
                        </Link>
                    </li>
                    <li>{title}</li>
                </ul>
            </div>

            <section className="pb-8">
                <header className="mb-6">
                    <h1 className="text-2xl font-semibold text-curious-blue-500">
                        Hasil Tes Wartegg
                    </h1>
                </header>
                <div className="grid grid-cols-2 lg:grid-cols-3 gap-2">
                    {hasil_wartegg.map((wartegg) => (
                        <div
                            className="bg-white p-4 shadow-md rounded-md cursor-pointer hover:bg-slate-300 duration-150 transition-all flex flex-col items-start justify-between"
                            key={wartegg.id}
                            onClick={() => handleOnClickDetailWartegg(wartegg)}
                        >
                            <img src={wartegg.img_url} alt={wartegg.filename} />
                            <div className="mt-4">
                                <span
                                    className={`text-white ${
                                        wartegg.status == "pending"
                                            ? "bg-rose-500"
                                            : "bg-emerald-500"
                                    } rounded-md px-2 py-1 mt-2`}
                                >
                                    {wartegg.status}
                                </span>
                                <p className="text-slate-400 text-sm mt-4">
                                    {new Intl.DateTimeFormat("id", {
                                        dateStyle: "full",
                                    }).format(new Date(wartegg.created_at))}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </section>
            {openModal == true && currentWartegg !== null && (
                <>
                    <div
                        className="fixed w-full min-h-screen bg-black opacity-30 top-0 left-0 z-50"
                        onClick={() => setOpenModal(false)}
                    ></div>
                    <section className="bg-white p-8 rounded-md shadow-md fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl z-50">
                        <header className="flex justify-between items-center">
                            <h1 className="font-semibold text-curious-blue text-xl">
                                Detail Hasil Tes Wartegg
                            </h1>
                            <div>
                                <button
                                    className="m-0 p-0"
                                    onClick={() => setOpenModal(false)}
                                >
                                    <XIcon className="fill-rose-400 hover:fill-rose-500" />
                                </button>
                            </div>
                        </header>
                        <div>
                            <img
                                src={currentWartegg.img_url}
                                alt={currentWartegg.filename}
                                className="max-w-sm w-full mx-auto my-4"
                            />
                            {currentWartegg.analysis ? (
                                <div className="my-4">
                                    <h4 className="text-lg text-curious-blue font-semibold">
                                        Analisis
                                    </h4>
                                    <p className="text-sm md:text-base">
                                        {currentWartegg.analysis}
                                    </p>
                                </div>
                            ) : (
                                <div className="my-4">
                                    <h4>
                                        Gambar belum{" "}
                                        <span className="text-rose-500">
                                            dianalisis
                                        </span>{" "}
                                        oleh Admin, mohon tunggu giliran
                                        analisis
                                    </h4>
                                </div>
                            )}
                            <span
                                className={`text-white ${
                                    currentWartegg.status == "pending"
                                        ? "bg-rose-500"
                                        : "bg-emerald-500"
                                } rounded-md px-2 py-1 mt-2`}
                            >
                                {currentWartegg.status}
                            </span>
                        </div>
                    </section>
                </>
            )}
        </AuthenticatedLayout>
    );
}
