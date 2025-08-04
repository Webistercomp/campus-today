import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DoneRafiki from "@/images/done-rafiki.png";

export default function TryOutSelesai({ auth, title, user, tryout_history, tryout }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <section className="mx-auto max-w-lg text-center mt-10">
                <h1 className="uppercase text-curious-blue text-2xl font-bold">
                    COMPLETED!!
                </h1>
                <img
                    src={DoneRafiki}
                    alt=""
                    className="mx-auto aspect-auto w-4/5"
                />
                {(tryout_history.is_lulus == 1 && (tryout.material_type_id == 2 || tryout.material_type_id == 3)) ? 
                    (
                        <div>
                            <p className="text-slate-700 font-semibold my-4">
                                Selamat <span className="underline">{user.name}</span>, Anda
                            </p>
                            <h2 className="text-curious-blue font-bold text-2xl">LULUS</h2>
                            <p>
                                dengan score{" "}
                                <span className="text-curious-blue font-semibold">
                                    {tryout_history.score}
                                </span>
                            </p>
                        </div>
                    ) : ''
                }
                {(tryout_history.is_lulus == 0 && (tryout.material_type_id == 2 || tryout.material_type_id == 3)) ? 
                    (
                        <div>
                            <p className="text-slate-700 font-semibold my-4">
                            Semangat ya <span className="underline">{name}</span>, Kamu
                    pasti bisa, ayo coba lagi
                            </p>
                            <h2 className="text-error font-bold text-2xl mb-4">
                                TIDAK LULUS
                            </h2>
                            <p>
                                dengan score{" "}
                                <span className="text-curious-blue font-semibold">
                                    {tryout_history.score}
                                </span>
                            </p>
                        </div>
                    ) : ''
                }
                {(tryout.material_type_id != 2 && tryout.material_type_id != 3) ? 
                    (
                        <div>
                            <p className="text-slate-700 font-semibold my-4">
                                Selamat <span className="underline">{user.name}</span>, Anda telah menyelesaikan Try Out
                            </p>
                            <h2 className="text-curious-blue font-bold text-2xl">SELESAI</h2>
                            <p>
                                dengan score{" "}
                                <span className="text-curious-blue font-semibold">
                                    {tryout_history.score}
                                </span>
                            </p>
                        </div>
                    ) : ''
                }
                <div className="flex gap-2 mx-auto justify-center">
                    <Link
                        href={route("tryout.insight", tryout_history.id)}
                        className="btn btn-primary shadow-lg capitalize"
                    >
                        Pembahasan
                    </Link>
                    <Link href={route("dashboard")}>
                        <button className="btn bg-white shadow-lg capitalize">
                            Home
                        </button>
                    </Link>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
