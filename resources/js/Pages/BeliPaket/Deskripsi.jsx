import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import CheckIcon from "@/icons/CheckIcon";
import XIcon from "@/icons/XIcon";
import { Head, Link } from "@inertiajs/react";
import EWallet from "@/images/e-wallet-rafiki.png";

export default function Deskripsi({ title, nama_paket }) {
    const deskripsiPaket = {
        type: "Friendly",
        price: 120000,
        benefit: [
            "Akses Tryout Gratis",
            "Try Out Premium SKD Sistem CAT",
            "Try Out Premium UTBK",
            "Kunci dan Pembahasan Try Out Lengkap",
            "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
            "Latihan Soal UTBK",
            "Materi SKD, UTBK, UM Terupdate",
            "Ranking Try Out Nasional",
        ],
        nonBenefit: [
            "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
            "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
            "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
            "Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.",
            "Video Series SKD, UTBK, dan UM",
        ],
        isPopular: true,
    };

    return (
        <AuthenticatedLayout>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link href={route("belipaket")}>Beli Paket</Link>
                    </li>
                    <li>{nama_paket}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {nama_paket}
                </h1>
                <div className="flex gap-8">
                    <div className="basis-3/5 mt-8">
                        <h6 className="text-slate-800 w-fit mb-4 custom-underline">
                            Deskripsi
                        </h6>
                        <hr />
                        <table className="text-left mt-6 text-sm">
                            {deskripsiPaket.benefit.map((str) => (
                                <tr className="flex items-start gap-2 mb-[2px]">
                                    <td>
                                        <CheckIcon
                                            className={`fill-black self-start`}
                                        />
                                    </td>
                                    <td>
                                        <span className="basis-[85%]">
                                            {str}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                            {deskripsiPaket.nonBenefit.map((str) => (
                                <tr className="flex items-start gap-2 mb-[2px]">
                                    <td>
                                        <XIcon className="fill-red-500 self-start" />
                                    </td>
                                    <td>
                                        <span className="basis-[85%]">
                                            {str}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                        </table>
                    </div>
                    <div className="basis-2/5 flex flex-col justify-center border-curious-blue border-2 rounded-xl text-center py-6 px-20">
                        <img
                            src={EWallet}
                            alt="E-Wallet Illustration"
                            className="mx-auto aspect-auto w-72"
                        />
                        <h1 className="text-xl font-semibold text-slate-800">
                            Paket Bimbel
                        </h1>
                        <h2 className="text-3xl font-semibold text-curious-blue">
                            {deskripsiPaket.type}
                        </h2>
                        <p className="text-2xl font-semibold text-slate-800 mt-2 mb-8">
                            Rp.{" "}
                            {new Intl.NumberFormat("id-ID").format(
                                deskripsiPaket.price
                            )}
                        </p>
                        <Link
                            href={route(
                                `belipaket.${nama_paket.toLowerCase()}.checkout`
                            )}
                        >
                            <button className="btn btn-primary">
                                Beli Sekarang
                            </button>
                        </Link>
                    </div>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
