import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function showArticle({ auth, article }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="" />

            <section className="mt-8 w-full pb-14">
                <h1 className="text-center text-3xl font-bold">
                    {article.title}
                </h1>
                <p className="text-center text-slate-400 text-sm">
                    {new Date(article.created_at).toLocaleDateString("id-ID", {
                        dateStyle: "long",
                    })}
                </p>
                <img
                    src={article.image}
                    alt=""
                    className="bg-slate-300 aspect-video w-full my-6"
                />
                <div className="w-4/5 mx-auto text-justify">{article.body}</div>
            </section>
        </AuthenticatedLayout>
    );
}
