import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import DeleteUserForm from "./Partials/DeleteUserForm";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm";
import axios from 'axios';
import { Head, Link } from "@inertiajs/react";
import { useState } from "react";

export default function Profile({ auth }) {
    const { user } = auth;
    const [isEdit, setIsEdit] = useState(false);
    const [data, setData] = useState({
        name: user.name,
        tanggallahir: user.tanggal_lahir ? new Date(user.tanggal_lahir).toLocaleDateString("id-ID", {
            dateStyle: "long",
        }) : '-',
        nohp: user.nohp ?? '-',
        pekerjaan: user.pekerjaan ?? '-',
        gender: user.jenis_kelamin ?? '-',
        kota: user.kota_kabupaten ?? '-',
        provinsi: user.provinsi ?? '-',
        pendidikan: user.pendidikan ?? '-',
        institusi: user.institusi ?? '-',
    });

    const formatDateHTML = (dateString, join = "-", format = "dmy") => {
        var [date, month, year] = [
            String(new Date(dateString).getDate()),
            String(new Date(dateString).getMonth() + 1),
            String(new Date(dateString).getFullYear()),
        ];

        if (date.length < 2) date = `0${date}`;
        if (month.length < 2) month = `0${month}`;

        return [year, month, date].join(join);
    };

    const onChangeUserData = (field, newData) => {
        setData({ ...data, [field]: newData });
    };

    const onSaveProfile = async () => {
        return setIsEdit(false);
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Profil" />

            <section className="py-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-8">
                        <img
                            src=""
                            alt=""
                            className="aspect-square w-24 rounded-full bg-slate-300"
                        />
                        <div>
                            <h1 className="text-3xl font-bold text-curious-blue">
                                {user.name}
                            </h1>
                            <p className="text-slate-500">{user.email}</p>
                        </div>
                    </div>
                    {!isEdit ? (
                        <button
                            className="btn btn-primary capitalize text-white"
                            onClick={() => setIsEdit(!isEdit)}
                        >
                            Edit Profil
                        </button>
                    ) : (
                        <div className="flex gap-4">
                            <button
                                className="btn capitalize"
                                onClick={() => setIsEdit(!isEdit)}
                            >
                                Batalkan
                            </button>
                            <Link href={route('profile.update')} method="PUT">
                                <button
                                    className="btn btn-primary capitalize text-white"
                                    onClick={() => onSaveProfile()}
                                >
                                    Simpan Profil
                                </button>
                            </Link>
                        </div>
                    )}
                </div>

                <div className="flex justify-between gap-8 items-center mt-4 border-b-2 pb-4">
                    <div className="flex gap-14 w-full">
                        <a className="text-center relative cursor-pointer tab-active">
                            Profil Saya
                        </a>
                        <a className="text-center relative cursor-pointer">
                            Riwayat Pembelian
                        </a>
                    </div>
                </div>

                {!isEdit ? (
                    <div className="grid grid-flow-col grid-cols-2 grid-rows-[repeat(7,_minmax(0,_1fr))] gap-6 gap-x-14 w-full mt-6">
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">Nama</p>
                            <p className="text-curious-blue">{data.name}</p>
                        </div>
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">
                                Tanggal lahir
                            </p>
                            <p className="text-curious-blue">
                                {data.tanggallahir}
                            </p>
                        </div>
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">No. HP</p>
                            <p className="text-curious-blue">{data.nohp}</p>
                        </div>
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">
                                Pekerjaan
                            </p>
                            <p className="text-curious-blue">
                                {data.pekerjaan}
                            </p>
                        </div>
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">Gender</p>
                            <p className="text-curious-blue">{data.gender}</p>
                        </div>
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">
                                Kota/Kabupaten
                            </p>
                            <p className="text-curious-blue">{data.kota}</p>
                        </div>
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">Provinsi</p>
                            <p className="text-curious-blue">{data.provinsi}</p>
                        </div>
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">
                                Pendidikan terakhir
                            </p>
                            <p className="text-curious-blue">
                                {data.pendidikan}
                            </p>
                        </div>
                        <div className="flex justify-start items-center">
                            <p className="text-slate-700 basis-1/3">
                                Institusi
                            </p>
                            <p className="text-curious-blue">
                                {data.institusi}
                            </p>
                        </div>
                    </div>
                ) : (
                    <form className="grid grid-flow-col grid-cols-2 grid-rows-[repeat(7,_minmax(0,_1fr))] gap-x-14 gap-4 w-full mt-6">
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="name"
                                className="text-slate-700 basis-1/3"
                            >
                                Nama
                            </label>
                            <input
                                id="name"
                                value={data.name}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        ev.target.value
                                    )
                                }
                                className="input input-primary input-sm input-bordered basis-2/3"
                            />
                        </div>
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="tanggallahir"
                                className="text-slate-700 basis-1/3"
                            >
                                Tanggal lahir
                            </label>
                            <input
                                id="tanggallahir"
                                value={formatDateHTML(data.tanggallahir)}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        new Date(
                                            ev.target.value
                                        ).toLocaleDateString("id-ID", {
                                            dateStyle: "long",
                                        })
                                    )
                                }
                                type="date"
                                className="input input-primary input-sm input-bordered basis-2/3"
                            />
                        </div>
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="nohp"
                                className="text-slate-700 basis-1/3"
                            >
                                No. HP
                            </label>
                            <input
                                id="nohp"
                                value={data.nohp}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        ev.target.value
                                    )
                                }
                                className="input input-primary input-sm input-bordered basis-2/3"
                            />
                        </div>
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="pekerjaan"
                                className="text-slate-700 basis-1/3"
                            >
                                Pekerjaan
                            </label>
                            <input
                                id="pekerjaan"
                                value={data.pekerjaan}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        ev.target.value
                                    )
                                }
                                className="input input-primary input-sm input-bordered basis-2/3"
                            />
                        </div>
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="gender"
                                className="text-slate-700 basis-1/3"
                            >
                                Gender
                            </label>
                            <input
                                id="gender"
                                value={data.gender}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        ev.target.value
                                    )
                                }
                                className="input input-primary input-sm basis-2/3"
                            />
                        </div>
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="kota"
                                className="text-slate-700 basis-1/3"
                            >
                                Kota/Kabupaten
                            </label>
                            <input
                                id="kota"
                                value={data.kota}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        ev.target.value
                                    )
                                }
                                className="input input-primary input-sm input-bordered basis-2/3"
                            />
                        </div>
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="provinsi"
                                className="text-slate-700 basis-1/3"
                            >
                                Provinsi
                            </label>
                            <input
                                id="provinsi"
                                value={data.provinsi}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        ev.target.value
                                    )
                                }
                                className="input input-primary input-sm input-bordered basis-2/3"
                            />
                        </div>
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="pendidikan"
                                className="text-slate-700 basis-1/3"
                            >
                                Pendidikan terakhir
                            </label>
                            <input
                                id="pendidikan"
                                value={data.pendidikan}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        ev.target.value
                                    )
                                }
                                className="input input-primary input-sm input-bordered basis-2/3"
                            />
                        </div>
                        <div className="flex justify-start items-center">
                            <label
                                htmlFor="institusi"
                                className="text-slate-700 basis-1/3"
                            >
                                Institusi
                            </label>
                            <input
                                id="institusi"
                                value={data.institusi}
                                onChange={(ev) =>
                                    onChangeUserData(
                                        ev.target.id,
                                        ev.target.value
                                    )
                                }
                                className="input input-primary input-sm input-bordered basis-2/3"
                            />
                        </div>
                    </form>
                )}
            </section>

            {/* <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdateProfileInformationForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-xl"
                        />
                    </div>

                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdatePasswordForm className="max-w-xl" />
                    </div>

                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <DeleteUserForm className="max-w-xl" />
                    </div>
                </div>
            </div> */}
        </AuthenticatedLayout>
    );
}
