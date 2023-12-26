import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DoneRafiki from "@/images/done-rafiki.png";

export default function LatihanResult({
    auth,
    title,
    latihan,
    jumlah_benar,
    jumlah_salah,
    jumlah_tidak_diisi,
}) {
    const { type, materialId, materialCode, nextChapterId } = JSON.parse(
        localStorage.getItem("ACTIVE_CHAPTER")
    );

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
                    className="mx-auto aspect-auto w-3/5"
                />
                <p className="text-slate-700 font-semibold my-4">
                    Selamat <span className="underline">{auth.user.name}</span>,
                    Anda telah menyelesaikan {latihan.name}
                </p>
                <p>
                    Anda menjawab{" "}
                    <span className="text-curious-blue font-semibold">
                        {jumlah_benar} soal benar
                    </span>
                    ,{" "}
                    <span className="text-error font-semibold">
                        {jumlah_salah} soal salah
                    </span>
                    , dan{" "}
                    <span className="text-slate-400 font-semibold">
                        {jumlah_tidak_diisi} soal tidak diisi
                    </span>
                </p>
                <div className="flex flex-col w-1/4 gap-2 mx-auto">
                    <Link
                        href={route("tryout")}
                        className="btn btn-primary shadow-lg capitalize"
                    >
                        Pembahasan
                    </Link>
                    {nextChapterId ? (
                        <Link
                            href={route("material.type.teks.subtype", [
                                type,
                                materialCode,
                                nextChapterId,
                            ])}
                        >
                            <button className="btn bg-white shadow-lg capitalize">
                                Materi selanjutnya
                            </button>
                        </Link>
                    ) : (
                        <Link href={route("material.complete", materialId)}>
                            <button className="btn bg-white shadow-lg capitalize">
                                Materi Selesai
                            </button>
                        </Link>
                    )}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
