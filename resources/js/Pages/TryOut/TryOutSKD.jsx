import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import ClockFillIcon from "@/icons/ClockFillIcon";
import ExamIcon from "@/icons/ExamIcon";
import PaperFillIcon from "@/icons/PaperFillIcon";
import PaperIcon from "@/icons/PaperIcon";
import { Head, Link } from "@inertiajs/react";

export default function TryOutSKD({ title }) {
    return (
        <AuthenticatedLayout>
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
                            Event TryOut
                        </a>
                        <a className="text-center relative cursor-pointer">
                            TryOut Gratis
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
                    <div className="bg-white shadow-lg basis-1/3 rounded-xl p-4 flex gap-4 items-center cursor-pointer hover:bg-slate-100 duration-150 transition-all">
                        <div className="bg-curious-blue aspect-square flex items-center justify-center h-full rounded-lg p-4">
                            <ExamIcon className="w-12" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h4 className="uppercase text-curious-blue font-semibold text-lg">
                                Nama TryOut
                            </h4>
                            <div className="flex gap-3">
                                <span className="text-slate-400 flex items-center gap-1">
                                    <PaperFillIcon className="fill-slate-400 w-5" />
                                    <p className="text-sm">Jumlah Soal</p>
                                </span>
                                <span className="text-slate-400 flex items-center gap-1">
                                    <ClockFillIcon className="fill-slate-400 w-5" />
                                    <p>-- Menit</p>
                                </span>
                            </div>
                            <Link href={route("tryout.confirm")}>
                                <button className="btn btn-primary btn-sm capitalize w-full">
                                    Kerjakan
                                </button>
                            </Link>
                        </div>
                    </div>
                    <div className="bg-white shadow-lg basis-1/3 rounded-xl p-4 flex gap-4 items-center cursor-pointer hover:bg-slate-100 duration-150 transition-all">
                        <div className="bg-curious-blue aspect-square flex items-center justify-center h-full rounded-lg p-4">
                            <ExamIcon className="w-12" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h4 className="uppercase text-curious-blue font-semibold text-lg">
                                Nama TryOut
                            </h4>
                            <div className="flex gap-3">
                                <span className="text-slate-400 flex items-center gap-1">
                                    <PaperFillIcon className="fill-slate-400 w-5" />
                                    <p className="text-sm">Jumlah Soal</p>
                                </span>
                                <span className="text-slate-400 flex items-center gap-1">
                                    <ClockFillIcon className="fill-slate-400 w-5" />
                                    <p>-- Menit</p>
                                </span>
                            </div>
                            <button className="btn btn-primary btn-sm capitalize">
                                Kerjakan
                            </button>
                        </div>
                    </div>
                    <div className="bg-white shadow-lg basis-1/3 rounded-xl p-4 flex gap-4 items-center cursor-pointer hover:bg-slate-100 duration-150 transition-all">
                        <div className="bg-curious-blue aspect-square flex items-center justify-center h-full rounded-lg p-4">
                            <ExamIcon className="w-12" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h4 className="uppercase text-curious-blue font-semibold text-lg">
                                Nama TryOut
                            </h4>
                            <div className="flex gap-3">
                                <span className="text-slate-400 flex items-center gap-1">
                                    <PaperFillIcon className="fill-slate-400 w-5" />
                                    <p className="text-sm">Jumlah Soal</p>
                                </span>
                                <span className="text-slate-400 flex items-center gap-1">
                                    <ClockFillIcon className="fill-slate-400 w-5" />
                                    <p>-- Menit</p>
                                </span>
                            </div>
                            <button className="btn btn-primary btn-sm capitalize">
                                Kerjakan
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
