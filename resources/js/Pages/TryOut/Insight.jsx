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
                            <p><span className="font-bold">Jawaban Anda</span> : {soal.jawaban_user} (Nilai {soal.jawaban_user_bobot})</p>
                            <ol className="list-upper-alpha list-inside grid grid-cols-3 gap-4 my-2 ml-0">
                                {soal.answers.map((choice, i) => (
                                    <label
                                        htmlFor={`${soal.no}_choices_${choice.id}`}
                                        key={choice.id}
                                    >
                                        <input
                                            type="radio"
                                            id={`${soal.no}_choices_${choice.id}`}
                                            className="peer hidden"
                                            value={choice.id}
                                            checked={
                                                (parseInt(soal.jawaban) ===
                                                choice.id || soal.jawaban_user_id == choice.id)
                                                    ? true
                                                    : false
                                            }
                                            readOnly
                                        />
                                        <li className={
                                            (parseInt(soal.jawaban) === choice.id || soal.jawaban_user_id == choice.id) ?
                                                (parseInt(soal.jawaban) === choice.id) ?
                                                "border-2 border-curious-blue px-8 py-3 rounded-md transition-all duration-75 peer-checked:text-white peer-checked:bg-curious-blue"
                                                :
                                                "border-2 border-red-500 px-8 py-3 rounded-md transition-all duration-75 peer-checked:text-white peer-checked:bg-red-500"
                                            :
                                                "border-2 border-curious-blue px-8 py-3 rounded-md transition-all duration-75"  
                                        }>
                                            {choice.answer}
                                        </li>
                                    </label>
                                ))}
                            </ol>
                            <p><span className="font-bold">Pembahasan</span> :</p>
                            <p>{soal.solution.solution}</p>
                        </li>
                    ))}
                </ol>
            </section>
        </AuthenticatedLayout>
    );
}
