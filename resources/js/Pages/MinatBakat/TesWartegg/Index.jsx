import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, router } from "@inertiajs/react";
import { useEffect, useState } from "react";
import WarteggTestQuestionSample from "@/images/wartegg-test-img.png";
import ArrowUpTray from "@/icons/ArrowUpTray";
import ArrowDownTray from "@/icons/ArrowDownTray";
import Alert from "@/Components/Alert";
import CheckIcon from "@/icons/CheckIcon";
import axios from "axios";

export default function TesWartegg({ auth, title }) {
    const [isStart, setIsStart] = useState(false);
    const [userAnswer, setUserAnswer] = useState(null);
    const [alertData, setAlertData] = useState({
        type: "success",
        isShow: false,
        msg: "",
    });

    const handleOnClickDownloadImage = () => {
        const img = document.querySelector("#wartegg-question");
        fetch(img.getAttribute("src"), { method: "GET", headers: {} })
            .then((response) =>
                response.arrayBuffer().then((buffer) => {
                    const url = window.URL.createObjectURL(new Blob([buffer]));
                    const link = document.createElement("a");
                    link.href = url;
                    link.setAttribute(
                        "download",
                        "Soal Tes Wartegg_Campus Today.jpeg"
                    );
                    document.body.appendChild(link);
                    link.click();
                })
            )
            .catch((err) => console.log(err));
    };

    const handleOnChangeUserAnswerImage = (ev) => {
        return setUserAnswer(ev.target.files[0]);
    };

    const handleOnUploadUserAnswerImage = () => {
        if (!userAnswer) {
            setAlertData({
                type: "error",
                isShow: true,
                msg: "Anda belum memilih file yang ingin diupload",
            });

            return setTimeout(() => {
                setAlertData((prev) => {
                    return { ...prev, isShow: false };
                });
            }, 3000);
        }

        const newFileName = `Tes Wartegg_${auth.user.name}_${Date.now()}.jpeg`;

        const formData = new FormData();
        formData.append("image", userAnswer, newFileName);
        axios
            .post(route("minatbakat.teswartegg.store"), formData)
            .then((response) => {
                const data = response.data;
                if (data.status === "success") {
                    return router.get(route("minatbakat.teswartegg.hasil"));
                }
            })
            .catch((err) => {
                const data = err.response.data.errors;
                setAlertData({
                    isShow: true,
                    msg:
                        data.image[0] &&
                        "Ukuran file gambar tidak boleh lebih dari 1 Mb",
                    type: "error",
                });
            })
            .finally(() => {
                setTimeout(() => {
                    setAlertData({ ...alertData, isShow: false });
                }, 3000);
            });
    };

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
                    <li>{title}</li>
                </ul>
            </div>

            {isStart === false ? (
                <section>
                    <h1 className="text-3xl text-curious-blue font-semibold text-center my-4">
                        {title}
                    </h1>
                    <p>
                        Kalian akan diberikan komponen gambar yang telah
                        dikelompokkan pada sebuah kotak dan kamu akan diminta
                        untuk melengkapi komponen tersebut, menjadi sebuah
                        gambar. Gambar tersebut harus berada di dalam kotak dan
                        kamu bisa mengkreasikannya sesuai apa yang ada di
                        pikiranmu. Masing-masing kotak memiliki makna
                        tersendiri. berikut adalah langkah pengerjaan
                    </p>
                    <p>
                        <ol className="list-decimal list-inside">
                            <li>Download gambar Wartegg test</li>
                            <li>
                                Lengkapi gambar tersebut, bisa di print maupun
                                tidak
                            </li>
                            <li>
                                Upload kembali gambar yang telah Anda lengkapi
                            </li>
                        </ol>
                    </p>
                    <p>
                        Jika sudah mengerjakan bisa{" "}
                        <Link
                            href={route("minatbakat.teswartegg.hasil")}
                            className="link link-primary"
                        >
                            Lihat Hasil Tes
                        </Link>
                    </p>
                    <div className="flex gap-8 mt-14">
                        <Link
                            href={route("minatbakat")}
                            as="button"
                            className="btn"
                        >
                            &laquo; Kembali
                        </Link>
                        <button
                            className="btn btn-primary"
                            onClick={() => setIsStart(true)}
                        >
                            Mulai &raquo;
                        </button>
                    </div>
                </section>
            ) : (
                <section>
                    <div className="flex flex-col">
                        <button
                            href="#"
                            as="button"
                            className="btn btn-sm capitalize bg-white text-curious-blue shadow-lg self-end"
                            onClick={() => handleOnClickDownloadImage()}
                        >
                            <ArrowDownTray className="w-4 h-4" />
                            Download Gambar
                        </button>
                        <img
                            src={WarteggTestQuestionSample}
                            alt="Wartegg Test Sample Question"
                            className="w-full max-w-xl mx-auto"
                            id="wartegg-question"
                        />
                    </div>
                    <div className="flex flex-col w-full max-w-xs gap-2 mt-4 mx-auto">
                        <label className="btn btn-primary text-white capitalize shadow-lg flex items-center">
                            {userAnswer && <CheckIcon className="fill-white" />}
                            <span>Pilih Gambar Jawaban</span>
                            <input
                                type="file"
                                className="hidden"
                                onChange={(ev) =>
                                    handleOnChangeUserAnswerImage(ev)
                                }
                                accept=".jpeg,.jpg,.png"
                            />
                        </label>
                        <button
                            className="btn capitalize bg-white text-curious-blue shadow-lg"
                            onClick={handleOnUploadUserAnswerImage}
                        >
                            <ArrowUpTray className="w-5 h-5" />
                            Upload & Selesai
                        </button>
                    </div>
                </section>
            )}

            <Alert {...alertData} />
        </AuthenticatedLayout>
    );
}
