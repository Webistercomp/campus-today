import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import StatusTesWartegg from "./Status";

export default function HasilWartegg({ auth, title, hasil_wartegg }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link href={route("minatbakat")}>Tes Minat Bakat</Link>
                    </li>
                    <li>
                        <Link href={route("minatbakat.teswartegg")}>
                            Tes Wartegg
                        </Link>
                    </li>
                    <li>{title}</li>
                </ul>
            </div>

            {hasil_wartegg && hasil_wartegg.status === "completed" ? (
                <section>
                    <img
                        src={hasil_wartegg.img_url}
                        alt=""
                        className="w-full max-w-xl mx-auto"
                    />
                    <div>
                        <h1 className="text-curious-blue font-semibold mt-4">
                            Analisis Hasil Jawaban
                        </h1>
                        <p>{hasil_wartegg.analysis}</p>
                    </div>
                </section>
            ) : (
                <StatusTesWartegg hasil_wartegg={hasil_wartegg} />
            )}
        </AuthenticatedLayout>
    );
}
