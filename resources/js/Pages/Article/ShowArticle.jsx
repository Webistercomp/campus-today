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
                <figure className="flex mb-8">    
                    <img
                        src={article.image}
                        alt=""
                        className="bg-slate-500 w-3/4 aspect-video object-cover block mx-auto"
                    />
                </figure>
                <div className="w-4/5 text-justify">{article.body}</div>
                {/* tombol kembali */}
                <div className="mt-8 flex pb-14">
                    <a href={route("article.index")} className="btn btn-primary btn-outline">
                        Kembali ke List Artikel
                    </a>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
