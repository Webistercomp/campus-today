import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import DoneRafiki from "@/images/done-rafiki.png";
import { useEffect } from "react";

export default function LatihanResult({
    auth,
    title,
    latihan,
    jumlah_benar,
    jumlah_salah,
    jumlah_tidak_diisi,
    latihan_user_data,
}) {
    const { type, materialId, materialCode, nextChapterId } = JSON.parse(
        localStorage.getItem("ACTIVE_CHAPTER")
    );

    const latihanData = latihan_user_data.map((userSoal) => {
        const fitleredData = latihan.questions.find(
            (q) => userSoal.question_id === q.id
        );
        return { ...fitleredData, jawaban: userSoal.answer_id };
    });

    useEffect(() => {
        const doc = document.querySelector("html");
        doc.style.scrollPaddingTop = "56px";
    }, []);

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
                    Selamat <span className="underline">{auth.user.name}</span>,
                    Anda telah menyelesaikan {latihan.name}
                </p>
                <p>
                    Anda menjawab{" "}
                    <span className="text-curious-blue font-semibold">
                        {jumlah_benar} soal benar
                    </span>
                    ,{" "}
                    <span className="text-error font-semibold">
                        {jumlah_salah} soal salah
                    </span>
                    , dan{" "}
                    <span className="text-slate-400 font-semibold">
                        {jumlah_tidak_diisi} soal tidak diisi
                    </span>
                </p>
            </section>

            <section className="pt-14" id="pembahasan">
                <h1 className="text-curious-blue font-bold text-xl">
                    Pembahasan
                </h1>
                <ol className="list-decimal ml-4 mt-4">
                    {latihanData.map((soal, i) => (
                        <li className="mb-8" key={i}>
                            <p>{soal.question}</p>
                            <p>
                                Jawaban anda :{" "}
                                {
                                    soal.jawaban ?
                                    soal.answers.find(
                                        (a) => parseInt(soal.jawaban) === a.id
                                    ).answer :
                                    "Tidak diisi"
                                }
                            </p>
                            <ol className="list-upper-alpha list-inside grid grid-cols-3 gap-2 my-2 ml-0">
                                {soal.answers.map((choice) => (
                                    <label
                                        htmlFor={`${soal.id}_choices_${choice.id}`}
                                        key={choice.id}
                                    >
                                        <input
                                            type="radio"
                                            name={`${soal.id}_choices`}
                                            id={`${soal.id}_choices_${choice.id}`}
                                            className="peer hidden"
                                            value={choice.id}
                                            checked={
                                                choice.bobot === 1
                                                    ? true
                                                    : false
                                            }
                                            readOnly
                                        />
                                        <li
                                            className={`border-2 border-curious-blue px-8 py-3 rounded-md transition-all duration-75 peer-checked:text-white peer-checked:bg-emerald-500 peer-checked:border-emerald-500 ${
                                                parseInt(soal.jawaban) ===
                                                choice.id
                                                    ? choice.bobot === 0
                                                        ? "bg-error border-error text-white"
                                                        : "bg-white"
                                                    : ""
                                            }`}
                                        >
                                            {choice.answer}
                                        </li>
                                    </label>
                                ))}
                            </ol>
                            <p className="mt-4">Pembahasan : </p>
                            <p>{soal.pembahasan}</p>
                        </li>
                    ))}
                </ol>
            </section>

            <div className="flex flex-col w-1/4 gap-2 mx-auto mb-10">
                {nextChapterId ? (
                    <Link
                        href={route("material.type.teks.subtype", [
                            type,
                            materialCode,
                            nextChapterId,
                        ])}
                    >
                        <button className="btn bg-white shadow-lg capitalize">
                            Materi selanjutnya
                        </button>
                    </Link>
                ) : (
                    <Link href={route("material.complete", materialId)}>
                        <button className="btn bg-white shadow-lg capitalize">
                            Materi Selesai
                        </button>
                    </Link>
                )}
            </div>
        </AuthenticatedLayout>
    );
}
