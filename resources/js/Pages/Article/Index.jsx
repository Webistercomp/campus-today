import ArticleCard from "@/Components/ArticleCard";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function Article({ auth, title, articles, latest_article }) {
    const [latestArticleMetadata, setLatestArticleMetadata] = useState({
        latestArticleWrapperWidth: 0,
        childScrollPosition: [],
    });
    const [activeLatestArticle, setActiveLatestArticle] = useState(0);
    const [pauseInterval, setPauseInterval] = useState(false);

    const formatDate = (date) => {
        const stringDate = new Date(date).toLocaleDateString("id-ID", {
            dateStyle: "long",
        });

        return stringDate;
    };

    useEffect(() => {
        const latestArticleWrapperWidth = document.getElementById(
            "latest_article_wrapper"
        ).clientWidth;
        setLatestArticleMetadata({
            ...latestArticleMetadata,
            latestArticleWrapperWidth: latestArticleWrapperWidth,
            childScrollPosition: [
                latestArticleWrapperWidth * 1 - latestArticleWrapperWidth + 32,
                latestArticleWrapperWidth * 2 - latestArticleWrapperWidth + 32,
                latestArticleWrapperWidth * 3 - latestArticleWrapperWidth + 32,
            ],
        });
    }, []);

    useEffect(() => {
        const latestArticleInterval = setInterval(() => {
            if (!pauseInterval) {
                setActiveLatestArticle((prev) => {
                    if (prev + 1 === 3) {
                        return 0;
                    } else {
                        return prev + 1;
                    }
                });
            }
        }, 5000);
        return () => clearInterval(latestArticleInterval);
    }, [pauseInterval]);

    useEffect(() => {
        const latestArticleWrapper = document.getElementById(
            "latest_article_wrapper"
        );

        latestArticleWrapper.scrollTo({
            left: latestArticleMetadata.childScrollPosition[
                activeLatestArticle
            ],
            top: 0,
        });
    }, [activeLatestArticle]);

    const nextLatestArticle = () => {
        setPauseInterval(true);
        setActiveLatestArticle((prev) => (prev < 2 ? prev + 1 : 0));
        setTimeout(() => {
            setPauseInterval(false);
        }, 5000);
    };

    const previousLatestArticle = () => {
        setPauseInterval(true);
        setActiveLatestArticle((prev) => (prev > 0 ? prev - 1 : 2));
        setTimeout(() => {
            setPauseInterval(false);
        }, 5000);
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={title} />

            <section className="w-full pb-20 pt-8">
                <h1 className="text-3xl font-semibold text-slate-800 text-center">
                    Artikel
                </h1>

                <div className="mt-8">
                    <div
                        className="max-w-6xl overflow-x-scroll snap-x snap-mandatory scrollbar-hide mx-auto"
                        id="latest_article_wrapper"
                        style={{ scrollBehavior: "smooth" }}
                    >
                        <div
                            className={`grid grid-cols-3 gap-x-8 px-8`}
                            style={{
                                width:
                                    latestArticleMetadata.latestArticleWrapperWidth *
                                        3 +
                                    32 * 4,
                            }}
                        >
                            {latest_article.map((latest, i) => (
                                <Link
                                    href={route("article.show", latest.id)}
                                    key={i}
                                >
                                    <div
                                        className={`flex flex-col lg:flex-row lg:items-center gap-6 border-2 border-slate-200 max-w-6xl snap-center cursor-pointer`}
                                        style={{
                                            width: latestArticleMetadata.latestArticleWrapperWidth,
                                        }}
                                    >
                                        <figure>
                                            <img
                                                src={latest.image}
                                                alt={title}
                                                className="bg-slate-500 w-full aspect-[3/2] md:aspect-[4/2] lg:h-[300px] xl:h-[400px] lg:aspect-[4/3] basis-1/3 object-cover"
                                            />
                                        </figure>
                                        <div className="basis-2/3 px-4 pb-2 text-slate-700">
                                            <p className="text-xs text-slate-400">
                                                {formatDate(latest.updated_at)}
                                            </p>
                                            <h3 className="text-2xl font-semibold">
                                                {latest.title}
                                            </h3>
                                            <p className="mt-4">
                                                {latest.description}
                                            </p>
                                        </div>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </div>
                    <div className="flex justify-between items-center mt-6 max-w-6xl mx-auto px-8">
                        <div className="flex gap-1">
                            {latest_article.map((l, i) => (
                                <div
                                    key={i}
                                    className={`aspect-square w-3 rounded-full ${
                                        activeLatestArticle === i
                                            ? "bg-curious-blue"
                                            : "bg-slate-400"
                                    }`}
                                ></div>
                            ))}
                        </div>
                        <div>
                            <button
                                onClick={previousLatestArticle}
                                className="text-slate-400 link-hover"
                            >
                                &laquo; Previous
                            </button>
                            <button
                                onClick={nextLatestArticle}
                                className="text-curious-blue ml-4 link-hover"
                            >
                                Next &raquo;
                            </button>
                        </div>
                    </div>
                </div>

                <div className="mt-12 grid grid-cols-2 lg:grid-cols-3 gap-2 md:gap-3">
                    {articles.map((article, i) => (
                        <Link href={route("article.show", article.id)} key={i}>
                            <ArticleCard {...article} />
                        </Link>
                    ))}
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
