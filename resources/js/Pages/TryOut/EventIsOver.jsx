import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { useState } from "react";

export default function EventIsOver({ auth, title }) {

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

        <section className="mt-10">
            <h1 className="text-3xl text-curious-blue font-semibold">Event Tryout telah Selesai</h1>
            <h3 className="mt-4">Maaf, Event Tryout sudah berakhir. Tetap pantau untuk mengetahui event tryout berikutnya.</h3>
            <div className="mt-4">
                <Link
                    href={route('dashboard')}
                    className="btn btn-primary"
                    as="button">
                    Kembali ke Dashboard
                </Link>
            </div>
        </section>
        </AuthenticatedLayout>
    );
}
