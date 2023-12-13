import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import DocumentIcon from "@/icons/DocumentIcon";
import PlayIcon from "@/icons/PlayIcon";
import { Head, Link } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function SkdVideo({
    auth,
    title,
    type,
    materialType,
    materials,
}) {
    const tabGroup = materials.map((material) => material.group_type);
    const [tabIndexActive, setTabIndexActive] = useState(tabGroup[0]?.id);
    const [currentMaterials, setCurrentMaterials] = useState(() =>
        materials.filter((material) => material.group_id === tabIndexActive)
    );
    const [searchkeyword, setSearchKeyword] = useState("");

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
                        <Link href={route("material.type", type)}>
                            {materialType.name}
                        </Link>
                    </li>
                    <li>{title}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {title}
                </h1>
                {type == "videoseries" ? (
                    ""
                ) : (
                    <div className="flex justify-between gap-8 items-center mt-4 border-b-2 pb-3">
                        <div className="flex gap-14 w-full">
                            {tabGroup.map((groupType, i) => (
                                <a
                                    className={`text-center relative cursor-pointer uppercase ${
                                        groupType.id === tabIndexActive
                                            ? "tab-active after:opacity-100"
                                            : "tab-active after:opacity-0 after:bottom-0"
                                    }`}
                                    onClick={() =>
                                        setTabIndexActive(groupType.id)
                                    }
                                >
                                    {groupType.name}
                                </a>
                            ))}
                        </div>
                        <div className="form-control">
                            <input
                                type="text"
                                placeholder="Cari"
                                className="input input-bordered w-24 md:w-auto"
                                value={searchkeyword}
                                onChange={(ev) =>
                                    setSearchKeyword(ev.target.value)
                                }
                            />
                        </div>
                    </div>
                )}
                <div className="flex gap-6 mt-6">
                    {currentMaterials.map((material, i) => {
                        // Return the element. Also pass key
                        return (
                            <Link
                                href={route("material.type.video.subtype", [
                                    material.material_type.code,
                                    material.code,
                                ])}
                                className="bg-white shadow-lg basis-1/3 rounded-xl p-4 flex gap-4 items-center cursor-pointer hover:bg-slate-200 duration-150 transition-all"
                                key={i}
                            >
                                <div className="bg-curious-blue aspect-square flex items-center justify-center h-full rounded-lg p-4">
                                    <PlayIcon className="w-12 stroke-white" />
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
        </AuthenticatedLayout>
    );
}
