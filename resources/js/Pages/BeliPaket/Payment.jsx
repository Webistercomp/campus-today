import Alert from "@/Components/Alert";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, router } from "@inertiajs/react";
import axios from "axios";
import { useState } from "react";

export default function Payment({ auth, title, packet, user_data }) {
    const [paymentProof, setPaymentProof] = useState(null);
    const [isLoading, setIsLoading] = useState(false);
    const [alertData, setAlertData] = useState({
        type: "success",
        isShow: false,
        msg: "",
    });

    const onChangePaymentProof = (ev) => {
        setPaymentProof(ev.target.files[0]);
    };

    const onSubmitPaymentProof = async () => {
        if (paymentProof === null) {
            setAlertData({
                type: "error",
                isShow: true,
                msg: "Silahkan upload bukti pembayaran!",
            });

            return setTimeout(() => {
                setAlertData((prev) => {
                    return { ...prev, isShow: false };
                });
            }, 2000);
        }

        setIsLoading(true);

        const submitData = {
            packet_id: packet.id,
            user_id: auth.user.id,
            payment_method: user_data.payment_method,
            bukti_pembayaran: paymentProof,
        };
        console.log('user_data: ', user_data)
        console.log('submit data: ', submitData)

        try {
            const submit = axios.post(route("paket.store"), submitData);
            const response = await submit;
            console.log(response);

            return router.post(route("paket.verification", packet.id));
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

            <section className="pb-8">
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {title}
                </h1>
                <div className="border-2 p-6 rounded-2xl max-w-4xl mt-6 text-center text-slate-800 mx-auto">
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

            <Alert {...alertData} />
        </AuthenticatedLayout>
    );
}
