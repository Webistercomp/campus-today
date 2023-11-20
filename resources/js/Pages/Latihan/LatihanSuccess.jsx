import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DoneRafiki from "@/images/done-rafiki.png";

export default function LatihanSuccess({ auth, title, name }) {
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
                    Selamat <span className="underline">{name}</span>, Anda
                </p>
                <h2 className="text-curious-blue font-bold text-2xl mb-4">
                    LULUS
                </h2>
                <div className="flex flex-col w-1/4 gap-2 mx-auto">
                    <Link
                        href={route("tryout")}
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
