import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import ClockFillIcon from "@/icons/ClockFillIcon";
import ExamIcon from "@/icons/ExamIcon";
import PaperFillIcon from "@/icons/PaperFillIcon";
import PaperIcon from "@/icons/PaperIcon";
import { Head, Link } from "@inertiajs/react";

export default function TryOutSKD({ auth, title, tryouts, type }) {
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
                    <li>{title} {type.toUpperCase()}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {title} {type.toUpperCase()}
                </h1>

                <div className="mt-6 grid grid-cols-3 gap-3">
                    {tryouts.map(function (tryout, i) {
                        return (
                            <div className="bg-white shadow-lg basis-1/3 rounded-xl p-4 flex gap-4 items-center cursor-pointer hover:bg-slate-100 duration-150 transition-all" key={i} >
                                <div className="bg-curious-blue aspect-square flex items-center justify-center h-full rounded-lg p-4">
                                    <ExamIcon className="w-12" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <h4 className="uppercase text-curious-blue font-semibold text-lg">
                                        {tryout.name}
                                    </h4>
                                    <div className="flex gap-3">
                                        <span className="text-slate-400 flex items-center gap-1">
                                            <PaperFillIcon className="fill-slate-400 w-5" />
                                            <p className="text-sm">
                                                {tryout.jumlah_soal} Soal
                                            </p>
                                        </span>
                                        <span className="text-slate-400 flex items-center gap-1">
                                            <ClockFillIcon className="fill-slate-400 w-5" />
                                            <p>{tryout.time} Menit</p>
                                        </span>
                                    </div>
                                    <Link
                                        href={route(
                                            "tryout.confirm",
                                            tryout.id
                                        )}
                                    >
                                        <button className="btn btn-primary btn-sm capitalize w-full">
                                            Kerjakan
                                        </button>
                                    </Link>
                                </div>
                            </div>
                        );
                    })}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
