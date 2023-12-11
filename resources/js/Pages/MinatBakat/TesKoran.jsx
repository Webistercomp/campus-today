import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { useState, useEffect, useRef, useMemo } from "react";
import Countdown from "react-countdown";

function TestTimer({ date, key, handleTimesUp }) {
    const renderer = ({ minutes, seconds, completed }) => {
        if (completed) {
            handleTimesUp();
            return (
                <span>
                    {String(minutes).length < 2 ? `0${minutes}` : `${minutes}`}{" "}
                    :{" "}
                    {String(seconds).length < 2 ? `0${seconds}` : `${seconds}`}
                </span>
            );
        } else {
            return (
                <span>
                    {String(minutes).length < 2 ? `0${minutes}` : `${minutes}`}{" "}
                    :{" "}
                    {String(seconds).length < 2 ? `0${seconds}` : `${seconds}`}
                </span>
            );
        }
    };

    return <Countdown date={date} renderer={renderer} key={key} />;
}

function StartTestKoran({ duration }) {
    const groupingQuestion = (arr) => {
        const groupResult = [];
        for (let i = 2; i <= arr.length; i++) {
            groupResult.push(arr.slice(i - 2, i));
        }
        return groupResult;
    };

    const onClickAnswerUser = (input) => {
        setUserInput(input);
        setCounter((prev) => prev + 1);
    };

    const scoring = (userAnswer) => {
        let correct = 0;
        let wrong = 0;
        for (let i = 0; i < userAnswer.length; i++) {
            const realAnswer = String(answerQuestion[i]).at(-1);
            if (userAnswer[i] === realAnswer) {
                correct++;
            } else {
                wrong++;
            }
        }

        return { correct, wrong };
    };

    const number = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    const [counter, setCounter] = useState(0);
    const [userInput, setUserInput] = useState(null);
    const [question, setQuestion] = useState(() => {
        const q = [];
        for (let i = 0; i < 3; i++) {
            q.push(number[Math.floor(Math.random() * number.length)]);
        }
        return q;
    });
    const [groupQuestion, setGroupQuestion] = useState(() =>
        groupingQuestion(question)
    );
    const [answerQuestion, setAnswerQuestion] = useState(() =>
        groupQuestion.map((dt) => dt[0] + dt[1])
    );
    const [userAnswer, setUserAnswer] = useState([]);
    const [isStart, setIsStart] = useState(false);
    const [countDown, setCountDown] = useState(3);
    const [score, setScore] = useState({ correct: 0, wrong: 0 });
    const [reset, setReset] = useState(0);

    const soalRef = useRef();

    const date = useMemo(() => {
        return Date.now() + duration * 1000;
    }, [reset]);

    useEffect(() => {
        if (userInput !== null) {
            setQuestion([
                ...question,
                number[Math.floor(Math.random() * number.length)],
            ]);
            setUserAnswer([...userAnswer, userInput]);
        }
    }, [counter]);

    useEffect(() => {
        setGroupQuestion(groupingQuestion(question));
    }, [question]);

    useEffect(() => {
        setAnswerQuestion(groupQuestion.map((dt) => dt[0] + dt[1]));
    }, [groupQuestion]);

    useEffect(() => {
        const { correct, wrong } = scoring(userAnswer);
        setScore({ correct, wrong });
    }, [userAnswer]);

    useEffect(() => {
        if (soalRef.current !== undefined) {
            const element = soalRef.current;
            element.scrollTo(0, 48);
        }
    }, [reset]);

    useEffect(() => {
        if (userInput !== null) {
            if (soalRef.current !== undefined) {
                const element = soalRef.current;
                const currentScrollPos = element.scrollTop;
                element.scrollTo(0, currentScrollPos + 60);
            }
        }
    }, [counter]);

    useEffect(() => {
        const handleKeyboardPress = (ev) => {
            if (number.includes(parseInt(ev.key))) {
                onClickAnswerUser(ev.key);
            }
        };

        document.addEventListener("keyup", (ev) => handleKeyboardPress(ev));

        document.addEventListener("keydown", (ev) => {
            if (ev.keyCode === 32 && ev.target === soalRef.current) {
                ev.preventDefault();
            }
        });

        return document.removeEventListener("keyup", (ev) =>
            handleKeyboardPress(ev)
        );
    }, []);

    useEffect(() => {
        const startInterval = setInterval(() => {
            setCountDown((prev) =>
                prev > 0 ? prev - 1 : clearInterval(startInterval)
            );
        }, 1000);

        return () => clearInterval(startInterval);
    }, [reset]);

    useEffect(() => {
        if (countDown === 0) {
            setIsStart(true);
            setReset(reset + 1);
        }
    }, [countDown]);

    const handleTimesUp = () => {
        return document.getElementById("result_modal").showModal();
    };

    const onClickRestartTest = () => {
        setUserInput(null);
        setQuestion(() => {
            const q = [];
            for (let i = 0; i < 3; i++) {
                q.push(number[Math.floor(Math.random() * number.length)]);
            }
            return q;
        });
        setUserAnswer([]);
        setCountDown(3);
        setIsStart(false);
        setReset(reset + 1);
    };

    return (
        <>
            <section>
                <div className="bg-curious-blue max-w-xs mx-auto p-8 rounded-lg">
                    <div className="flex justify-between text-white">
                        <p>
                            score <span>{score.correct}</span>:
                            <span>{score.wrong}</span>
                        </p>
                        {isStart ? (
                            <TestTimer
                                date={date}
                                key={reset}
                                handleTimesUp={handleTimesUp}
                            />
                        ) : (
                            ""
                        )}
                    </div>
                    <div className="w-full aspect-video bg-white mb-4 rounded-md relative">
                        {isStart ? (
                            <>
                                <div
                                    ref={soalRef}
                                    id="soal-scroll"
                                    className="relative flex flex-col text-center h-full text-3xl gap-6 py-[72px] overflow-y-scroll scrollbar-hide"
                                >
                                    {question.map((q, i) => (
                                        <p className="m-0" key={i}>
                                            {q}
                                        </p>
                                    ))}
                                </div>
                                <p className="absolute text-3xl left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2">
                                    +
                                </p>
                            </>
                        ) : (
                            <p
                                ref={soalRef}
                                id="soal-scroll"
                                className="m-0 absolute text-3xl left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2"
                            >
                                {countDown}
                            </p>
                        )}
                    </div>
                    <div className="grid grid-cols-3 gap-2 justify-items-stretch justify-center">
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={1}
                        >
                            1
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={2}
                        >
                            2
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={3}
                        >
                            3
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={4}
                        >
                            4
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={5}
                        >
                            5
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={6}
                        >
                            6
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={7}
                        >
                            7
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={8}
                        >
                            8
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={9}
                        >
                            9
                        </button>
                        <button className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400 invisible">
                            hidden
                        </button>
                        <button
                            className="py-3 px-8 rounded-md text-white bg-slate-700 hover:bg-slate-500 transition-all duration-75 active:bg-slate-400"
                            onClick={(ev) => onClickAnswerUser(ev.target.value)}
                            value={0}
                        >
                            0
                        </button>
                    </div>
                </div>
            </section>

            <dialog id="result_modal" className="modal">
                <div className="modal-box">
                    <h3 className="font-bold text-lg">Waktu selesai!</h3>
                    <p className="py-4">
                        Kamu berhasil menjawab{" "}
                        <span className="text-curious-blue font-semibold">
                            {score.correct} soal benar
                        </span>{" "}
                        dan{" "}
                        <span className="text-rose-600 font-semibold">
                            {score.wrong} soal salah
                        </span>{" "}
                        dalam {duration} detik
                    </p>
                    <div className="modal-action">
                        <Link
                            as="button"
                            href={route("minatbakat.teskoran")}
                            className="btn"
                        >
                            Kembali ke menu
                        </Link>
                        <form method="dialog">
                            <button
                                className="btn btn-primary text-white"
                                onClick={onClickRestartTest}
                            >
                                Mulai lagi
                            </button>
                        </form>
                    </div>
                </div>
            </dialog>
        </>
    );
}

export default function TesKoran({ auth, title }) {
    const [isStart, setIsStart] = useState(false);
    const [duration, setDuration] = useState(15);

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
                        Tes koran adalah psikotes yang berisikan deretan angka
                        pada selebaran kertas sebesar ukuran koran. Tujuannya
                        adalah untuk menguji konsentrasi, ketelitian, stabilitas
                        emosi, dan kecepatan dalam mengerjakan suatu pekerjaan.
                        Selain itu, untuk melihat penyesuaian diri dan daya
                        tahan seseorang.
                    </p>
                    <p>
                        Cara pengerjaan : Jumlahkan dua angka yang ditampilkan
                        dan pilih (klik) angka belakangnya saja.
                    </p>
                    <p>
                        Contoh: <br /> 9+5=?{" "}
                        <span className="text-curious-blue font-semibold">
                            klik angka 4
                        </span>
                        <br /> 3+5=?{" "}
                        <span className="text-curious-blue font-semibold">
                            klik angka 8
                        </span>
                    </p>
                    <h4 className="mt-6 mb-2">Pilih durasi tes :</h4>
                    <div className="flex gap-4">
                        <label
                            htmlFor="duration-15"
                            className={`btn ${
                                duration === 15
                                    ? "btn-primary text-white"
                                    : "text-slate-800"
                            }`}
                        >
                            <input
                                type="radio"
                                className=""
                                id="duration-15"
                                name="duration"
                                hidden
                                value={15}
                                onChange={(ev) =>
                                    setDuration(parseInt(ev.target.value))
                                }
                            />
                            15 Detik
                        </label>
                        <label
                            htmlFor="duration-30"
                            className={`btn ${
                                duration === 30
                                    ? "btn-primary text-white"
                                    : "text-slate-800"
                            }`}
                        >
                            <input
                                type="radio"
                                className=""
                                id="duration-30"
                                name="duration"
                                hidden
                                value={30}
                                onChange={(ev) =>
                                    setDuration(parseInt(ev.target.value))
                                }
                            />
                            30 Detik
                        </label>
                        <label
                            htmlFor="duration-60"
                            className={`btn ${
                                duration === 60
                                    ? "btn-primary text-white"
                                    : "text-slate-800"
                            }`}
                        >
                            <input
                                type="radio"
                                className=""
                                id="duration-60"
                                name="duration"
                                hidden
                                value={60}
                                onChange={(ev) =>
                                    setDuration(parseInt(ev.target.value))
                                }
                            />
                            60 Detik
                        </label>
                    </div>
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
                <StartTestKoran duration={duration} />
            )}
        </AuthenticatedLayout>
    );
}
