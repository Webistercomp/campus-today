import Alert from "@/Components/Alert";
import XIcon from "@/icons/XIcon";
import axios from "axios";
import { useEffect, useRef, useState } from "react";
import ReactCrop, { centerCrop, makeAspectCrop } from "react-image-crop";

import "react-image-crop/dist/ReactCrop.css";

function centerAspectCrop(mediaWidth, mediaHeight, aspect) {
    return centerCrop(
        makeAspectCrop(
            {
                unit: "%",
                width: 320,
            },
            aspect,
            mediaWidth,
            mediaHeight
        ),
        mediaWidth,
        mediaHeight
    );
}

export default function EditPhotoModal({
    handleOnCloseUploadFotoModal,
    userPicture,
    userName,
}) {
    const aspect = 1 / 1;
    const [userUploadPict, setUserUploadPict] = useState();
    const [userPictUrl, setUserPictUrl] = useState(userPicture);
    const [alertData, setAlertData] = useState({
        type: "success",
        msg: "",
        isShow: false,
    });
    const [cropMode, setCropMode] = useState(false);
    const [crop, setCrop] = useState();
    const [completedCrop, setCompletedCrop] = useState();

    const imgRef = useRef();

    const handleOnChangeUserPicture = (ev) => {
        setCrop(undefined);
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

    const handleOnSetCropMode = () => setCropMode(!cropMode);

    const onLoadPicture = (ev) => {
        const { width, height } = ev.currentTarget;
        setCrop(centerAspectCrop(width, height, aspect));
    };

    const handleOnCompleteCropPicture = async () => {
        const image = imgRef.current;

        const canvas = document.createElement("canvas");

        const scaleX = image.naturalWidth / image.width;
        const scaleY = image.naturalHeight / image.height;
        canvas.width = completedCrop.width;
        canvas.height = completedCrop.height;

        const ctx = canvas.getContext("2d");
        ctx.drawImage(
            image,
            completedCrop.x * scaleX,
            completedCrop.y * scaleY,
            completedCrop.width * scaleX,
            completedCrop.height * scaleY,
            0,
            0,
            completedCrop.width,
            completedCrop.height
        );
        const toBase64 = canvas.toDataURL("image/jpeg", 1.0);
        setUserPictUrl(toBase64);
        fetch(toBase64)
            .then((res) => res.blob())
            .then((blob) => {
                const croppedFile = new File(
                    [blob],
                    `${userName}-croppedPicture`,
                    {
                        type: "image/jpeg",
                    }
                );
                setUserUploadPict(croppedFile);
            });
        setCropMode(false);
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
                        <div className="w-full max-w-xs basis-1/2">
                            {cropMode ? (
                                <ReactCrop
                                    crop={crop}
                                    onChange={(_, percentCrop) =>
                                        setCrop(percentCrop)
                                    }
                                    onComplete={(e) => setCompletedCrop(e)}
                                    aspect={aspect}
                                    minWidth={50}
                                >
                                    <img
                                        ref={imgRef}
                                        src={userPictUrl}
                                        alt="user-picture"
                                        onLoad={onLoadPicture}
                                        className="w-full"
                                    />
                                </ReactCrop>
                            ) : (
                                <img
                                    ref={imgRef}
                                    src={userPictUrl}
                                    alt="user-picture"
                                    className={`w-full ${
                                        userPictUrl
                                            ? "aspect-auto"
                                            : "aspect-square"
                                    } bg-slate-300`}
                                />
                            )}
                        </div>
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
                            {cropMode && (
                                <button
                                    className="btn btn-warning"
                                    onClick={handleOnCompleteCropPicture}
                                >
                                    Potong Gambar
                                </button>
                            )}
                            <button
                                className={`btn ${!cropMode && "btn-warning"}`}
                                onClick={handleOnSetCropMode}
                            >
                                {!cropMode ? "Potong Gambar" : "Batal"}
                            </button>
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
