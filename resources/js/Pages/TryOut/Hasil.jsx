import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import ExamIcon from "@/icons/ExamIcon";
import ClockFillIcon from "@/icons/ClockFillIcon";
import PaperFillIcon from "@/icons/PaperFillIcon";

export default function Hasil({ auth, title, tryoutHistories }) {
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
                    <li>{title}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {title}
                </h1>

                <div className="flex justify-between gap-8 items-center mt-4 border-b-2 pb-3">
                    <div className="flex gap-14 w-full">
                        <a className="text-center relative cursor-pointer tab-active">
                            Hasil
                        </a>
                    </div>
                    <div className="form-control">
                        <input
                            type="text"
                            placeholder="Cari"
                            className="input input-bordered w-24 md:w-auto"
                        />
                    </div>
                </div>

                <div className="mt-6 grid grid-cols-3 gap-3">
                    {tryoutHistories.length === 0 ? 'Tidak ada data' : ''}
                    {tryoutHistories.map((tryoutHistory, i) => (
                        <div className="bg-white shadow-lg rounded-xl p-4 flex gap-4 items-center min-h-fit" key={i}>
                            <div className="bg-curious-blue aspect-square flex items-center justify-center h-full max-h-24 rounded-lg p-4">
                                <ExamIcon className="w-12" />
                            </div>
                            <div className="flex flex-col gap-2 overflow-clip">
                                <h4 className="uppercase text-curious-blue font-semibold text-lg">
                                    {tryoutHistory.tryout.name}
                                </h4>
                                <div className="flex flex-wrap gap-3 items-center">
                                    <span className="text-slate-400 flex items-center gap-1">
                                        <PaperFillIcon className="fill-slate-400 w-5" />
                                        <p className="text-sm m-0">{tryoutHistory.tryout.jumlah_soal} Soal</p>
                                    </span>
                                    <span className="text-slate-400 flex items-center gap-1">
                                        <ClockFillIcon className="fill-slate-400 w-5" />
                                        <p className="m-0">{tryoutHistory.tryout.time} Menit</p>
                                    </span>
                                </div>
                                <div className="flex gap-2 flex-wrap">
                                    <Link
                                        href={route("tryout.insight", tryoutHistory.id)}
                                        as="button"
                                        className="btn btn-primary btn-sm capitalize"
                                    >
                                        Pembahasan
                                    </Link>
                                    <Link
                                        href={route("tryout.ranking", tryoutHistory.id)}
                                        as="button"
                                        className="btn btn-sm capitalize"
                                    >
                                        Ranking
                                    </Link>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
