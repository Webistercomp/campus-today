import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import ChevronRightIcon from "@/icons/ChevronRightIcon";
import { Head, Link } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function SkdVideoTwk({
    auth,
    type,
    material,
    chapters,
    chapter,
    nextChapter,
}) {
    const [isOpenDrawer, setIsOpenDrawer] = useState(false);

    useEffect(() => {
        localStorage.setItem(
            "ACTIVE_CHAPTER",
            JSON.stringify({
                type,
                materialId: material.id,
                materialCode: material.code,
                nextChapterId: nextChapter?.id,
            })
        );
    }, []);

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
                        href={route("material.type.video.subtype", [
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
                            <h6 className="subjudul-materi font-bold">
                                {chapter.subjudul}
                            </h6>
                            <div
                                className="isi-materi"
                                dangerouslySetInnerHTML={{
                                    __html: chapter.body,
                                }}
                            />
                            <div>
                                <div className="font-semibold">Video :</div>
                                {chapter.link === null ? (
                                    "Tidak ada video"
                                ) : (
                                    <iframe
                                        src={chapter.link}
                                        title={chapter.judul}
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowFullScreen
                                        className="aspect-video w-full md:w-2/3 xl:w-4/5"
                                    ></iframe>
                                )}
                            </div>
                        </div>
                        <Link
                            href={route("latihan.test", chapter.id)}
                            className="btn btn-grey text-dark capitalize mt-6 me-3 self-end px-6"
                        >
                            Latihan
                        </Link>
                        {nextChapter ? (
                            <Link
                                href={route("material.type.video.subtype", [
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
        </AuthenticatedLayout>
    );
}
