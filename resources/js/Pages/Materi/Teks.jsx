import Alert from "@/Components/Alert";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import DocumentIcon from "@/icons/DocumentIcon";
import { Head, Link } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function Teks({ auth, title, type, materials, flash }) {
    const tabGroup = materials.map((material) => material.group_type);
    const [tabIndexActive, setTabIndexActive] = useState(tabGroup[0]?.id);
    const [currentMaterials, setCurrentMaterials] = useState(() =>
        materials.filter((material) => material.group_id === tabIndexActive)
    );
    const [searchkeyword, setSearchKeyword] = useState("");
    const [flashData, setFlashData] = useState({
        type: "success",
        isShow: false,
        msg: "",
    });

    useEffect(() => {
        if (flash.msg !== null) setFlashData({ ...flash, isShow: true });

        const flashTimeout = setTimeout(() => {
            setFlashData({ ...flash, isShow: false });
        }, 3000);

        return () => clearTimeout(flashTimeout);
    }, []);

    useEffect(() => {
        setCurrentMaterials(
            materials.filter((material) => material.group_id === tabIndexActive)
        );
    }, [tabIndexActive]);

    useEffect(() => {
        setCurrentMaterials(
            materials.filter(
                (material) =>
                    material.title.match(new RegExp(searchkeyword, "i")) &&
                    material.group_id === tabIndexActive
            )
        );
    }, [searchkeyword]);

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link
                            href={route("material.type", [type])}
                            className="capitalize"
                        >
                            Materi&nbsp;
                            <span className="uppercase">{type}</span>
                        </Link>
                    </li>
                    <li className="capitalize">{title}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-2xl xl:text-3xl text-curious-blue font-semibold capitalize">
                    {title}
                </h1>

                <div className="flex flex-col lg:flex-row justify-between gap-6 items-stretch mt-4 border-b-2 pb-3">
                    <div className="flex gap-14 w-full items-center">
                        {tabGroup.map((groupType, i) => (
                            <a
                                className={`text-center text-xs lg:text-base relative cursor-pointer uppercase ${
                                    groupType.id === tabIndexActive
                                        ? "tab-active after:opacity-100"
                                        : "tab-active after:opacity-0 after:bottom-0"
                                }`}
                                onClick={() => setTabIndexActive(groupType.id)}
                                key={i}
                            >
                                {groupType.name}
                            </a>
                        ))}
                    </div>
                    <div className="form-control">
                        <input
                            type="text"
                            placeholder="Cari"
                            className="input input-sm input-bordered w-full md:w-auto"
                            value={searchkeyword}
                            onChange={(ev) => setSearchKeyword(ev.target.value)}
                        />
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    {currentMaterials.map((material, i) => {
                        // Return the element. Also pass key
                        return (
                            <Link
                                href={route("material.type.teks.subtype", [
                                    material.material_type.code,
                                    material.code,
                                ])}
                                key={i}
                                className="bg-white shadow-lg basis-1/3 rounded-xl p-4 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all"
                            >
                                <div className="bg-curious-blue aspect-square flex items-center justify-center h-full rounded-lg p-4">
                                    <DocumentIcon className="w-12" />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <h4 className="uppercase text-curious-blue font-semibold text-lg">
                                        {material.title}
                                    </h4>
                                    <p className="text-black">
                                        {material.description}
                                    </p>
                                </div>
                            </Link>
                        );
                    })}
                </div>
            </section>
            <Alert {...flashData} />
        </AuthenticatedLayout>
    );
}
