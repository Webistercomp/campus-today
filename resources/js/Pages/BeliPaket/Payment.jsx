import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, router } from "@inertiajs/react";
import axios from "axios";
import { useState } from "react";

export default function Payment({ auth, title, packet, user_data }) {
    const [paymentProof, setPaymentProof] = useState(null);
    const [isLoading, setIsLoading] = useState(false);
    const [isShowErrorAlert, setIsShowErrorAlert] = useState(false);

    const onChangePaymentProof = (ev) => {
        setPaymentProof(ev.target.files[0]);
    };

    const onSubmitPaymentProof = async () => {
        if (paymentProof === null) {
            setIsShowErrorAlert(true);

            return setTimeout(() => {
                setIsShowErrorAlert(false);
            }, 3000);
        }

        setIsLoading(true);

        const submitData = {
            packet_id: packet.id,
            user_id: auth.user.id,
            payment_method: user_data.payment_method,
            files: paymentProof,
        };

        try {
            const sumbit = axios.post(route("paket.store"), submitData);
            const response = await sumbit;
            console.log(response);

            return router.get(route("paket.verification", packet.id));
        } catch (err) {
            console.log(err);
        } finally {
            setIsLoading(false);
        }
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
                            onChange={(ev) => onChangePaymentProof(ev)}
                            accept=".jpg,.jpeg,.png"
                        />
                    </div>
                    <div className="flex justify-between mt-16">
                        <Link
                            href={route("paket.checkout", packet.id)}
                            className="btn"
                        >
                            Kembali
                        </Link>
                        <button
                            className="btn btn-primary"
                            onClick={onSubmitPaymentProof}
                        >
                            {isLoading ? (
                                <span className="loading loading-spinner loading-sm"></span>
                            ) : (
                                "Selanjutnya"
                            )}
                        </button>
                    </div>
                </div>
            </section>

            <div
                className={`alert alert-error w-fit fixed left-1/2 -translate-x-1/2 shadow-md transition-all duration-150 ${
                    isShowErrorAlert ? "top-24 opacity-100" : "top-0 opacity-0"
                }`}
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="stroke-current shrink-0 h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <span>Silahkan pilih bukti pembayaran!</span>
            </div>
        </AuthenticatedLayout>
    );
}
