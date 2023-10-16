import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Payment({ title, nama_paket }) {
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
                    <li>
                        <Link href={route("belipaket.friendly")}>
                            {nama_paket}
                        </Link>
                    </li>
                    <li>Checkout</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {title}
                </h1>
                <div className="border-2 p-6 rounded-2xl mt-6 text-center text-slate-800">
                    <div>
                        <p>
                            Pembayaran dapat ditransfer melalui nomor rekening
                            berikut
                        </p>
                        <h3 className="text-4xl text-curious-blue mt-4">
                            1209187276344
                        </h3>
                    </div>
                    <div className="mt-8">
                        <p>Upload bukti pembayaran</p>
                        <input
                            type="file"
                            className="file-input file-input-bordered w-full max-w-xs mt-4"
                        />
                    </div>
                    <div className="flex justify-between mt-16">
                        <button className="btn">Kembali</button>
                        <Link
                            href={route(
                                `belipaket.${nama_paket.toLowerCase()}.checkout.verification`
                            )}
                        >
                            <button className="btn btn-primary">
                                Selanjutnya
                            </button>
                        </Link>
                    </div>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
