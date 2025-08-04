export default function PembelianPaket({ historyPembelian }) {
    const parseToLocaleDate = (dateString) => {
        return new Date(dateString).toLocaleDateString("id-ID", {
            dateStyle: "long",
        });
    };

    return (
        <>
            <div className="w-full mt-3">
                <table className="table-auto w-full border-collapse border">
                    <thead>
                        <tr className="">
                            <th className="border p-3">No</th>
                            <th className="border p-3">Nama Paket</th>
                            <th className="border p-3">Tanggal Pembelian</th>
                            <th className="border p-3">Tanggal Expire</th>
                            <th className="border p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody className="text-center">
                        {historyPembelian.map((paket, index) => (
                            <tr key={paket.id}>
                                <td className="border p-1">{index + 1}</td>
                                <td className="border p-1">{paket.packet.name}</td>
                                <td className="border p-1">{parseToLocaleDate(paket.created_at)}</td>
                                <td className="border p-1">{parseToLocaleDate(paket.expired_at)}</td>
                                <td className="border p-1">{paket.status}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </>
    );
}
