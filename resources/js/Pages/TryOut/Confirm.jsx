import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { useState } from "react";
import TryOutContent from "./Test";
import axios from 'axios';

export default function ConfirmTryOut({ auth, title, user_id, tryout, jumlah_soal, code }) {
    const [isReady, setIsReady] = useState(false);

    const start_tryout = async () => {
        const postData = await axios.post(route('tryout.start', tryout.id), {
            tryout_id: tryout.id,
            user_id: user_id
        })
        if(postData.status == 200) {
            document.getElementById("confirmation-modal").close();
            if(tryout.is_event) {
                window.location.href = route('event-tryout.test', tryout.id);
            } else {
                window.location.href = route('tryout.test', tryout.id);
            }
        }
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

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
                        </form>
                        <button 
                            className="btn btn-primary"
                            as="button"
                            onClick={start_tryout}>
                            Mulai
                        </button>
                    </div>
                </div>
            </dialog>

            {!isReady ? (
                <section className="mt-6">
                    <h1 className="text-3xl text-curious-blue font-semibold">
                        Soal TryOut {tryout.name}
                    </h1>

                    {(code == 'skd' || code == 'skb') ? (
                        <div className="mt-6">
                            <ol className="list-decimal list-inside [&>li]:mb-4">
                                <li>
                                    Waktu pengerjaan soal Try Out {code.toUpperCase()} {tryout.time}{" "}
                                    Menit
                                </li>
                                <li>
                                    Jumlah soal {code.toUpperCase()} {tryout.jumlah_soal} soal, yang
                                    terdiri dari 3 (tiga) bagian sub tes antara
                                    lain:
                                    <ol className="list-inside list-lower-alpha">
                                        <li>
                                            Tes Wawasan Kebangsaan (TWK) :{" "}
                                            {jumlah_soal.twk} Soal
                                        </li>
                                        <li>
                                            Tes Intelegensia Umum (TIU) :{" "}
                                            {jumlah_soal.tiu} Soal
                                        </li>
                                        <li>
                                            Tes Karakteristik Pribadi (TKP) :{" "}
                                            {jumlah_soal.tkp} Soal
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
                        ) : ('')
                    }

                    {(code == 'um' || code == 'utbk') ? (
                        <div className="mt-6">
                            <ol className="list-decimal list-inside [&>li]:mb-4">
                                <li>
                                    Waktu pengerjaan soal Try Out {code.toUpperCase()} {tryout.time}{" "}
                                    Menit
                                </li>
                                <li>
                                    Jumlah soal {code.toUpperCase()} {tryout.jumlah_soal} soal, yang
                                    terdiri dari 4 (tiga) bagian sub tes antara
                                    lain:
                                    <ol className="list-inside list-lower-alpha">
                                        <li>
                                            Matematika :{" "}
                                            {jumlah_soal.mtk} Soal
                                        </li>
                                        <li>
                                            Fisika :{" "}
                                            {jumlah_soal.fis} Soal
                                        </li>
                                        <li>
                                            Biologi :{" "}
                                            {jumlah_soal.bio} Soal
                                        </li>
                                        <li>
                                            Kimia :{" "}
                                            {jumlah_soal.kim} Soal
                                        </li>
                                    </ol>
                                </li>
                                <li>
                                    Pembobotan Nilai Tes {code.toUpperCase()}
                                    <ul className="list-inside list-stripe">
                                        <li>
                                            Benar bernilai 1, salah atau tidak menjawab bernilai 0 (nol) 
                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                        ) : ('')
                    }

                    <div className="flex gap-4">
                        <Link
                            href={route(
                                "tryout.type",
                                tryout.material_type.code
                            )}
                        >
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
