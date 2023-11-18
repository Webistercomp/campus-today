import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function SkdVideoTwk({
    auth,
    type,
    material,
    chapters,
    chapter,
    nextChapter,
}) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={material.title} />

            <section>
                <div>
                    <Link
                        href={
                            material.type == "teks"
                                ? route("material.type.teks", type)
                                : route("material.type.video", type)
                        }
                        className="link-hover"
                    >
                        &laquo; Kembali ke Materi
                    </Link>
                    <h1 className="text-3xl text-curious-blue font-semibold mt-4">
                        {material.title}
                    </h1>
                </div>

                <div className="flex mt-8 gap-4">
                    <div className="min-w-fit flex flex-col gap-2 h-[calc(100vh_-_220px)] overflow-y-hidden hover:overflow-y-scroll gutter-stable">
                        {chapters.map(
                            function (chap, i) {
                                if (chap.id == chapter.id) {
                                    return (
                                        <a
                                            className="btn materi materi-active capitalize"
                                            key={i}
                                            href={route(
                                                "material.type.video.subtype",
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
                                                "material.type.video.subtype",
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
                    <div className="w-full h-[calc(100vh_-_220px)] overflow-y-scroll gutter-stable scrollbar-hide">
                        <div>
                            <h4 className="judul-materi">{chapter.judul}</h4>
                            <iframe
                                src={
                                    chapter.link
                                        ? chapter.link
                                        : "https://www.youtube.com/embed/0nfOlN9DoNw?si=iFu_9peG8XmvI1e1"
                                }
                                title={chapter.judul}
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowFullScreen
                                className="aspect-video w-4/5"
                            ></iframe>
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
                    </div>
                </div>
            </section>

            {/* <section className="mt-4 w-1/5 float-left fixed top-28 pr-8 flex flex-col pb-8 h-[calc(100vh_-_200px)]">
                <Link
                    className="link-hover"
                    href={route("material.type.video", [type])}
                >
                    &laquo; Kembali ke Materi
                </Link>

                <h1 className="text-3xl text-curious-blue font-semibold mt-4">
                    {material.title}
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
                                            "material.type.video.subtype",
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
                                            "material.type.video.subtype",
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

            <section className="mt-8 float-right w-4/5 relative pl-10 flex flex-col">
                <div className="max-w-5xl">
                    <h4 className="judul-materi">{chapter.judul}</h4>
                    <iframe
                        src={
                            chapter.link
                                ? chapter.link
                                : "https://www.youtube.com/embed/0nfOlN9DoNw?si=iFu_9peG8XmvI1e1"
                        }
                        title={chapter.judul}
                        frameBorder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowFullScreen
                        className="aspect-video w-4/5"
                    ></iframe>
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
            </section> */}
        </AuthenticatedLayout>
    );
}
