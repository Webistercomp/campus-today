import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function SkdVideoTwk({ title }) {
    return (
        <AuthenticatedLayout>
            <Head title={title} />

            <section className="mt-4 w-1/5 float-left fixed top-28 pr-8 flex flex-col pb-8 h-[calc(100vh_-_200px)]">
                <Link className="link-hover" onClick={() => history.back()}>
                    &laquo; Kembali ke Materi
                </Link>

                <h1 className="text-3xl text-curious-blue font-semibold mt-4">
                    {title}
                </h1>

                <div className="flex flex-col gap-2 mt-6 overflow-y-scroll scrollbar-hide flex-auto">
                    <button className="btn materi materi-active capitalize">
                        Judul Materi Pertama
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Kedua
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Ketiga
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keempat
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Kelima
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                </div>
            </section>

            <section className="mt-8 float-right w-4/5 relative pl-10 flex flex-col">
                <div className="max-w-5xl">
                    <iframe
                        src="https://www.youtube.com/embed/0nfOlN9DoNw?si=iFu_9peG8XmvI1e1"
                        title="YouTube video player"
                        frameBorder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowFullScreen
                        className="aspect-video w-4/5"
                    ></iframe>
                </div>
                <button className="btn btn-primary text-white capitalize mt-6 self-end px-6">
                    Lanjut &raquo;
                </button>
            </section>
        </AuthenticatedLayout>
    );
}
