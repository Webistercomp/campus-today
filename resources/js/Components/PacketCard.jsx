import CheckIcon from "@/icons/CheckIcon";
import XIcon from "@/icons/XIcon";
import { Link } from "@inertiajs/react";

export default function PacketCard({
    id,
    name,
    benefits,
    price_not_discount,
    price_discount,
}) {
    benefits = JSON.parse(benefits);
    let v = benefits.v;
    let x = benefits.x;
    const isPopular = name === "Friendly" || name === "Platinum";
    const isRed = name === "Ambisius" || name === "Gold";

    return (
        <div
            className={`text-left snap-center basis-1/3 p-4 md:p-8 flex flex-col items-start justify-between rounded-xl shadow-lg gap-6 border-2 border-pelorous-300 ${
                isPopular
                    ? "bg-curious-blue"
                    : isRed
                    ? "bg-[#CF514E] text-white"
                    : "bg-white"
            }`}
        >
            <div
                className={`${isPopular && "text-white"} ${
                    isRed && "text-white"
                }`}
            >
                {isPopular && (
                    <p className="mb-2 bg-pelorous-300 w-fit py-2 px-3 rounded-lg text-sm text-black">
                        Popular
                    </p>
                )}
                <h3
                    className={`${
                        isRed ? "bg-selective-yellow-300" : "bg-slate-300"
                    } py-2 px-3 w-fit rounded-lg font-semibold text-sm text-black`}
                >
                    {name}
                </h3>
                <p
                    className={`text-4xl font-bold mt-6 ${
                        isPopular ? "text-white" : "text-blue-500"
                    } ${isRed && "text-white"}`}
                >
                    Rp. {new Intl.NumberFormat("id-ID").format(price_discount)}
                </p>
                <div className="divider"></div>
                <table className="text-left mt-6 max-w-xs text-sm">
                    <tbody>
                        {v.map((str, i) => (
                            <tr
                                className="flex items-start gap-2 mb-[2px]"
                                key={i}
                            >
                                <td>
                                    <CheckIcon
                                        className={`${
                                            isPopular || isRed
                                                ? "fill-white"
                                                : "fill-black"
                                        } self-start`}
                                    />
                                </td>
                                <td>
                                    <span className="basis-[85%]">{str}</span>
                                </td>
                            </tr>
                        ))}
                        {x.map((str, i) => (
                            <tr
                                className="flex items-start gap-2 mb-[2px]"
                                key={i}
                            >
                                <td>
                                    <XIcon className="fill-red-500 self-start" />
                                </td>
                                <td>
                                    <span className="basis-[85%]">{str}</span>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
            {id == 1 && price_not_discount == 0 ? (
                <Link href={route("dashboard")} className="self-center">
                    <button
                        className={`btn btn-info capitalize px-10 ${
                            isPopular
                                ? "bg-selective-yellow-300 border-selective-yellow-300 text-black hover:bg-selective-yellow-500 hover:border-selective-yellow-500"
                                : "text-white bg-black hover:bg-slate-700"
                        }`}
                    >
                        Belajar Sekarang
                    </button>
                </Link>
            ) : (
                <Link href={route("paket.show", id)} className="self-center">
                    <button
                        className={`btn btn-info capitalize px-10 ${
                            isPopular || isRed
                                ? "bg-selective-yellow-300 border-selective-yellow-300 text-black hover:bg-selective-yellow-500 hover:border-selective-yellow-500"
                                : "text-white bg-black hover:bg-slate-700"
                        }`}
                    >
                        Beli Sekarang
                    </button>
                </Link>
            )}
        </div>
    );
}
