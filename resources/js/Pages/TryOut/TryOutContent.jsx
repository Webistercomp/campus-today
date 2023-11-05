import { useEffect, useState } from "react";
import Timer from "@/Components/Timer";

export default function TryOutContent() {
    const [question, setQuestion] = useState(() => [
        {
            no: 1,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 0,
        },
        {
            no: 2,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 1,
        },
        {
            no: 3,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 2,
        },
        {
            no: 4,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 3,
        },
        {
            no: 5,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 1,
        },
        {
            no: 6,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 3,
        },
        {
            no: 7,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 2,
        },
        {
            no: 8,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 1,
        },
        {
            no: 9,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 0,
        },
        {
            no: 10,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 0,
        },
        {
            no: 11,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 1,
        },
        {
            no: 12,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: 3,
        },
        {
            no: 13,
            soal: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem laboriosam expedita quam optio a sit sequi ad excepturi quasi molestias.",
            pilihan: ["sadfasdf", "asdasdasd", "aksnfsf", "hasdfsdf"],
            jawaban: null,
        },
    ]);
    const [active, setActive] = useState(1);
    const [activeQuestion, setActiveQuestion] = useState(
        question.filter((q) => q.no === active)[0]
    );

    useEffect(() => {
        setActiveQuestion(question.filter((q) => q.no === active)[0]);
    }, [active, question]);

    const onAnswerQuestionHandler = (no, jawaban) => {
        const newQ = question.map((q) => {
            if (q.no === no) {
                return { ...q, jawaban };
            }
            return q;
        });
        setQuestion(newQ);
    };

    const onChangeActiveQuestion = (value) => {
        return setActive((prev) => {
            if (prev + value === 0) {
                return 1;
            } else if (prev + value > question.length) {
                return prev;
            }

            return prev + value;
        });
    };

    const onSubmitAnswer = () => {
        const unAnsQuestion = question.filter((q) => q.jawaban === null);
        if (unAnsQuestion.length !== 0) {
            return document.getElementById("un_answer_modal").showModal();
        }

        return document.getElementById("confirm_send_ans_modal").showModal();
    };

    const onClickSubmitAnswer = () => {};

    return (
        <section className="mt-6">
            <div className="flex w-full items-center justify-between">
                <h1 className="text-3xl text-curious-blue font-semibold">
                    Nama TryOut
                </h1>
                <div className="border-2 border-curious-blue-300 px-6 py-1 rounded-lg">
                    <Timer durationSeconds={7200} />
                </div>
            </div>

            <div className="flex mt-8">
                <div className="min-w-fit grid grid-cols-3 gap-2 h-[calc(100vh_-_200px)] overflow-y-hidden hover:overflow-y-scroll gutter-stable p-2 content-start">
                    {question.map((q, i) => (
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
                            {q.no}
                        </div>
                    ))}
                </div>
                <div className="pl-8">
                    <p className="text-curious-blue-300 font-bold text-3xl mb-4">
                        Soal ke-{activeQuestion.no}
                    </p>
                    <p className="text-lg">{activeQuestion.soal}</p>
                    <ol className="list-upper-alpha list-inside grid grid-cols-2 gap-4 mt-8 ml-0">
                        {activeQuestion.pilihan.map((choice, i) => (
                            <label
                                htmlFor={`${activeQuestion.no}_choices_${activeQuestion.pilihan[i]}`}
                                key={i}
                            >
                                <input
                                    type="radio"
                                    name={`${activeQuestion.no}__choices`}
                                    id={`${activeQuestion.no}_choices_${activeQuestion.pilihan[i]}`}
                                    className="peer hidden"
                                    value={i}
                                    onChange={(ev) => {
                                        onAnswerQuestionHandler(
                                            activeQuestion.no,
                                            i
                                        );
                                    }}
                                    checked={
                                        activeQuestion.jawaban === i
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
                                    {choice}
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
                        {active === question.length && (
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

            <dialog id="un_answer_modal" className="modal">
                <div className="modal-box">
                    <h3 className="font-bold text-lg text-error uppercase">
                        Peringatan !
                    </h3>
                    <p className="py-4">
                        Beberapa soal masih belum terjawab, yakin untuk mengirim
                        jawaban ?
                    </p>
                    <div className="modal-action flex justify-between">
                        <button className="btn capitalize">Kirim</button>
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
                            <button className="btn capitalize">Batal</button>
                        </form>
                        <button className="btn btn-success capitalize mr-8 text-white">
                            Kirim
                        </button>
                    </div>
                </div>
            </dialog>
        </section>
    );
}
