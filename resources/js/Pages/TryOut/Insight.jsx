import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Insight({ auth, title, tryoutName, tryout }) {
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
                    {tryout.questions.map((soal, i) => (
                        <li className="mb-8" key={i}>
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
                                        <li className="border-2 border-curious-blue px-8 py-3 rounded-md transition-all duration-75 peer-checked:text-white peer-checked:bg-curious-blue">
                                            {choice.answer}
                                        </li>
                                    </label>
                                ))}
                            </ol>
                            <p>Pembahasan :</p>
                            <p>{soal.pembahasan}</p>
                        </li>
                    ))}
                </ol>
            </section>
        </AuthenticatedLayout>
    );
}
