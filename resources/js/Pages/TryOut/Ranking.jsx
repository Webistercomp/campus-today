import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Ranking({ auth, title, tryoutName, rankData }) {
    const RankData = [
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
        {
            userId: 1,
            username: "Farhan",
            score: 97,
            date: "2023-11-20",
        },
    ];

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <div className="text-sm breadcrumbs my-6">
                <ul>
                    <li>
                        <Link href={route("dashboard")}>Dashboard</Link>
                    </li>
                    <li>
                        <Link href={route("tryout")}>TryOut</Link>
                    </li>
                    <li>{title}</li>
                </ul>
            </div>

            <section className="text-center">
                <h1 className="text-3xl text-curious-blue font-semibold">
                    Ranking {tryoutName}
                </h1>

                <div className="relative rounded-lg max-w-2xl mx-auto overflow-y-hidden hover:overflow-y-scroll gutter-stable shadow-xl h-[calc(100dvh_-_270px)] mt-4">
                    <table className="table">
                        <thead className="bg-curious-blue text-white sticky top-0">
                            <tr>
                                <th className="w-16 text-center">No.</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            {RankData.map((data, i) => (
                                <tr
                                    className="hover:bg-curious-blue hover:bg-opacity-10 even:bg-slate-100"
                                    key={i}
                                >
                                    <td className="text-center">{i + 1}</td>
                                    <td>{data.username}</td>
                                    <td>{data.score}</td>
                                    <td>
                                        {new Date(data.date).toLocaleDateString(
                                            "id-ID",
                                            { dateStyle: "long" }
                                        )}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
