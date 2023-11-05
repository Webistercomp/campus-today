import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { useState } from "react";
import TryOutContent from "./Test";

export default function ConfirmTryOut({ auth, title, user_id, tryout }) {
    const [isReady, setIsReady] = useState(false);
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            {/* Open the modal using document.getElementById('ID').showModal() method */}
            <dialog id="confirmation-modal" className="modal">
                <div className="modal-box">
                    <h3 className="font-bold text-lg">
                        Kofirmasi mengerjakan TryOut
                    </h3>
                    <p className="py-4">
                        Klik tombol mulai untuk mulai mengerjakan soal
                    </p>
                    <div className="modal-action">
                        <form method="dialog" className="flex gap-4">
                            <button className="btn">Tidak</button>
                            <Link href={route("tryout.start", [user_id, tryout.id])} method="POST">
                                <button className="btn btn-primary">
                                    Mulai
                                </button>
                            </Link>
                        </form>
                    </div>
                </div>
            </dialog>

            {!isReady ? (
                <section className="mt-6">
                    <h1 className="text-3xl text-curious-blue font-semibold">
                        Soal TryOut {tryout.name}
                    </h1>

                    <div className="mt-6">
                        <ol className="list-decimal list-inside [&>li]:mb-4">
                            <li>Waktu pengerjaan soal Try Out SKD {tryout.time} Menit</li>
                            <li>
                                Jumlah soal SKD {tryout.jumlah_soal} soal, yang terdiri dari 3 (tiga)
                                bagian sub tes antara lain:
                                <ol className="list-inside list-lower-alpha">
                                    <li>
                                        Tes Wawasan Kebangsaan (TWK) : {tryout.jumlah_twk} Soal
                                    </li>
                                    <li>
                                        Tes Intelegensia Umum (TIU) : {tryout.jumlah_tiu} Soal
                                    </li>
                                    <li>
                                        Tes Karakteristik Pribadi (TKP) : {tryout.jumlah_tkp} Soal
                                    </li>
                                </ol>
                            </li>
                            <li>
                                Perhatikan Ambang Batas dari setiap sub tes:
                                <ol className="list-inside list-lower-alpha">
                                    <li>Tes Wawasan Kebangsaan (TWK) : 65</li>
                                    <li>Tes Intelegensia Umum (TIU) : 80</li>
                                    <li>
                                        Tes Karakteristik Pribadi (TKP) : 156
                                    </li>
                                </ol>
                            </li>
                            <li>
                                Pembobotan Nilai Tes SKD
                                <ul className="list-inside list-stripe">
                                    <li>
                                        TKP benar bernilai paling rendah 1.
                                        paling tinggi 5, dan tidak menjawab 0
                                        (nol)
                                    </li>
                                    <li>
                                        TIU dan TWK benar bernilai 5 dan salah
                                        atau tidak menjawab bernilai 0 (nol)
                                    </li>
                                </ul>
                            </li>
                        </ol>
                    </div>

                    <div className="flex gap-4">
                        <Link href={route("tryout.type", tryout.material_type.code)}>
                            <button className="btn capitalize">
                                &laquo; Kembali
                            </button>
                        </Link>
                        <button
                            className="btn btn-primary capitalize text-white"
                            onClick={() =>
                                document
                                    .getElementById("confirmation-modal")
                                    .showModal()
                            }
                        >
                            Mulai &raquo;
                        </button>
                    </div>
                </section>
            ) : (
                <TryOutContent />
            )}
        </AuthenticatedLayout>
    );
}
