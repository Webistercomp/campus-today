import { Head, Link } from "@inertiajs/react";
import CompletedPana from "@/images/completed-pana.png";
export default function StatusTesWartegg({ hasil_wartegg }) {
    if (!hasil_wartegg) {
        return (
            <section className="flex flex-col items-center">
                <h1 className="text-2xl text-error font-semibold text-center">
                    OOPSS !!
                </h1>
                <p className="w-full max-w-xl mx-auto text-center my-4">
                    Anda sepertinya belum mengirimkan jawaban untuk Tes Wartegg,
                    mohon Upload jawaban anda terlebih dahulu
                </p>
                <Link
                    href={route("minatbakat.teswartegg")}
                    as="button"
                    className="btn btn-primary text-white px-8"
                >
                    Kembali ke Tes Wartegg
                </Link>
            </section>
        );
    }

    return (
        <section className="flex flex-col items-center">
            <h1 className="text-2xl text-curious-blue font-semibold text-center">
                Completed!!
            </h1>
            <img
                src={CompletedPana}
                alt="completed_img"
                className="w-full max-w-xs mx-auto"
            />
            <p className="w-full max-w-xl mx-auto text-center">
                Hasil tes kamu akan dikoreksi terlebih dahulu yaa, datang lagi
                untuk melihat hasilnya Maksimal Feedback 1 minggu
            </p>
            <Link
                href={route("dashboard")}
                as="button"
                className="btn btn-primary text-white px-8"
            >
                Beranda
            </Link>
        </section>
    );
}
