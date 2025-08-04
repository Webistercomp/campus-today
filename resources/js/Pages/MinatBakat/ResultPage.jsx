import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import CompletedPana from "@/images/completed-pana.png";

export default function MinatBakatResultPage({
    auth,
    title,
    result,
    minatbakat,
}) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <section>
                <section className="flex flex-col items-center">
                    <h1 className="text-2xl text-curious-blue font-semibold text-center">
                        Completed!!
                    </h1>
                    <img
                        src={CompletedPana}
                        alt="completed_img"
                        className="w-full max-w-xs mx-auto"
                    />
                    {minatbakat.type !== "epps" ? (
                        <>
                            <p className="w-full max-w-xl mx-auto text-center">
                                Anda telah menyelesaikan{" "}
                                <span className="font-semibold">
                                    {minatbakat.title}
                                </span>{" "}
                                dengan nilai
                            </p>
                            <h6 className="text-3xl font-semibold text-curious-blue">
                                {result.score}
                            </h6>
                            <p>
                                <span className="font-semibold text-curious-blue">
                                    {result.jumlah_benar} soal benar
                                </span>
                                ,{" "}
                                <span className="font-semibold text-error">
                                    {result.jumlah_salah} soal salah
                                </span>{" "}
                                dan{" "}
                                <span className="font-semibold text-slate-500">
                                    {result.jumlah_kosong} soal kosong
                                </span>
                            </p>
                        </>
                    ) : (
                        <>
                            <p className="w-full max-w-xl mx-auto text-center">
                                Anda telah menyelesaikan{" "}
                                <span className="font-semibold">
                                    Tes {minatbakat.title}
                                </span>{" "}
                                dengan hasil sebagai berikut
                            </p>
                            <h6>HASIL TES EPPS</h6>
                        </>
                    )}
                    <Link
                        href={route("minatbakat")}
                        as="button"
                        className="btn btn-primary text-white px-8 mt-2"
                    >
                        Kembali ke Minat Bakat
                    </Link>
                </section>
            </section>
        </AuthenticatedLayout>
    );
}
