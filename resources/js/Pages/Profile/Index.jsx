import Alert from "@/Components/Alert";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import PencilIcon from "@/icons/PencilIcon";
import { Head, router } from "@inertiajs/react";
import { useState } from "react";
import EditPhotoModal from "./EditPhotoModal";
import MyProfile from "./MyProfile";
import PembelianPaket from "./PembelianPaket";
import Settings from "./Settings";

export default function Profile({ auth, historyPembelian }) {
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
    const [openEditPhotoModal, setOpenEditPhotoModal] = useState(false);

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

    const handleOnCloseUploadFotoModal = () => {
        setOpenEditPhotoModal(false);
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Profil" />

            <section className="py-6 px-4 md:px-14 lg:px-24 xl:px-32">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-8">
                        <div className="relative">
                            <img
                                src={user.picture}
                                alt=""
                                className="aspect-square w-16 xl:w-24 rounded-full bg-slate-300 relative object-cover"
                            />
                            {isEdit && (
                                <button
                                    onClick={() =>
                                        setOpenEditPhotoModal(
                                            !openEditPhotoModal
                                        )
                                    }
                                    className="absolute aspect-square w-16 xl:w-24 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center group"
                                >
                                    <PencilIcon className="w-6 h-6 xl:w-8 xl:h-8 stroke-slate-600" />
                                </button>
                            )}
                        </div>
                        <div>
                            <h1 className="text-lg xl:text-3xl font-bold text-curious-blue">
                                {user.name}
                            </h1>
                            <p className="text-slate-500 text-sm xl:text-base">
                                {user.email}
                            </p>
                        </div>
                    </div>
                    {tabsIndex === 0 &&
                        (!isEdit ? (
                            <button
                                className="btn btn-sm md:btn-md btn-primary capitalize text-white"
                                onClick={() => setIsEdit(!isEdit)}
                            >
                                Edit Profil
                            </button>
                        ) : (
                            <div className="flex flex-col md:flex-row gap-4">
                                <button
                                    className="btn btn-sm md:btn-md capitalize"
                                    onClick={() => onCancelEdit()}
                                >
                                    Batalkan
                                </button>
                                <button
                                    className="btn btn-sm md:btn-md btn-primary capitalize text-white"
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
                        <button
                            className={`text-center relative cursor-pointer ${
                                tabsIndex === 2
                                    ? "tab-active after:opacity-100"
                                    : "tab-active after:opacity-0 after:bottom-0"
                            }`}
                            onClick={() => setTabsIndex(2)}
                        >
                            Pembelian Paket
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

                {tabsIndex === 2 && (
                    <PembelianPaket historyPembelian={historyPembelian} />
                )}
            </section>

            <Alert {...alertData} />

            {openEditPhotoModal && (
                <EditPhotoModal
                    handleOnCloseUploadFotoModal={handleOnCloseUploadFotoModal}
                    userPicture={user.picture}
                    userName={user.name}
                />
            )}
        </AuthenticatedLayout>
    );
}
