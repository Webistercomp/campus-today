import ArticleCard from "@/Components/ArticleCard";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Article({ auth, title, articles, latest_article }) {
    const { user } = auth;
    const articleData = articles;

    const formatDate = (date) => {
        const stringDate = new Date(date).toLocaleDateString("id-ID", {
            dateStyle: "long",
        });

        return stringDate;
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <section className="w-full pb-20">
                <h1 className="text-3xl font-semibold text-slate-800 text-center">
                    Artikel
                </h1>

                <div className="mt-8">
                    <div className="flex gap-6 items-center border-2 border-slate-200 max-w-6xl mx-auto">
                        <img
                            src={latest_article.image}
                            alt=""
                            className="bg-slate-700 max-w-[350px] aspect-[5/4] basis-1/3"
                        />
                        <div className="basis-2/3 px-8 text-slate-700">
                            <p className="text-xs text-slate-400">
                                {formatDate(latest_article.updated_at)}
                            </p>
                            <h3 className="text-2xl font-semibold">
                                {latest_article.title}
                            </h3>
                            <p className="mt-4">
                                {latest_article.description}
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
                    {articles.map((article, i) => (
                        <Link href={route('article.show', article.id)} key={i} >
                            <ArticleCard {...article}/>
                        </Link>
                    ))}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
