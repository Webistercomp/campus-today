import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function Latihan({ auth, title, user, latihan }) {
    const data = latihan.questions
    let no = 1;
    const [exerciseData, setExerciseData] = useState(() =>
        data.map((soal, i) => {
            return { ...soal, no: i + 1, jawaban: null };
        })
    );
    const [active, setActive] = useState(1);
    const [activeQuestion, setActiveQuestion] = useState(
        () => exerciseData.filter((soal) => soal.no === active)[0]
    );

    useEffect(() => {
        setActiveQuestion(exerciseData.filter((soal) => soal.no === active)[0]);
    }, [active, exerciseData]);

    const onAnswerQuestionHandler = (no, jawaban) => {
        const newData = exerciseData.map((q) => {
            if (q.no === no) {
                return { ...q, jawaban };
            }
            return q;
        });
        setExerciseData(newData);
    };

    const onChangeActiveQuestion = (value) => {
        return setActive((prev) => {
            if (prev + value === 0) {
                return 1;
            } else if (prev + value > exerciseData.length) {
                return prev;
            }

            return prev + value;
        });
    };

    const onSubmitAnswer = () => {
        const unAnsQuestion = exerciseData.filter((q) => q.jawaban === null);
        if (unAnsQuestion.length !== 0) {
            return document.getElementById("un_answer_modal").showModal();
        }

        return document.getElementById("confirm_send_ans_modal").showModal();
    };

    const onClickSubmitAnswer = async () => {
        const finalLatihanData = exerciseData.map((d) => {
            return { question_id: d.id, answer_id: d.jawaban };
        });
        const finalData = {
            latihan_id: latihan.id,
            user_id: user.id,
            latihan_data: finalLatihanData,
        }
        const postData = await axios.post(route("latihan.scoring"), {
            ...finalData
        })
        console.log(postData.data)
        return router.post(route("latihan.result", latihan.id), {
            data: postData.data
        })
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <section className="mt-6">
                <div className="flex w-full items-center justify-between">
                    <h1 className="text-3xl text-curious-blue font-semibold">
                        {title}
                    </h1>
                </div>

                <div className="flex mt-8">
                    <div className="min-w-fit grid grid-cols-3 gap-2 h-[calc(100vh_-_200px)] overflow-y-hidden hover:overflow-y-scroll gutter-stable p-2 content-start">
                        {exerciseData.map((q, i) => (
                            <div
                                className={`aspect-square flex items-center justify-center h-12 border-2 border-curious-blue-300 rounded-md hover:bg-curious-blue-300 hover:bg-opacity-20 transition-all duration-75 cursor-pointer ${
                                    q.jawaban !== null
                                        ? "bg-curious-blue-300 text-white hover:text-black"
                                        : "bg-white"
                                } ${
                                    active === i + 1
                                        ? "ring-2 ring-curious-blue-700"
                                        : "ring-0 ring-transparent"
                                }`}
                                key={i}
                                onClick={() => setActive(q.no)}
                            >
                                {no++}
                            </div>
                        ))}
                    </div>
                    <div className="pl-8">
                        <p className="text-curious-blue-300 font-bold text-3xl mb-4">
                            Soal ke-{activeQuestion.no}
                        </p>
                        <p className="text-lg">{activeQuestion.question}</p>
                        <ol className="list-upper-alpha list-inside grid grid-cols-2 gap-4 mt-8 ml-0">
                            {activeQuestion.answers.map((choice, i) => (
                                <label
                                    htmlFor={`${activeQuestion.no}_choices_${choice.id}`}
                                    key={choice.id}
                                >
                                    <input
                                        type="radio"
                                        name={`${activeQuestion.no}_choices`}
                                        id={`${activeQuestion.no}_choices_${choice.id}`}
                                        className="peer hidden"
                                        value={choice.id}
                                        onChange={(ev) => {
                                            onAnswerQuestionHandler(
                                                activeQuestion.no,
                                                ev.target.value
                                            );
                                        }}
                                        checked={
                                            parseInt(activeQuestion.jawaban) ===
                                            choice.id
                                                ? true
                                                : false
                                        }
                                        onClick={(ev) => {
                                            if (ev.target.checked) {
                                                onAnswerQuestionHandler(
                                                    activeQuestion.no,
                                                    null
                                                );
                                            }
                                        }}
                                    />
                                    <li className="border-2 border-curious-blue-300 px-8 py-3 rounded-md hover:bg-curious-blue-300 hover:bg-opacity-20 transition-all duration-75 cursor-pointer peer-checked:text-white peer-checked:bg-curious-blue-300">
                                        {choice.answer}
                                    </li>
                                </label>
                            ))}
                        </ol>
                        <div className="mt-28 flex justify-between">
                            <button
                                className="btn capitalize"
                                onClick={() => onChangeActiveQuestion(-1)}
                            >
                                &laquo; Sebelumnya
                            </button>
                            {active === exerciseData.length && (
                                <button
                                    className="btn btn-success text-white"
                                    onClick={() => onSubmitAnswer()}
                                >
                                    Selesai
                                </button>
                            )}
                            <button
                                className="btn btn-primary capitalize text-white"
                                onClick={() => onChangeActiveQuestion(1)}
                            >
                                Selanjutnya &raquo;
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <dialog id="un_answer_modal" className="modal">
                <div className="modal-box">
                    <h3 className="font-bold text-lg text-error uppercase">
                        Peringatan !
                    </h3>
                    <p className="py-4">
                        Beberapa soal masih belum terjawab, yakin untuk mengirim
                        jawaban ?
                    </p>
                    <div className="modal-action flex justify-end">
                        <button
                            className="btn capitalize"
                            onClick={onClickSubmitAnswer}
                        >
                            Kirim
                        </button>
                        <form method="dialog">
                            <button className="btn btn-error text-white capitalize">
                                Kembali
                            </button>
                        </form>
                    </div>
                </div>
            </dialog>

            <dialog id="confirm_send_ans_modal" className="modal">
                <div className="modal-box">
                    <h3 className="font-bold text-lg uppercase text-warning">
                        Konfirmasi !
                    </h3>
                    <p className="py-4">
                        Apakah Anda yakin ingin mengirimkan jawaban anda saat
                        ini ?
                    </p>
                    <div className="modal-action">
                        <form method="dialog">
                            <button
                                className="btn capitalize"
                                id="close_confirm_ans_btn"
                            >
                                Batal
                            </button>
                        </form>
                        <button
                            onClick={onClickSubmitAnswer}
                            className="btn btn-success capitalize mr-8 text-white"
                        >
                            Kirim
                        </button>
                    </div>
                </div>
            </dialog>
        </AuthenticatedLayout>
    );
}
