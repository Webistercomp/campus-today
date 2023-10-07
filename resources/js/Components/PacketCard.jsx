import CheckIcon from "@/icons/CheckIcon";
import XIcon from "@/icons/XIcon";

export default function PacketCard({
    type,
    price,
    benefit,
    nonBenefit,
    isPopular,
}) {
    return (
        <div
            className={`basis-1/3 p-8 flex flex-col items-start justify-between rounded-xl shadow-lg gap-6 border-2 border-pelorous-300 ${
                isPopular ? "bg-curious-blue" : "bg-white"
            }`}
        >
            <div className={`${isPopular ? "text-white" : ""}`}>
                {isPopular && (
                    <p className="mb-2 bg-pelorous-300 w-fit py-2 px-3 rounded-lg text-sm text-black">
                        Popular
                    </p>
                )}
                <h3 className="bg-slate-300 py-2 px-3 w-fit rounded-lg font-semibold text-sm text-black">
                    {type}
                </h3>
                <p
                    className={`text-4xl font-bold mt-6 ${
                        isPopular ? "text-white" : "text-blue-500"
                    }`}
                >
                    Rp. {new Intl.NumberFormat("id-ID").format(price)}
                </p>
                <p className="text-xs font-semibold mt-3">
                    per member, per month
                </p>
                <div className="divider"></div>
                <table className="text-left mt-6 max-w-xs text-sm">
                    {benefit.map((str) => (
                        <tr className="flex items-start gap-2 mb-[2px]">
                            <td>
                                <CheckIcon
                                    className={`${
                                        isPopular ? "fill-white" : "fill-black"
                                    } self-start`}
                                />
                            </td>
                            <td>
                                <span className="basis-[85%]">{str}</span>
                            </td>
                        </tr>
                    ))}
                    {nonBenefit.map((str) => (
                        <tr className="flex items-start gap-2 mb-[2px]">
                            <td>
                                <XIcon className="fill-red-500 self-start" />
                            </td>
                            <td>
                                <span className="basis-[85%]">{str}</span>
                            </td>
                        </tr>
                    ))}
                </table>
            </div>
            <button
                className={`btn btn-info capitalize px-10 self-center ${
                    isPopular
                        ? "bg-selective-yellow-300 border-selective-yellow-300 text-black hover:bg-selective-yellow-500 hover:border-selective-yellow-500"
                        : "text-white"
                }`}
            >
                Beli Sekarang
            </button>
        </div>
    );
}
