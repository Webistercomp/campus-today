import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import CheckIcon from "@/icons/CheckIcon";
import XIcon from "@/icons/XIcon";
import { Head, Link } from "@inertiajs/react";
import EWallet from "@/images/e-wallet-rafiki.png";

export default function Deskripsi({ auth, title, packet }) {
    const deskripsiPaket = {
        type: packet.name,
        price: packet.price_discount ?? packet.price_not_discount,
        benefit: JSON.parse(packet.benefits).v,
        nonBenefit: JSON.parse(packet.benefits).x,
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link href={route("paket.index")}>Beli Paket</Link>
                    </li>
                    <li>{packet.name}</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {packet.name}
                </h1>
                <div className="flex gap-8">
                    <div className="basis-3/5 mt-8">
                        <h6 className="text-slate-800 w-fit mb-4 custom-underline">
                            Deskripsi
                        </h6>
                        <hr />
                        <table className="text-left mt-6 text-sm">
                            {deskripsiPaket.benefit.map((str, i) => (
                                <tr className="flex items-start gap-2 mb-[2px]" key={i}>
                                    <td>
                                        <CheckIcon
                                            className={`fill-black self-start`}
                                        />
                                    </td>
                                    <td>
                                        <span className="basis-[85%]">
                                            {str}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                            {deskripsiPaket.nonBenefit.map((str, i) => (
                                <tr className="flex items-start gap-2 mb-[2px]" key={i}>
                                    <td>
                                        <XIcon className="fill-red-500 self-start" />
                                    </td>
                                    <td>
                                        <span className="basis-[85%]">
                                            {str}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                        </table>
                    </div>
                    <div className="basis-2/5 flex flex-col justify-center border-curious-blue border-2 rounded-xl text-center py-6 px-20">
                        <img
                            src={EWallet}
                            alt="E-Wallet Illustration"
                            className="mx-auto aspect-auto w-72"
                        />
                        <h1 className="text-xl font-semibold text-slate-800">
                            Paket Bimbel
                        </h1>
                        <h2 className="text-3xl font-semibold text-curious-blue">
                            {deskripsiPaket.type}
                        </h2>
                        <p className="text-2xl font-semibold text-slate-800 mt-2 mb-8">
                            Rp.{" "}
                            {new Intl.NumberFormat("id-ID").format(
                                deskripsiPaket.price
                            )}
                        </p>
                        <Link
                            href={route('paket.checkout', packet.id)}
                        >
                            <button className="btn btn-primary">
                                Beli Sekarang
                            </button>
                        </Link>
                    </div>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
