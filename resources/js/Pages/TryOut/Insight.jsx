import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Insight({ auth, title, tryoutName }) {
    const tryoutData = [
        {
            id: 1,
            tryout_id: 1,
            group_type_id: 6,
            question: "Question 0",
            created_at: "2023-11-17T10:51:49.000000Z",
            updated_at: "2023-11-17T10:51:49.000000Z",
            answers: [
                {
                    id: 1,
                    question_id: 1,
                    answer: "Jawaban 1",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 2,
                    question_id: 1,
                    answer: "Jawaban 2",
                    bobot: 5,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 3,
                    question_id: 1,
                    answer: "Jawaban 3",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 4,
                    question_id: 1,
                    answer: "Jawaban 4",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 5,
                    question_id: 1,
                    answer: "Jawaban 5",
                    bobot: 5,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
            ],
            no: 1,
            jawaban: "1",
        },
        {
            id: 2,
            tryout_id: 1,
            group_type_id: 6,
            question: "Question 1",
            created_at: "2023-11-17T10:51:49.000000Z",
            updated_at: "2023-11-17T10:51:49.000000Z",
            answers: [
                {
                    id: 6,
                    question_id: 2,
                    answer: "Jawaban 1",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 7,
                    question_id: 2,
                    answer: "Jawaban 2",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 8,
                    question_id: 2,
                    answer: "Jawaban 3",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 9,
                    question_id: 2,
                    answer: "Jawaban 4",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 10,
                    question_id: 2,
                    answer: "Jawaban 5",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
            ],
            no: 2,
            jawaban: "10",
        },
        {
            id: 3,
            tryout_id: 1,
            group_type_id: 6,
            question: "Question 2",
            created_at: "2023-11-17T10:51:49.000000Z",
            updated_at: "2023-11-17T10:51:49.000000Z",
            answers: [
                {
                    id: 11,
                    question_id: 3,
                    answer: "Jawaban 1",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 12,
                    question_id: 3,
                    answer: "Jawaban 2",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 13,
                    question_id: 3,
                    answer: "Jawaban 3",
                    bobot: 5,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 14,
                    question_id: 3,
                    answer: "Jawaban 4",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 15,
                    question_id: 3,
                    answer: "Jawaban 5",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
            ],
            no: 3,
            jawaban: "14",
        },
        {
            id: 4,
            tryout_id: 1,
            group_type_id: 6,
            question: "Question 3",
            created_at: "2023-11-17T10:51:49.000000Z",
            updated_at: "2023-11-17T10:51:49.000000Z",
            answers: [
                {
                    id: 16,
                    question_id: 4,
                    answer: "Jawaban 1",
                    bobot: 5,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 17,
                    question_id: 4,
                    answer: "Jawaban 2",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 18,
                    question_id: 4,
                    answer: "Jawaban 3",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 19,
                    question_id: 4,
                    answer: "Jawaban 4",
                    bobot: 5,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 20,
                    question_id: 4,
                    answer: "Jawaban 5",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
            ],
            no: 4,
            jawaban: "18",
        },
        {
            id: 5,
            tryout_id: 1,
            group_type_id: 6,
            question: "Question 4",
            created_at: "2023-11-17T10:51:49.000000Z",
            updated_at: "2023-11-17T10:51:49.000000Z",
            answers: [
                {
                    id: 21,
                    question_id: 5,
                    answer: "Jawaban 1",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 22,
                    question_id: 5,
                    answer: "Jawaban 2",
                    bobot: 5,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 23,
                    question_id: 5,
                    answer: "Jawaban 3",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 24,
                    question_id: 5,
                    answer: "Jawaban 4",
                    bobot: 0,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
                {
                    id: 25,
                    question_id: 5,
                    answer: "Jawaban 5",
                    bobot: 5,
                    created_at: "2023-11-17T10:51:49.000000Z",
                    updated_at: "2023-11-17T10:51:49.000000Z",
                },
            ],
            no: 5,
            jawaban: "21",
        },
    ].map((data, i) => {
        return { ...data, pembahasan: `Pembahasan ${i + 1}` };
    });

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link href={route("tryout")}>TryOut</Link>
                    </li>
                    <li>
                        <Link href={route("tryout.hasil")}>Hasil TryOut</Link>
                    </li>
                    <li>{title}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {tryoutName}
                </h1>
                <ol className="list-decimal ml-4 mt-4">
                    {tryoutData.map((soal, i) => (
                        <li className="mb-8">
                            <p>{soal.question}</p>
                            <p>Jawaban Anda :</p>
                            <ol className="list-upper-alpha list-inside grid grid-cols-3 gap-4 my-2 ml-0">
                                {soal.answers.map((choice, i) => (
                                    <label
                                        htmlFor={`${soal.no}_choices_${choice.id}`}
                                        key={choice.id}
                                    >
                                        <input
                                            type="radio"
                                            name={`${soal.no}_choices`}
                                            id={`${soal.no}_choices_${choice.id}`}
                                            className="peer hidden"
                                            value={choice.id}
                                            checked={
                                                parseInt(soal.jawaban) ===
                                                choice.id
                                                    ? true
                                                    : false
                                            }
                                            readOnly
                                        />
                                        <li className="border-2 border-curious-blue-300 px-8 py-3 rounded-md transition-all duration-75 peer-checked:text-white peer-checked:bg-curious-blue-300">
                                            {choice.answer}
                                        </li>
                                    </label>
                                ))}
                            </ol>
                            <p>Pembahasan :</p>
                            <p>{soal.pembahasan}</p>
                        </li>
                    ))}
                    {/* <li>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Voluptates aspernatur natus praesentium!
                            Reiciendis quam sequi dicta quibusdam ad deserunt
                            iure, possimus beatae voluptates, quod cumque sed,
                            perferendis corrupti maiores quaerat dolorem placeat
                            eius delectus sint. Inventore, quisquam cupiditate
                            voluptatibus ipsam voluptas vitae nam nemo aliquid
                            itaque vero, impedit, obcaecati non.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Rerum nisi reiciendis fuga itaque? Alias
                            praesentium exercitationem voluptatibus excepturi,
                            sed asperiores?
                        </p>
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
                    </li> */}
                </ol>
            </section>
        </AuthenticatedLayout>
    );
}
