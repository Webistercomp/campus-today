import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import CompletedImg from "@/images/completed-pana.png";
import { Head, Link } from "@inertiajs/react";

export default function Completed({ auth, title, user, material }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <section className="mx-auto max-w-lg text-center mt-10">
                <h1 className="uppercase text-curious-blue text-2xl font-bold">
                    SELAMAT {user.name}
                </h1>
                <img
                    src={CompletedImg}
                    alt=""
                    className="mx-auto aspect-auto w-3/5"
                />
                <p className="text-slate-700 font-semibold">
                    Telah menyelesaikan kelas
                </p>
                <h2 className="text-curious-blue font-bold text-2xl mb-4">
                    {material.title}
                </h2>
                <div className="flex flex-col w-1/4 gap-2 mx-auto">
                    <Link
                        href={route("dashboard")}
                        className="btn btn-primary shadow-lg"
                    >
                        Kelas
                    </Link>
                    <button className="btn bg-white shadow-lg">Try Out</button>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
