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
import IconMateriSKD from "@/svg/icon-materiskd.svg";
import IconMateriSKB from "@/svg/icon-materiskb.svg";
import IconMateriUM from "@/svg/icon-materium.svg";
import IconMateriUTBK from "@/svg/icon-materiutbk.svg";
import IconVideoSeries from "@/svg/icon-videoseries.svg";

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

    const icons = [
        IconVideoSeries,
        IconMateriSKD,
        IconMateriSKB,
        IconMateriUM,
        IconMateriUTBK,
    ]

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

            <section className="bg-white mt-6 px-4 md:px-14 lg:px-24 xl:px-32">
                <h1 className="font-bold text-3xl">Mulai Belajar</h1>
                <div className="grid grid-cols-2 lg:grid-cols-3 gap-2 xl:gap-6 justify-between mt-6">
                    {materialTypes.map((materialType, i) => {
                        return (
                            <Link
                                href={route("material.type", materialType.code)}
                                className="p-3 md:px-6 bg-white shadow-lg rounded-lg flex gap-2 cursor-pointer hover:bg-slate-100 transition-all duration-150 items-center"
                                key={i}
                            >
                                <img
                                    src={icons[i]}
                                    alt=""
                                    className="basis-1/5 fill-curious-blue h-14"
                                />
                                <div className="basis-4/5 flex flex-col justify-center gap-2 pl-4">
                                    <h4 className="text-base md:text-lg lg:text-xl font-semibold">
                                        {materialType.name}
                                    </h4>
                                    <p className="text-curious-blue font-semibold flex items-end gap-6 text-sm md:text-base">
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

            <section className="bg-white mt-12 px-4 md:px-14 lg:px-24 xl:px-32">
                <div className="bg-gradient-to-b from-curious-blue-500 to-curious-blue-300 p-6 md:px-10 xl:px-20 py-6 rounded-2xl flex justify-between items-center">
                    <div className="flex flex-col items-start gap-14 basis-2/3 md:basis-1/2 lg:basis-2/3">
                        <h4 className="text-white text-xl md:text-2xl lg:text-3xl xl:text-4xl font-semibold">
                            Wujudkan Potensi Terbaik dengan Materi Premium
                        </h4>
                        <Link
                            href={route("paket.index")}
                            className="btn bg-white border-none text-curious-blue-300 capitalize text-sm lg:text-lg xl:text-xl"
                        >
                            Beli Paket
                        </Link>
                    </div>
                    <div className="basis-1/3 md:basis-1/2 lg:basis-1/3">
                        <img
                            src={KnowIllus}
                            alt="knowledge-illus"
                            className="object-cover w-full"
                        />
                    </div>
                </div>
            </section>

            <section className="bg-white mt-12 px-4 md:px-14 lg:px-24 xl:px-32">
                <div>
                    <h1 className="font-bold text-3xl">
                        TryOut dan Tes Minat Bakat
                    </h1>
                    <p className="mt-2">
                        Uji Kemampuan Anda Dengan Soal Latihan
                    </p>
                </div>
                <div className="grid grid-cols-2 lg:grid-cols-3 gap-4 mt-8">
                    <div className="flex flex-col bg-white shadow-xl p-4 md:p-8 gap-2 items-center rounded-xl">
                        <img
                            src={ExamBro}
                            alt="exam-bro"
                            className="basis-1/3 xl:basis-4/5"
                        />
                        <div className="flex flex-col items-center justify-end basis-2/3 gap-2">
                            <h3 className="uppercase font-semibold text-base xl:text-xl text-center">
                                Event TryOut
                            </h3>
                            <Link
                                href={route("event-tryout.confirm")}
                                className="btn btn-primary capitalize text-white px-8 mt-2"
                                as="button"
                            >
                                Mulai
                            </Link>
                        </div>
                    </div>
                    <div className="flex flex-col bg-white shadow-xl p-4 md:p-8 gap-2 items-center rounded-xl">
                        <img
                            src={LearningAmico}
                            alt="learning-amico"
                            className="basis-1/3 xl:basis-4/5"
                        />
                        <div className="flex flex-col items-center justify-end basis-2/3 gap-2">
                            <h3 className="uppercase font-semibold text-base xl:text-xl text-center">
                                TryOut Gratis & Platinum
                            </h3>
                            <Link
                                as="button"
                                href={route("tryout")}
                                className="btn btn-primary capitalize text-white px-8 mt-2"
                            >
                                Mulai
                            </Link>
                        </div>
                    </div>
                    <div className="flex flex-col bg-white shadow-xl p-4 md:p-8 gap-2 items-center rounded-xl">
                        <img
                            src={LearningBro}
                            alt="learning-bro"
                            className="xl:basis-4/5"
                        />
                        <div className="flex flex-col items-center justify-end basis-2/3 gap-2">
                            <h3 className="uppercase font-semibold text-base xl:text-xl text-center">
                                Tes Minat Bakat
                            </h3>
                            <Link
                                as="button"
                                href={route("minatbakat")}
                                className="btn btn-primary capitalize text-white px-8 mt-2"
                            >
                                Mulai
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

            <section className="mt-12 bg-white px-4 md:px-14 lg:px-24 xl:px-32">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Kamu Nanya, Kami Jawab
                </h1>
                <div className="flex flex-col gap-2 max-w-2xl mx-auto">
                    {FAQ.map((dt, i) => (
                        <FAQCard key={i} index={i} {...dt} />
                    ))}
                </div>
            </section>

            <section className="mt-12 bg-white text-center pb-8">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Artikel
                </h1>
                <div className="overflow-x-auto w-full pb-8">
                    <div className="flex gap-4 w-[1000px] xl:w-[1000px] px-14 md:px-24 mx-auto">
                        {articles
                            .slice(Math.max(articles.length - 3, 0))
                            .map((article, i) => {
                                return (
                                    <Link
                                        href={route("article.show", article.id)}
                                        key={i}
                                    >
                                        <ArticleCard
                                            title={article.title}
                                            desc={article.description}
                                            image={article.image}
                                        />
                                    </Link>
                                );
                            })}
                    </div>
                </div>
                <Link
                    href={route("article.index")}
                    className="btn btn-primary text-curious-blue bg-white hover:bg-slate-100 border-none shadow-lg"
                >
                    Baca Selengkapnya
                </Link>
            </section>
        </AuthenticatedLayout>
    );
}
