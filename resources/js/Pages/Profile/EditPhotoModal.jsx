import Alert from "@/Components/Alert";
import XIcon from "@/icons/XIcon";
import axios from "axios";
import { useEffect, useState } from "react";

export default function EditPhotoModal({
    handleOnCloseUploadFotoModal,
    userPicture,
    userName,
}) {
    const [userUploadPict, setUserUploadPict] = useState();
    const [userPictUrl, setUserPictUrl] = useState(userPicture);
    const [alertData, setAlertData] = useState({
        type: "success",
        msg: "",
        isShow: false,
    });

    const handleOnChangeUserPicture = (ev) => {
        setUserUploadPict(ev.target.files[0]);
    };

    const handleOnClickSavePicture = () => {
        const newFileName = `${userName}_picture_${Date.now()}.jpeg`;

        const pictData = new FormData();
        pictData.append("picture", userUploadPict, newFileName);

        axios
            .post(route("profile.update.picture"), pictData)
            .then((res) => {
                setAlertData({ isShow: true, ...res.data });
                window.location.reload();
            })
            .catch((err) => {
                console.log(err);
            })
            .finally(() => {
                setTimeout(() => {
                    setAlertData({ ...alertData, isShow: false });
                }, 2000);
            });
    };

    useEffect(() => {
        if (userUploadPict) {
            const reader = new FileReader();
            reader.readAsDataURL(userUploadPict);
            reader.onloadend = () => {
                setUserPictUrl(reader.result);
            };
        }
    }, [userUploadPict]);

    return (
        <>
            <div className="w-full">
                <div
                    className="bg-black opacity-20 w-full h-full fixed top-0 left-0 z-50"
                    onClick={handleOnCloseUploadFotoModal}
                ></div>
                <div className="bg-white w-full max-w-3xl p-8 shadow-md fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[60] rounded-md">
                    <div className="flex justify-between items-center">
                        <h1 className="text-xl text-curious-blue font-semibold">
                            Edit Foto
                        </h1>
                        <button onClick={handleOnCloseUploadFotoModal}>
                            <XIcon className="fill-rose-400" />
                        </button>
                    </div>
                    <div className="mt-6 flex gap-4 items-start">
                        <img
                            src={userPictUrl}
                            alt={
                                !userPicture
                                    ? "Foto tidak ditemukan"
                                    : userPicture
                            }
                            className={`${
                                userPictUrl ? "aspect-auto" : "aspect-square"
                            } max-w-xs basis-1/2 bg-slate-300`}
                        />
                        <div className="flex flex-col gap-4 basis-1/2">
                            <div>
                                <label
                                    htmlFor="uploadfoto"
                                    className="text-slate-500 font-semibold"
                                >
                                    {!userPicture
                                        ? "Upload Foto"
                                        : "Ganti Foto"}
                                </label>
                                <input
                                    id="uploadfoto"
                                    type="file"
                                    className="file-input file-input-primary w-full mt-2"
                                    accept=".jpeg,.jpg,.png"
                                    onChange={(ev) =>
                                        handleOnChangeUserPicture(ev)
                                    }
                                />
                            </div>
                            {/* <button className="btn btn-warning">
                                Potong Gambar
                            </button> */}
                            <hr className="h-[2px] bg-slate-200 rounded-full" />
                            <button
                                onClick={handleOnClickSavePicture}
                                className="btn btn-primary"
                            >
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <Alert {...alertData} />
        </>
    );
}
