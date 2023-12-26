import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, router } from "@inertiajs/react";
import axios from "axios";
import { useEffect, useState } from "react";

export default function EPPS({ auth, title, data }) {
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

            <StartEPPS title={title} data={data} user={auth.user} />
        </AuthenticatedLayout>
    );
}

function StartEPPS({ title, data, user }) {
    let no = 1;
    const [testData, setTestData] = useState(
        data.minat_bakat_questions.map((question, i) => {
            return { ...question, no: i + 1, jawaban: null };
        })
    );
    const [active, setActive] = useState(1);
    const [activeQuestion, setActiveQuestion] = useState(
        testData.filter((q) => q.no === active)[0]
    );

    useEffect(() => {
        setActiveQuestion(testData.filter((q) => q.no === active)[0]);
    }, [active, testData]);

    const onAnswerQuestionHandler = (no, jawaban) => {
        const newQ = testData.map((q) => {
            if (q.no === no) return { ...q, jawaban };
            return q;
        });
        setTestData(newQ);
    };

    const onChangeActiveQuestion = (value) => {
        return setActive((prev) => {
            if (prev + value === 0) {
                return 1;
            } else if (prev + value > testData.length) {
                return prev;
            }

            return prev + value;
        });
    };

    const onSubmitAnswer = () => {
        const unAnsQuestion = testData.filter((q) => q.jawaban === null);
        if (unAnsQuestion.length !== 0) {
            return document.getElementById("un_answer_modal").showModal();
        }

        return document.getElementById("confirm_send_ans_modal").showModal();
    };

    const onClickSubmitAnswer = async () => {
        const finalTestData = testData.map((data) => {
            return { question_id: data.id, answer_id: data.jawaban };
        });
        const finalData = {
            minatbakat_id: data.id,
            user_id: user.id,
            epps_data: finalTestData,
        };
        const postData = await axios.post(route("minatbakat.epps.scoring"), {
            data: finalData,
        });

        setTestData((prev) => prev.map((dt) => ({ ...dt, jawaban: null })));

        return router.post(route("minatbakat.epps.result"), {
            data: {
                result: { ...postData.data },
                user_id: user.id,
                minatbakat_id: data.id,
            },
        });
    };

    return (
        <>
            <section className="mt-6">
                <div className="flex w-full items-center justify-between">
                    <h1 className="text-3xl text-curious-blue font-semibold">
                        {title}
                    </h1>
                </div>

                <div className="flex mt-8">
                    <div className="min-w-fit grid grid-cols-3 gap-2 h-[calc(100vh_-_260px)] overflow-y-hidden hover:overflow-y-scroll gutter-stable p-2 content-start">
                        {testData.map((q, i) => (
                            <div
                                className={`aspect-square flex items-center justify-center h-12 border-2 border-curious-blue rounded-md hover:bg-curious-blue hover:bg-opacity-20 transition-all duration-75 cursor-pointer ${
                                    q.jawaban !== null
                                        ? "bg-curious-blue text-white hover:text-black"
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
                    <div className="pl-8 w-full flex flex-col justify-between pb-8">
                        <div>
                            <p className="text-curious-blue font-bold text-3xl mb-4">
                                Soal ke-{activeQuestion.no}
                            </p>
                            <ol className="list-upper-alpha list-inside grid grid-rows-2 gap-4 mt-8 ml-0">
                                {activeQuestion.minat_bakat_answer.map(
                                    (choice, i) => (
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
                                                    parseInt(
                                                        activeQuestion.jawaban
                                                    ) === choice.id
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
                                            <li className="border-2 border-curious-blue px-8 py-3 rounded-md hover:bg-curious-blue hover:bg-opacity-20 transition-all duration-75 cursor-pointer peer-checked:text-white peer-checked:bg-curious-blue h-full">
                                                {choice.answer}
                                            </li>
                                        </label>
                                    )
                                )}
                            </ol>
                        </div>
                        <div className="flex justify-start gap-4">
                            <button
                                className="btn capitalize"
                                onClick={() => onChangeActiveQuestion(-1)}
                            >
                                &laquo; Sebelumnya
                            </button>
                            <button
                                className={`btn btn-success text-white ${
                                    active === testData.length
                                        ? "visible"
                                        : "invisible"
                                }`}
                                onClick={() => onSubmitAnswer()}
                            >
                                Selesai
                            </button>
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
        </>
    );
}
