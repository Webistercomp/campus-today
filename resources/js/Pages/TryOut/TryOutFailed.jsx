import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import WebinarPana from "@/images/webinar-pana.png";

export default function TryOutFailed({ title, name }) {
    return (
        <AuthenticatedLayout>
            <Head title={title} />

            <section className="mx-auto max-w-lg text-center mt-10">
                <h1 className="uppercase text-curious-blue text-2xl font-bold">
                    COMPLETED!!
                </h1>
                <img
                    src={WebinarPana}
                    alt=""
                    className="mx-auto aspect-auto w-4/5"
                />
                <p className="text-slate-700 font-semibold my-4">
                    Semangat ya <span className="underline">{name}</span>, Kamu
                    pasti bisa, ayo coba lagi
                </p>
                <h2 className="text-error font-bold text-2xl mb-4">
                    TIDAK LULUS
                </h2>
                <div className="flex flex-col w-1/4 gap-2 mx-auto">
                    <Link href={route("dashboard")}>
                        <button className="btn btn-primary text-white shadow-lg capitalize">
                            Home
                        </button>
                    </Link>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
