// import AuthenticatedLayout from "@/Layouts/AuthenticatedLayoutCTX";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import ArrowRightIcon from "@/icons/ArrowRightIcon";
import BookIcon from "@/icons/BookIcon";
import PoliceIcon from "@/icons/PoliceIcon";
import VideoPlayIcon from "@/icons/VideoPlayIcon";
import { Head, Link, router } from "@inertiajs/react";
import KnowIllus from "@/images/illus-knowledge.png";
import LearningAmico from "@/images/learning-amico.png";
import ExamBro from "@/images/exams-bro.png";
import LearningBro from "@/images/learning-bro.png";
import FAQCard from "@/Components/FAQCard";
import ArticleCard from "@/Components/ArticleCard";

export default function Dashboard({ auth, articles, materialTypes }) {
    const FAQ = [
        {
            question: "Bagaimana cara membuat akun di Campus Today?",
            answer: "asdnkasdnflkabsdfbsdf",
        },
        {
            question:
                "Bagaimana cara upgrade paket Premium / Platinum / Bimbel?",
            answer: "Silakan daftar/login terlebih dahulu. Lalu pilih menu Paket dan pilih paket yang paling sesuai dengan kebutuhan belajar kamu.",
        },
        {
            question: "Berapa lama masa berlaku paket yang saya beli?",
            answer: "asdnkasdnflkabsdfbsdf",
        },
        {
            question:
                "Apakah pembayaran bisa melalui Bank, Indomaret dan E-Wallet?",
            answer: "asdnkasdnflkabsdfbsdf",
        },
        {
            question: "Bagaimana mengatasi lupa password?",
            answer: "asdnkasdnflkabsdfbsdf",
        },
        {
            question: "Apakah Campus Today dapat diakses di Smartphone?",
            answer: "asdnkasdnflkabsdfbsdf",
        },
    ];

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <section className="bg-white mt-6">
                <h1 className="font-bold text-2xl">Mulai Belajar</h1>
                <div className="flex gap-8 justify-between mt-6">
                    {materialTypes.map((materialType, i) => {
                        return (
                            <Link
                                href={route("material.type", materialType.code)}
                                className="basis-1/3 p-6 bg-white shadow-lg rounded-lg flex gap-4 cursor-pointer hover:bg-slate-100 transition-all duration-150"
                                key={i}
                            >
                                <PoliceIcon className="basis-1/5 fill-curious-blue" />
                                <div className="basis-4/5 flex flex-col justify-center gap-4">
                                    <h4 className="text-xl font-semibold">
                                        {materialType.name}
                                    </h4>
                                    <p className="text-curious-blue font-semibold flex items-end gap-6">
                                        Belajar{" "}
                                        <span>
                                            <ArrowRightIcon />
                                        </span>
                                    </p>
                                </div>
                            </Link>
                        );
                    })}
                </div>
            </section>

            <section className="bg-white mt-12">
                <div className="bg-gradient-to-b from-curious-blue-500 to-curious-blue-300 px-20 py-6 rounded-2xl flex justify-between items-center">
                    <div className="flex flex-col items-start gap-14 basis-1/2">
                        <h4 className="text-white text-4xl font-semibold">
                            Wujudkan Potensi Terbaik dengan Materi Premium
                        </h4>
                        <Link
                            href={route("belipaket")}
                            className="btn bg-white border-none text-curious-blue-300 capitalize text-xl"
                        >
                            Beli Paket
                        </Link>
                    </div>
                    <img
                        src={KnowIllus}
                        alt="knowledge-illus"
                        className="w-1/3"
                    />
                </div>
            </section>

            <section className="bg-white mt-12">
                <div>
                    <h1 className="font-bold text-2xl">
                        TryOut dan Tes Minat Bakat
                    </h1>
                    <p className="mt-2">
                        Uji Kemampuan Anda Dengan Soal Latihan
                    </p>
                </div>
                <div className="flex gap-4 mt-8">
                    <div className="flex flex-col basis-1/2 bg-white shadow-xl py-10 gap-2 items-center rounded-xl">
                        <img
                            src={ExamBro}
                            alt="exam-bro"
                            className="basis-4/5"
                        />
                        <h3 className="uppercase font-semibold text-xl">
                            Event TryOut
                        </h3>
                        <button className="btn btn-primary capitalize text-white px-8">
                            Mulai
                        </button>
                    </div>
                    <div className="flex flex-col basis-1/2 bg-white shadow-xl py-10 gap-2 items-center rounded-xl">
                        <img
                            src={LearningAmico}
                            alt="learning-amico"
                            className="basis-4/5"
                        />
                        <h3 className="uppercase font-semibold text-xl">
                            TryOut Gratis & Platinum
                        </h3>
                        <Link href={route("tryout")}>
                            <button className="btn btn-primary capitalize text-white px-8">
                                Mulai
                            </button>
                        </Link>
                    </div>
                    <div className="flex flex-col basis-1/2 bg-white shadow-xl py-10 gap-2 items-center rounded-xl">
                        <img
                            src={LearningBro}
                            alt="learning-bro"
                            className="basis-4/5"
                        />
                        <h3 className="uppercase font-semibold text-xl">
                            Tes Minat Bakat
                        </h3>
                        <button className="btn btn-primary capitalize text-white px-8">
                            Mulai
                        </button>
                    </div>
                </div>
            </section>

            <section className="px-36 mt-12 bg-white">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Kamu Nanya, Kami Jawab
                </h1>
                <div className="flex flex-col gap-2 max-w-4xl mx-auto">
                    {FAQ.map((dt, i) => (
                        <FAQCard key={i} index={i} {...dt} />
                    ))}
                </div>
            </section>

            <section className="px-36 mt-12 bg-white text-center pb-8">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Artikel
                </h1>
                <div className="flex gap-6 mx-auto">
                    {articles
                        .slice(Math.max(articles.length - 3, 0))
                        .map((article, i) => {
                            // Return the element. Also pass key
                            return (
                                <ArticleCard
                                    title={article.title}
                                    desc={article.description}
                                    image={article.image}
                                />
                            );
                        })}
                </div>
                <Link
                    href={route("article")}
                    className="btn btn-primary text-curious-blue bg-white hover:bg-slate-100 mt-10 border-none shadow-lg"
                >
                    Baca Selengkapnya
                </Link>
            </section>
        </AuthenticatedLayout>
    );
}
