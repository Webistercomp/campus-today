import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Payment({ auth, title, packet }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link href={route("paket.index")}>Beli Paket</Link>
                    </li>
                    <li>
                        <Link href={route("paket.show", packet.id)}>
                            {packet.name}
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
                        <Link
                            href={route('paket.checkout', packet.id)}
                            className="btn"
                        >
                            Kembali
                        </Link>
                        <Link
                            href={route('paket.verification', packet.id)}
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
