import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import ChevronRightIcon from "@/icons/ChevronRightIcon";
import { Head, Link } from "@inertiajs/react";
import { useState } from "react";

export default function SkdVideoTwk({
    auth,
    type,
    material,
    chapters,
    chapter,
    nextChapter,
}) {
    const [isOpenDrawer, setIsOpenDrawer] = useState(false);

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={material.title} />

            {isOpenDrawer && (
                <div
                    className="w-screen h-screen lg:hidden bg-black absolute top-0 left-0 opacity-10"
                    onClick={() => setIsOpenDrawer(false)}
                ></div>
            )}

            <div
                className={`flex lg:hidden flex-col gap-2 absolute bg-white h-screen top-0 left-0 pt-24 px-6 shadow-lg ${
                    isOpenDrawer === false
                        ? "-translate-x-full"
                        : "-translate-x-0"
                }  transition-all duration-150`}
            >
                {chapters.map((chap, i) => (
                    <a
                        className={`btn materi ${
                            chap.id === chapter.id && "materi-active"
                        } capitalize`}
                        key={i}
                        href={route("material.type.teks.subtype", [
                            type,
                            material.code,
                            chap.id,
                        ])}
                    >
                        {chap.judul}
                    </a>
                ))}
                <button
                    className="w-fit h-fit bg-curious-blue p-2 rounded-r-md absolute right-0 bottom-10 translate-x-full shadow-lg"
                    onClick={() => setIsOpenDrawer(!isOpenDrawer)}
                >
                    <ChevronRightIcon
                        className={`w-6 h-6 stroke-white ${
                            isOpenDrawer ? "rotate-180" : "rotate-0"
                        } transition-all duration-300`}
                    />
                </button>
            </div>

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

                <div className="flex mt-8 gap-8">
                    <div className="min-w-fit hidden lg:flex flex-col gap-2 h-[calc(100vh_-_220px)] overflow-y-hidden hover:overflow-y-scroll gutter-stable">
                        {chapters.map((chap, i) => (
                            <a
                                className={`btn materi ${
                                    chap.id === chapter.id && "materi-active"
                                } capitalize`}
                                key={i}
                                href={route("material.type.video.subtype", [
                                    type,
                                    material.code,
                                    chap.id,
                                ])}
                            >
                                {chap.judul}
                            </a>
                        ))}
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
                                className="aspect-video w-full md:w-2/3 xl:w-4/5"
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
