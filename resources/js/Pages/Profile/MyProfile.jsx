export default function MyProfile({ data, isEdit, setData, formatDateHTML }) {
    const parseToLocaleDate = (dateString) => {
        return new Date(dateString).toLocaleDateString("id-ID", {
            dateStyle: "long",
        });
    };

    const onChangeUserData = (field, newData) => {
        setData({ ...data, [field]: newData });
    };

    return (
        <>
            {!isEdit ? (
                <div className="grid grid-flow-col grid-cols-1 lg:grid-cols-2 grid-rows-[repeat(9,_minmax(0,_1fr))] lg:grid-rows-[repeat(7,_minmax(0,_1fr))] gap-2 xl:gap-6 gap-x-14 w-full mt-6">
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            Nama
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.name ?? "-"}
                        </p>
                    </div>
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            Tanggal lahir
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.tanggallahir
                                ? parseToLocaleDate(data.tanggallahir)
                                : "-"}
                        </p>
                    </div>
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            No. HP
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.nohp ?? "-"}
                        </p>
                    </div>
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            Pekerjaan
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.pekerjaan ?? "-"}
                        </p>
                    </div>
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            Gender
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.gender ?? "-"}
                        </p>
                    </div>
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            Kota/Kabupaten
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.kota ?? "-"}
                        </p>
                    </div>
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            Provinsi
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.provinsi ?? "-"}
                        </p>
                    </div>
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            Pendidikan terakhir
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.pendidikan ?? "-"}
                        </p>
                    </div>
                    <div className="flex justify-start items-center">
                        <p className="text-slate-700 basis-1/2 lg:basis-2/5">
                            Institusi
                        </p>
                        <p className="text-curious-blue basis-1/2">
                            {data.institusi ?? "-"}
                        </p>
                    </div>
                </div>
            ) : (
                <form className="grid grid-flow-col grid-cols-1 lg:grid-cols-2 grid-rows-[repeat(9,_minmax(0,_1fr))] lg:grid-rows-[repeat(7,_minmax(0,_1fr))] gap-x-14 gap-4 xl:gap-4 w-full mt-6">
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="name"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            Nama
                        </label>
                        <input
                            id="name"
                            value={data.name}
                            onChange={(ev) =>
                                onChangeUserData(ev.target.id, ev.target.value)
                            }
                            className="input input-primary input-sm input-bordered basis-1/2 xl:basis-2/3"
                        />
                    </div>
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="tanggallahir"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            Tanggal lahir
                        </label>
                        <input
                            id="tanggallahir"
                            value={
                                data.tanggallahir
                                    ? formatDateHTML(data.tanggallahir)
                                    : ""
                            }
                            onChange={(ev) =>
                                onChangeUserData(
                                    ev.target.id,
                                    parseToLocaleDate(ev.target.value)
                                )
                            }
                            type="date"
                            className="input input-primary input-sm input-bordered basis-1/2 xl:basis-2/3"
                        />
                    </div>
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="nohp"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            No. HP
                        </label>
                        <input
                            id="nohp"
                            value={data.nohp}
                            onChange={(ev) =>
                                onChangeUserData(ev.target.id, ev.target.value)
                            }
                            className="input input-primary input-sm input-bordered basis-1/2 xl:basis-2/3"
                        />
                    </div>
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="pekerjaan"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            Pekerjaan
                        </label>
                        <input
                            id="pekerjaan"
                            value={data.pekerjaan}
                            onChange={(ev) =>
                                onChangeUserData(ev.target.id, ev.target.value)
                            }
                            className="input input-primary input-sm input-bordered basis-1/2 xl:basis-2/3"
                        />
                    </div>
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="gender"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            Gender
                        </label>
                        <div className="flex gap-3 items-center" id="gender">
                            <input
                                className="radio radio-primary radio-sm"
                                type="radio"
                                name="gender"
                                id="gender_pr"
                                value="Pria"
                                checked={data.gender === "Pria" ? true : false}
                                onChange={(ev) =>
                                    onChangeUserData("gender", ev.target.value)
                                }
                            />
                            Pria
                            <input
                                className="radio radio-primary radio-sm"
                                type="radio"
                                name="gender"
                                id="gender_wn"
                                value="Wanita"
                                checked={
                                    data.gender === "Wanita" ? true : false
                                }
                                onChange={(ev) =>
                                    onChangeUserData("gender", ev.target.value)
                                }
                            />
                            Wanita
                        </div>
                    </div>
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="kota"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            Kota/Kabupaten
                        </label>
                        <input
                            id="kota"
                            value={data.kota}
                            onChange={(ev) =>
                                onChangeUserData(ev.target.id, ev.target.value)
                            }
                            className="input input-primary input-sm input-bordered basis-1/2 xl:basis-2/3"
                        />
                    </div>
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="provinsi"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            Provinsi
                        </label>
                        <input
                            id="provinsi"
                            value={data.provinsi}
                            onChange={(ev) =>
                                onChangeUserData(ev.target.id, ev.target.value)
                            }
                            className="input input-primary input-sm input-bordered basis-1/2 xl:basis-2/3"
                        />
                    </div>
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="pendidikan"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            Pendidikan terakhir
                        </label>
                        <input
                            id="pendidikan"
                            value={data.pendidikan}
                            onChange={(ev) =>
                                onChangeUserData(ev.target.id, ev.target.value)
                            }
                            className="input input-primary input-sm input-bordered basis-1/2 xl:basis-2/3"
                        />
                    </div>
                    <div className="flex justify-start items-center">
                        <label
                            htmlFor="institusi"
                            className="text-slate-700 basis-1/2 lg:basis-2/5"
                        >
                            Institusi
                        </label>
                        <input
                            id="institusi"
                            value={data.institusi}
                            onChange={(ev) =>
                                onChangeUserData(ev.target.id, ev.target.value)
                            }
                            className="input input-primary input-sm input-bordered basis-1/2 xl:basis-2/3"
                        />
                    </div>
                </form>
            )}
        </>
    );
}
