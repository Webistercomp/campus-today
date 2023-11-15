import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Checkout({ auth, title, packet }) {
    let IDRupiah = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    });
    
    const full_name = auth.user.name.split(' ')
    const first_name = full_name[0]
    const last_name = full_name.length != 1 ? full_name[full_name.length - 1] : ''
    const data = {
        "first_name": first_name,
        "last_name": last_name,
        "email": auth.user.email,
        "phone": auth.user.nohp,
        "payment_method": "default",
    }

    function selanjutnya() {
        console.log(data)
    }

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
                    <li>
                        <Link href={route("paket.show", packet.id)}>
                            {packet.name}
                        </Link>
                    </li>
                    <li>Checkout</li>
                </ul>
            </div>

            <section>
                <h1 className="text-3xl text-curious-blue font-semibold">
                    {title}
                </h1>
                <div className="border-2 p-6 rounded-2xl mt-6">
                    <div className="flex">
                        <div className="flex flex-col gap-4 basis-1/4">
                            <input
                                type="text"
                                placeholder="First Name"
                                className="input input-bordered input-sm w-full"
                                value={data.first_name}
                            />
                            <input
                                type="text"
                                placeholder="Last Name"
                                className="input input-bordered input-sm w-full"
                                value={data.last_name}
                            />
                            <input
                                type="email"
                                placeholder="Email"
                                className="input input-bordered input-sm w-full"
                                value={data.email}
                            />
                            <input
                                type="text"
                                pattern="[0-9]"
                                placeholder="No. HP"
                                className="input input-bordered input-sm w-full"
                                value={data.phone}
                            />
                            <select className="select select-bordered select-sm w-full">
                                <option disabled selected>
                                    Metode Pembayaran
                                </option>
                                <option>Transfer</option>
                                <option>Gopay</option>
                                <option>ShopeePay</option>
                            </select>
                        </div>
                        <div className="divider divider-horizontal"></div>
                        <div className="basis-3/4 text-slate-800">
                            <table className="w-full">
                                <thead className="[&>th]:text-start [&>th]:px-4 [&>th]:py-3 border-b-2 border-t-2">
                                    <th>Items</th>
                                    <th className="w-40">Price</th>
                                    <th className="w-28">Total</th>
                                </thead>
                                <tbody className="[&>tr>td]:text-start [&>tr>td]:px-4 [&>tr>td]:py-2">
                                    <tr>
                                        <td>Paket {packet.name}</td>
                                        <td>{IDRupiah.format(packet.price_discount)}</td>
                                        <td>{IDRupiah.format(packet.price_discount)}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div className="divider divider-vertical"></div>
                    <div className="flex justify-between">
                        <Link
                            href={route('paket.show', packet.id)}
                            className="btn"
                        >
                            Kembali
                        </Link>
                        <Link
                            to={{ pathname: route(`paket.payment`, packet.id), state: data }}
                            onClick={selanjutnya}
                        >
                            <button className="btn btn-primary">
                                Selanjutnya
                            </button>
                        </Link>
                    </div>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
