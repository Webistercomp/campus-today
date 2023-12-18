import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import EWallet from "@/images/e-wallet-rafiki.png";

export default function Verification({ auth, title, nama_paket }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <section className="flex flex-col gap-4 max-w-3xl mx-auto text-center items-center pb-8">
                <img
                    src={EWallet}
                    alt="E-Wallet Illustration"
                    className="aspect-auto w-56 md:w-64 lg:w-56 xl:w-full max-w-sm mx-auto"
                />
                <p>
                    Terima kasih telah melakukan pembayaran untuk paket{" "}
                    <span className="text-curious-blue font-semibold">
                        {nama_paket}
                    </span>
                    , proses akan dilanjutkan ke verifikasi admin selama 1x24
                    jam atau bisa menghubungi admin secara langsung melalui
                    Whatsapp di bawah ini <br /> <br />
                    <span className="text-curious-blue font-semibold text-xl">
                        08123456789
                    </span>
                </p>
                <div className="flex flex-col gap-2 mt-4">
                    <Link href={route("dashboard")}>
                        <button className="btn btn-primary w-full text-white">
                            Home
                        </button>
                    </Link>
                    <Link>
                        <button className="btn w-full">Chat Admin</button>
                    </Link>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
