import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function SkdTeksTwk({
    auth,
    title,
    type,
    material,
    chapters,
    chapter,
    nextChapter,
}) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <section className="mt-4 w-1/5 float-left fixed top-28 pr-8 flex flex-col pb-8 h-[calc(100vh_-_200px)]">
                <Link href={material.type == 'teks' ? route('material.type.teks', type) : route('material.type.video', type)} className="link-hover">
                    &laquo; Kembali ke Materi
                </Link>

                <h1 className="text-3xl text-curious-blue font-semibold mt-4">
                    {title}
                </h1>

                <div className="flex flex-col gap-2 mt-6 overflow-y-scroll scrollbar-hide flex-auto">
                    {chapters.map(
                        function (chap, i) {
                            if (chap.id == chapter.id) {
                                return (
                                    <a
                                        className="btn materi materi-active capitalize"
                                        key={i}
                                        href={route(
                                            "material.type.teks.subtype",
                                            [type, material.code, chap.id]
                                        )}
                                    >
                                        {chap.judul}
                                    </a>
                                );
                            } else {
                                return (
                                    <a
                                        className="btn materi capitalize"
                                        key={i}
                                        href={route(
                                            "material.type.teks.subtype",
                                            [type, material.code, chap.id]
                                        )}
                                    >
                                        {chap.judul}
                                    </a>
                                );
                            }
                        }.bind()
                    )}
                </div>
            </section>

            <section className="mt-8 float-right w-4/5 relative pl-10 py-16 flex flex-col">
                <div>
                    <h5 className="judul-materi">{chapter.judul}</h5>
                    <h6 className="subjudul-materi">{chapter.subjudul}</h6>
                    <p className="isi-materi">{chapter.body}</p>
                </div>
                {nextChapter ? (
                    <Link
                        href={route("material.type.teks.subtype", [
                            type,
                            material.code,
                            nextChapter.id,
                        ])}
                        className="btn btn-primary text-white capitalize mt-6 self-end px-6"
                    >
                        Lanjut &raquo;
                    </Link>
                ) : (
                    <Link
                        href={route("material.complete", material.id)}
                        className="btn btn-primary text-white capitalize mt-6 self-end px-6"
                    >
                        Lanjut &raquo;
                    </Link>
                )}
            </section>
        </AuthenticatedLayout>
    );
}
