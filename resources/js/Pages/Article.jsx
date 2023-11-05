import ArticleCard from "@/Components/ArticleCard";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Article({ title, auth }) {
    const { user } = auth;

    const articleData = [
        {
            image: "",
            title: "Judul Artikel",
            desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ducimus ipsam quidem porro quam dolore esse perferendis provident iste voluptatibus.",
        },
        {
            image: "",
            title: "Judul Artikel",
            desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ducimus ipsam quidem porro quam dolore esse perferendis provident iste voluptatibus.",
        },
        {
            image: "",
            title: "Judul Artikel",
            desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ducimus ipsam quidem porro quam dolore esse perferendis provident iste voluptatibus.",
        },
        {
            image: "",
            title: "Judul Artikel",
            desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ducimus ipsam quidem porro quam dolore esse perferendis provident iste voluptatibus.",
        },
        {
            image: "",
            title: "Judul Artikel",
            desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ducimus ipsam quidem porro quam dolore esse perferendis provident iste voluptatibus.",
        },
        {
            image: "",
            title: "Judul Artikel",
            desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ducimus ipsam quidem porro quam dolore esse perferendis provident iste voluptatibus.",
        },
    ];

    const formatDate = (date) => {
        const stringDate = new Date(date).toLocaleDateString("id-ID", {
            dateStyle: "long",
        });

        return stringDate;
    };

    return (
        <AuthenticatedLayout user={user}>
            <Head title={title} />

            <section className="w-full pb-20">
                <h1 className="text-3xl font-semibold text-slate-800 text-center">
                    Artikel
                </h1>

                <div className="mt-8">
                    <div className="flex gap-6 items-center border-2 border-slate-200 max-w-6xl mx-auto">
                        <img
                            src=""
                            alt=""
                            className="bg-slate-700 max-w-[350px] aspect-[5/4] basis-1/3"
                        />
                        <div className="basis-2/3 px-8 text-slate-700">
                            <p className="text-xs text-slate-400">
                                {formatDate("01-Oct-2023")}
                            </p>
                            <h3 className="text-2xl font-semibold">
                                Judul Artikel
                            </h3>
                            <p className="mt-4">
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Voluptas dolorum, enim nam
                                animi aliquam minima id minus illum laudantium
                                incidunt!
                            </p>
                        </div>
                    </div>
                    <div className="flex justify-between items-center mt-6 max-w-6xl mx-auto px-8">
                        <div className="flex gap-1">
                            <div className="aspect-square w-3 cursor-pointer rounded-full bg-curious-blue"></div>
                            <div className="aspect-square w-3 cursor-pointer rounded-full bg-slate-400"></div>
                            <div className="aspect-square w-3 cursor-pointer rounded-full bg-slate-400"></div>
                        </div>
                        <div>
                            <Link className="text-slate-400 link-hover">
                                &laquo; Previous
                            </Link>
                            <Link className="text-curious-blue ml-4 link-hover">
                                Next &raquo;
                            </Link>
                        </div>
                    </div>
                </div>

                <div className="mt-12 grid grid-cols-3 gap-4">
                    {articleData.map((artc, i) => (
                        <ArticleCard {...artc} key={i} />
                    ))}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
