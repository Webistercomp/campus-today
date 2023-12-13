import Alert from "@/Components/Alert";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router } from "@inertiajs/react";
import { useState } from "react";
import MyProfile from "./MyProfile";
import Settings from "./Settings";

export default function Profile({ auth }) {
    const { user } = auth;
    const [tabsIndex, setTabsIndex] = useState(0);
    const [isEdit, setIsEdit] = useState(false);
    const [alertData, setAlertData] = useState({
        type: "success",
        isShow: false,
        msg: "",
    });
    const [data, setData] = useState({
        name: user.name,
        tanggallahir: user.tanggal_lahir ?? null,
        nohp: user.nohp ?? null,
        pekerjaan: user.pekerjaan ?? null,
        gender: user.jenis_kelamin ?? null,
        kota: user.kota_kabupaten ?? null,
        provinsi: user.provinsi ?? null,
        pendidikan: user.pendidikan_terakhir ?? null,
        institusi: user.institusi ?? null,
    });
    const [prevData, setPrevData] = useState(data);

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

    const onSaveProfile = async () => {
        const url = route("profile");
        const putData = router.put(url, {
            ...data,
            tanggallahir: formatDateHTML(data.tanggallahir),
        });
        const response = putData;
        setAlertData({
            type: "success",
            isShow: true,
            msg: "Profil berhasil diubah",
        });
        setTimeout(
            () =>
                setAlertData((prev) => {
                    return { ...prev, isShow: false };
                }),
            2000
        );
        setIsEdit(false);
        setPrevData(data);
        return route("profile");
    };

    const onCancelEdit = () => {
        setData(prevData);
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
                    {tabsIndex === 0 &&
                        (!isEdit ? (
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
                                    onClick={() => onCancelEdit()}
                                >
                                    Batalkan
                                </button>
                                <button
                                    className="btn btn-primary capitalize text-white"
                                    onClick={() => onSaveProfile()}
                                >
                                    Simpan Profil
                                </button>
                            </div>
                        ))}
                </div>

                <div className="flex justify-between gap-8 items-center mt-4 border-b-2 pb-4">
                    <div className="flex gap-14 w-full">
                        <button
                            className={`text-center relative cursor-pointer ${
                                tabsIndex === 0
                                    ? "tab-active after:opacity-100"
                                    : "tab-active after:opacity-0 after:bottom-0"
                            }`}
                            onClick={() => setTabsIndex(0)}
                        >
                            Profil Saya
                        </button>
                        <button
                            className={`text-center relative cursor-pointer ${
                                tabsIndex === 1
                                    ? "tab-active after:opacity-100"
                                    : "tab-active after:opacity-0 after:bottom-0"
                            }`}
                            onClick={() => setTabsIndex(1)}
                        >
                            Setting
                        </button>
                    </div>
                </div>

                {tabsIndex === 0 && (
                    <MyProfile
                        data={data}
                        setData={setData}
                        isEdit={isEdit}
                        formatDateHTML={formatDateHTML}
                    />
                )}

                {tabsIndex === 1 && <Settings setAlertData={setAlertData} />}
            </section>

            <Alert {...alertData} />

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
