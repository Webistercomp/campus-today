import PublicLayout from "@/Layouts/PublicLayout";
import { Head, Link, router } from "@inertiajs/react";
import ThesisPhana from "@/images/thesis-pana.png";
import TextLogo from "@/Components/TextLogo";
import PencilIcon from "@/icons/PencilIcon";
import PaperIcon from "@/icons/PaperIcon";
import LaptopIcon from "@/icons/LaptopIcon";
import SpeakIcon from "@/icons/SpeakIcon";
import PhoneIcon from "@/icons/PhoneIcon";
import BookGirl from "@/images/book-girl.png";
import TestiCard from "@/Components/TestiCard";
import PacketCard from "@/Components/PacketCard";
import MockUpHp from "@/images/mockup-hp.png";
import FAQCard from "@/Components/FAQCard";
import diary from "@/images/diary.png";
import web from "@/images/web.png";
import holding from "@/images/holding.png";
import notes from "@/images/notes.png";
import prof from "@/images/prof.png";
import CampusToday from "@/images/campus-today.png";
import Testi1 from "@/images/testi-buku/testi-1.jpg";
import Testi2 from "@/images/testi-buku/testi-2.jpg";
import Testi3 from "@/images/testi-buku/testi-3.jpg";
import Testi4 from "@/images/testi-buku/testi-4.jpg";
import Testi5 from "@/images/testi-buku/testi-5.jpg";
import Testi6 from "@/images/testi-buku/testi-6.jpg";
import Testi7 from "@/images/testi-buku/testi-7.jpg";
import Testi8 from "@/images/testi-buku/testi-8.jpg";
import Testi9 from "@/images/testi-buku/testi-9.jpg";
import Testi10 from "@/images/testi-buku/testi-10.jpg";
import { useEffect, useState } from "react";
import ArrowRightIcon from "@/icons/ArrowRightIcon";
import ArrowLeftIcon from "@/icons/ArrowLeftIcon";

export default function Homepage({ title, packets, testimonis }) {
    const FAQ = [
        {
            question: "Bagaimana cara membuat akun di Campus Today?",
            answer: "Daftarkan dirimu secara langsung melalui web Campus Today dengan cara klik tombol daftar pada Homepage Campus Today, isikan data dirimu verifikasikan dirimu melalui email yang telah dikirim, kamu telah berhasil membuat akun di Campus Today",
        },
        {
            question:
                "Bagaimana cara upgrade paket Premium / Platinum / Bimbel?",
            answer: "Silakan daftar/login terlebih dahulu Pilih menu Paket dan pilih paket yang paling sesuai dengan kebutuhan belajar kamu",
        },
        {
            question: "Berapa lama masa berlaku paket yang saya beli?",
            answer: "Paketmu akan aktif selama 1 tahun",
        },
        {
            question:
                "Apakah pembayaran bisa melalui Bank, Indomaret dan E-Wallet?",
            answer: "Pembayaran dapat dilakukan dengan melakukan transfer melalui Bank BRI atau dapat melakukan transaksi ke Gopay",
        },
        {
            question: "Bagaimana mengatasi lupa password?",
            answer: "Pada menu login, klik 'Forgot Password' Masukkan email akunmu Password yang baru akan dikirimkan ke Emailmu",
        },
        {
            question: "Apakah Campus Today dapat diakses di Smartphone?",
            answer: "Tentu saja, Campus Today dapat diakses menggunakan Smartphone, Tablet, Laptop, atau Komputer",
        },
    ];

    const testiData = testimonis.map((testimoni) => ({
        name: testimoni.name,
        as: testimoni.institusi_sebelumnya,
        agency: testimoni.institusi_sekarang,
        testi: testimoni.testimoni,
        image: testimoni.photo,
    }));

    const testiBuku = [
        {
            img: Testi1,
        },
        {
            img: Testi2,
        },
        {
            img: Testi3,
        },
        {
            img: Testi4,
        },
        {
            img: Testi5,
        },
        {
            img: Testi6,
        },
        {
            img: Testi7,
        },
        {
            img: Testi8,
        },
        {
            img: Testi9,
        },
        {
            img: Testi10,
        },
    ];

    const mandiriPacket = packets.filter((dt) => dt.type === "mandiri");
    const bimbelPacket = packets.filter((dt) => dt.type === "bimbel");

    const [activeTesti, setActiveTesti] = useState(0);
    const [testiScroll, setTestiScroll] = useState(0);
    const [activeBuku, setActiveBuku] = useState(0);
    const [bukuScroll, setBukuScroll] = useState(0);
    const [pauseInterval, setPauseInterval] = useState(false);

    useEffect(() => {
        const testiCardWidth =
            document.getElementById("testi-card").clientWidth;
        setTestiScroll(() =>
            testiData.map(
                (_, i) => testiCardWidth * (i + 1) - testiCardWidth + 32
            )
        );

        const bukuCardWidth = document.getElementById("buku-card").clientWidth;
        setBukuScroll(() =>
            testiBuku.map(
                (_, i) => bukuCardWidth * (i + 1) - bukuCardWidth + 16
            )
        );
    }, []);

    useEffect(() => {
        const testiInterval = setInterval(() => {
            if (!pauseInterval) {
                setActiveTesti((prev) => {
                    if (prev + 1 < testiData.length) return prev + 1;
                    return 0;
                });
            }
        }, 5000);

        return () => clearInterval(testiInterval);
    }, [pauseInterval]);

    useEffect(() => {
        const testiCardWrapper = document.getElementById("testi-wrapper");
        testiCardWrapper.scrollTo({ left: testiScroll[activeTesti], top: 0 });
    }, [activeTesti]);

    const nextTesti = () => {
        setPauseInterval(true);
        setActiveTesti(
            activeTesti + 1 >= testiData.length ? 0 : activeTesti + 1
        );
        setTimeout(() => {
            setPauseInterval(false);
        }, 5000);
    };

    const prevTesti = () => {
        setPauseInterval(true);
        setActiveTesti(
            activeTesti - 1 <= -1 ? testiData.length - 1 : activeTesti - 1
        );
        setTimeout(() => {
            setPauseInterval(false);
        }, 5000);
    };

    useEffect(() => {
        const bukuInterval = setInterval(() => {
            if (!pauseInterval) {
                setActiveBuku((prev) => {
                    if (prev + 1 < testiBuku.length) return prev + 1;
                    return 0;
                });
            }
        }, 5000);

        return () => clearInterval(bukuInterval);
    }, [pauseInterval]);

    useEffect(() => {
        const bukuWrapper = document.getElementById("buku-wrapper");
        bukuWrapper.scrollTo({ left: bukuScroll[activeBuku], top: 0 });
    }, [activeBuku]);

    const nextBuku = () => {
        setPauseInterval(true);
        setActiveBuku(activeBuku + 1 >= testiBuku.length ? 0 : activeBuku + 1);
        setTimeout(() => {
            setPauseInterval(false);
        }, 5000);
    };

    const prevBuku = () => {
        setPauseInterval(true);
        setActiveBuku(
            activeBuku - 1 <= -1 ? testiBuku.length - 1 : activeBuku - 1
        );
        setTimeout(() => {
            setPauseInterval(false);
        }, 5000);
    };

    useEffect(() => {
        const scrollElement = document.getElementById("scroll-element");
        const scrollContainerTryOut = document.getElementById(
            "scroll-container-tryout"
        );
        const scrollContainerBimbel = document.getElementById(
            "scroll-container-bimbel"
        );
        scrollContainerTryOut.scrollTo(scrollElement.clientWidth / 3, 0);
        scrollContainerBimbel.scrollTo(scrollElement.clientWidth / 3, 0);
    }, []);

    return (
        <PublicLayout>
            <Head title={title} />

            <section
                className="flex w-full h-screen items-center gap-8 px-4 md:px-14 lg:px-24 xl:px-32"
                id="homepage"
            >
                <div className="basis-full md:basis-[60%] lg:mt-14">
                    <h1 className="text-3xl lg:text-3xl xl:text-4xl font-bold mb-8 text-center md:text-left">
                        Solusi Belajar Cerdas Tembus Seleksi
                        <br />
                        <span className="text-red-500 uppercase">
                            Perguruan Tinggi dan Kedinasan
                        </span>
                    </h1>
                    <p className="text-slate-500 text-xs lg:text-base xl:text-lg mb-4 text-center md:text-left">
                        Khawatir dengan persiapan SNBP, UTBK, dan Ujian Mandiri?
                        Seberapa siap #SobatCampus seleksi sekolah kedinasan,
                        nih?
                        <br />
                        <br />
                        Yuk, kita belajar biar #TambahJago ngerjain soal-soal
                        ujian!
                    </p>
                    <div className="flex gap-2 xl:gap-4 justify-center md:justify-start mt-14">
                        <Link href={route("login")}>
                            <button className="btn btn-primary px-12 capitalize">
                                Masuk
                            </button>
                        </Link>
                        <Link href={route("register")}>
                            <button className="btn btn-primary px-12 btn-outline capitalize">
                                Daftar
                            </button>
                        </Link>
                    </div>
                </div>
                <div className="hidden md:flex basis-0 md:basis-[40%] w-full h-full items-center justify-start">
                    <img src={ThesisPhana} alt="illus" />
                </div>
            </section>

            <section
                className="w-full text-center px-4 md:px-14 lg:px-32 py-14 bg-white"
                id="about-us"
            >
                <div className="mx-auto max-w-4xl">
                    <h1 className="text-3xl font-bold text-slate-700 mb-6">
                        Tentang Kami
                    </h1>
                    <p className="text-base lg:text-lg xl:text-xl text-slate-500">
                        Campus Today telah mengantarkan ratusan siswa dan siswi
                        ke PTN dan PTK sejak tahun 2015. Campus Today senantiasa
                        memberikan informasi terkini seputar PTN dan PTK
                        sehingga #SobatCampus lebih siap menuju kampus impian.
                        Campus Today memberikan opsi sekolah kedinasan di bawah
                        naungan Pemerintah dengan skema pembiayaan ikatan dinas.
                    </p>
                </div>
            </section>

            <section
                className="mx-auto text-center py-14 px-4 md:px-14 lg:px-24 xl:px-32 bg-white"
                id="college-path"
            >
                <h1 className="text-3xl max-w-lg mx-auto font-bold text-slate-700 mb-12">
                    Perjalanan Menjadi Mahasiswa/Taruna
                </h1>
                <div className="flex flex-col items-center gap-4 justify-center">
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right text-lg"></span>
                        <div className="w-24 aspect-square bg-pelorous rounded-full text-white flex items-center justify-center">
                            <PencilIcon className="w-10 h-10" />
                        </div>
                        <span className="basis-1/2 text-left relative">
                            <h3 className="font-semibold mb-2 text-sm lg:text-base xl:text-2xl">
                                Fokus Belajar Bersama Campus Today
                            </h3>
                            <p className="text-xs lg:text-base absolute lg:static">
                                Silahkan #SobatCampus membuat akun dan pilih
                                paket belajarnya. Terdapat paket yang super
                                lengkap untuk kamu yang spesial.
                            </p>
                        </span>
                    </div>
                    <div className="w-1 h-16 lg:h-24 bg-slate-400 relative after:absolute after:w-0 after:h-0 after:-bottom-1 after:-translate-x-1/2 after:border-t-[20px] after:border-l-[15px] after:border-r-[15px] after:border-l-transparent after:border-r-transparent after:border-t-slate-400"></div>
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right relative">
                            <h3 className="font-semibold mb-2 text-sm lg:text-base xl:text-2xl">
                                Strategi Pendaftaran PTN dan PTK
                            </h3>
                            <p className="text-xs lg:text-base absolute lg:static">
                                Silahkan #SobatCampus membuat akun dan pilih
                                paket belajarnya. Terdapat paket yang super
                                lengkap untuk kamu yang spesial.
                            </p>
                        </span>
                        <div className="w-24 aspect-square bg-apple rounded-full text-white flex items-center justify-center">
                            <PaperIcon className="w-10 h-10" />
                        </div>
                        <span className="basis-1/2 text-left"></span>
                    </div>
                    <div className="w-1 h-16 lg:h-24 bg-slate-400 relative after:absolute after:w-0 after:h-0 after:-bottom-1 after:-translate-x-1/2 after:border-t-[20px] after:border-l-[15px] after:border-r-[15px] after:border-l-transparent after:border-r-transparent after:border-t-slate-400"></div>
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right"></span>
                        <div className="w-24 aspect-square bg-selective-yellow rounded-full text-white flex items-center justify-center">
                            <LaptopIcon className="w-10 h-10" />
                        </div>
                        <span className="basis-1/2 text-left relative">
                            <h3 className="font-semibold mb-2 text-sm lg:text-base xl:text-2xl">
                                #MakinJago Ngerjain Soal
                            </h3>
                            <p className="text-xs lg:text-base absolute lg:static">
                                Mentor akan membimbing sepenuh hati untuk
                                meningkatkan pemahaman materi dan jawaban dengan
                                trik jitu ditiap soal.
                            </p>
                        </span>
                    </div>
                    <div className="w-1 h-16 lg:h-24 bg-slate-400 relative after:absolute after:w-0 after:h-0 after:-bottom-1 after:-translate-x-1/2 after:border-t-[20px] after:border-l-[15px] after:border-r-[15px] after:border-l-transparent after:border-r-transparent after:border-t-slate-400"></div>
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right relative">
                            <h3 className="font-semibold mb-2 text-sm lg:text-base xl:text-2xl">
                                Interview untuk #SobatCampus
                            </h3>
                            <p className="text-xs lg:text-base absolute lg:static">
                                Disini, akan dilakukan pelatihan wawancara oleh
                                Mentor untuk mengetahui kesiapan dalam seleksi
                                untuk pejuan PTK.
                            </p>
                        </span>
                        <div className="w-24 aspect-square bg-fuzzy-brown rounded-full text-white flex items-center justify-center">
                            <SpeakIcon className="w-10 h-10" />
                        </div>
                        <span className="basis-1/2 text-left"></span>
                    </div>
                    <div className="w-1 h-16 lg:h-24 bg-slate-400 relative after:absolute after:w-0 after:h-0 after:-bottom-1 after:-translate-x-1/2 after:border-t-[20px] after:border-l-[15px] after:border-r-[15px] after:border-l-transparent after:border-r-transparent after:border-t-slate-400"></div>
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right"></span>
                        <div className="w-24 aspect-square bg-indigo rounded-full text-white flex items-center justify-center">
                            <PhoneIcon className="w-10 h-10" />
                        </div>
                        <span className="basis-1/2 text-left relative">
                            <h3 className="font-semibold mb-2 text-sm lg:text-base xl:text-2xl">
                                PDKT dengan Campus Today
                            </h3>
                            <p className="text-xs lg:text-base absolute lg:static">
                                Follow akun sosial media Instagram dan Tiktok.
                            </p>
                        </span>
                    </div>
                </div>
            </section>

            <section
                className="mx-auto text-center py-14 px-4 md:px-14 lg:px-24 xl:px-32 bg-white"
                id="benefit"
            >
                <h1 className="text-3xl font-bold text-slate-700 mb-12">
                    Benefit Belajar Bersama{" "}
                    <span>
                        <img src={CampusToday} alt="" className="h-8 mx-auto" />
                    </span>
                </h1>
                <div className="flex gap-2 md:gap-2 lg:gap-6">
                    <div className="basis-1/2 md:basis-2/5 flex flex-col text-right gap-4 justify-between">
                        <div className="basis-1/3">
                            <h3 className="text-xl xl:text-2xl font-bold text-slate-600">
                                Time Management
                            </h3>
                            <p className="text-sm lg:text-base xl:text-lg mt-2">
                                Fitur manajemen waktu sangat menunjang dalam
                                pengerjaan soal dan melihat soal mana yang
                                membutuhkan waktu singkat
                            </p>
                        </div>
                        <div className="basis-1/3">
                            <h3 className="text-xl xl:text-2xl font-bold text-slate-600">
                                Peringkat Nasional
                            </h3>
                            <p className="text-sm lg:text-base xl:text-lg mt-2">
                                Sistem peringkat secara real time dapat
                                dinikmati oleh #SobatCampus guna memberikan
                                motivasi belajar yang lebih rajin lagi.
                            </p>
                        </div>
                        <div className="basis-1/3">
                            <h3 className="text-xl xl:text-2xl font-bold text-slate-600">
                                Evaluasi Rinci
                            </h3>
                            <p className="text-sm lg:text-base xl:text-lg mt-2">
                                #SobatCampus dapat diberikan evaluasi dari
                                pembahasan soal yang tersedia. Tujuannya untuk
                                memahami jawaban dari setiap soal.
                            </p>
                        </div>
                    </div>
                    <div className="bg-curious-blue basis-0 md:basis-1/5 lg:basis-1/5 pt-8 invisible md:visible relative overflow-clip">
                        <img
                            src={BookGirl}
                            alt="book-girl"
                            className="absolute h-full object-cover"
                        />
                    </div>
                    <div className="basis-1/2 md:basis-2/5 flex flex-col gap-4 text-left justify-between">
                        <div className="basis-1/3">
                            <h3 className="text-xl xl:text-2xl font-bold text-slate-600">
                                Soal, Pembahasan, kisi-kisi dan prediksi selalu
                                update.
                            </h3>
                            <p className="text-sm lg:text-base xl:text-lg mt-2">
                                Campus Today memiliki jumlah ribuan soal dan
                                menyamakan kisi-kisi tahun selanjutnya.
                            </p>
                        </div>
                        <div className="basis-1/3">
                            <h3 className="text-xl xl:text-2xl font-bold text-slate-600">
                                Akses Belajar Anywhere
                            </h3>
                            <p className="text-sm lg:text-base xl:text-lg mt-2">
                                #SobatCampus sangat dimudahkan untuk akses
                                materi, soal, try out, dan video dimanapun dan
                                kapanpun.
                            </p>
                        </div>
                        <div className="basis-1/3">
                            <h3 className="text-xl xl:text-2xl font-bold text-slate-600">
                                Mentor Lulusan Universitas Ternama
                            </h3>
                            <p className="text-sm lg:text-base xl:text-lg mt-2">
                                Pengajar sangat berpengalaman dibidangnya dan
                                profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section className="px-4 md:px-14 lg:px-24 xl:px-32 py-14 bg-white">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    #ApaKata<span className="text-[#DA5957]">Mereka</span>
                </h1>
                <div>
                    <iframe
                        src="https://www.youtube.com/embed/0nfOlN9DoNw?si=iFu_9peG8XmvI1e1"
                        title="YouTube video player"
                        frameBorder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowFullScreen
                        className="mx-auto aspect-video w-full md:max-w-lg xl:max-w-3xl"
                    ></iframe>
                </div>
            </section>

            <section className="px-4 md:px-14 lg:px-24 xl:px-32 py-14 bg-white">
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 items-stretch">
                    <div className="w-full lg:aspect-[4/4] xl:aspect-[4/3] text-6xl font-bold flex items-center">
                        Fasilitas Belajar
                    </div>
                    <div className="w-full h-fit md:h-auto lg:h-fit lg:aspect-[4/4] xl:aspect-[4/3] bg-gradient-to-b from-[#5A73BD] to-[#D971CE] rounded-xl lg:rounded-3xl text-white p-6 lg:p-8 flex flex-col justify-center text-xl gap-2 relative overflow-hidden group">
                        <div className="w-2/3 h-full absolute left-0 bg-gradient-to-r from-black to-transparent opacity-30"></div>
                        <img
                            src={diary}
                            alt=""
                            className="w-48 lg:w-48 xl:w-64 absolute right-0 lg:-right-10 group-hover:scale-110 scale-100 transition-all duration-300"
                        />
                        <h3 className="font-semibold xl:text-2xl relative">
                            Try Out & Latihan Soal
                        </h3>
                        <p className="relative w-1/2 md:w-2/3 lg:w-2/3 xl:w-3/4 text-sm xl:text-lg">
                            #SobatCampus percaya deh, semakin sering mengerjakan
                            soal, kamu bakal #MakinJago
                        </p>
                    </div>
                    <div className="w-full h-fit md:h-auto lg:aspect-[4/4] xl:aspect-[4/3] bg-gradient-to-b from-[#0D4A9B] to-[#1A8BBF] rounded-xl lg:rounded-3xl text-white p-6 lg:p-8 flex flex-col justify-center text-xl gap-2 relative overflow-hidden group">
                        <div className="w-2/3 h-full absolute left-0 bg-gradient-to-r from-black to-transparent opacity-30"></div>
                        <img
                            src={web}
                            alt=""
                            className="w-48 lg:w-48 xl:w-64 absolute right-0 lg:-right-10 group-hover:scale-110 scale-100 transition-all duration-300"
                        />
                        <h3 className="font-semibold xl:text-2xl relative">
                            Materi Teks
                        </h3>
                        <p className="relative w-1/2 md:w-2/3 lg:w-2/3 xl:w-3/4 text-sm xl:text-lg">
                            Materi yang lengkap menjadikan kamu agar lebih siap
                            menerima cara-cara baru dalam mengerjakan tipe soal.
                        </p>
                    </div>
                    <div className="w-full h-fit md:h-auto lg:aspect-[4/4] xl:aspect-[4/3] bg-gradient-to-b from-[#6C45E1] to-[#B998F8] rounded-xl lg:rounded-3xl text-white p-6 lg:p-8 flex flex-col justify-center text-xl gap-2 relative overflow-hidden group">
                        <div className="w-2/3 h-full absolute left-0 bg-gradient-to-r from-black to-transparent opacity-30"></div>
                        <img
                            src={holding}
                            alt=""
                            className="w-48 lg:w-48 xl:w-64 absolute right-0 lg:-right-10 group-hover:scale-110 scale-100 transition-all duration-300"
                        />
                        <h3 className="font-semibold xl:text-2xl relative">
                            Pojok Video
                        </h3>
                        <p className="relative w-1/2 md:w-2/3 lg:w-2/3 xl:w-3/4 text-sm xl:text-lg">
                            Terdapat banyak video pengerjaan soal dengan cara
                            jitu ala Campus Today.
                        </p>
                    </div>
                    <div className="w-full h-fit md:h-auto lg:aspect-[4/4] xl:aspect-[4/3] bg-gradient-to-b from-[#076FA1] to-[#00B4DE] rounded-xl lg:rounded-3xl text-white p-6 lg:p-8 flex flex-col justify-center text-xl gap-2 relative overflow-hidden group">
                        <div className="w-2/3 h-full absolute left-0 bg-gradient-to-r from-black to-transparent opacity-30"></div>
                        <img
                            src={notes}
                            alt=""
                            className="w-48 lg:w-48 xl:w-64 absolute right-0 lg:-right-10 group-hover:scale-110 scale-100 transition-all duration-300"
                        />
                        <h3 className="font-semibold xl:text-2xl relative">
                            Event Try Out Nasional
                        </h3>
                        <p className="relative w-1/2 md:w-2/3 lg:w-2/3 xl:w-3/4 text-sm xl:text-lg">
                            Bertujuan mengukur kemampuan #SobatCampus untuk
                            bersaing dengan skala yang lebih luas.
                        </p>
                    </div>
                    <div className="w-full h-fit md:h-auto lg:aspect-[4/4] xl:aspect-[4/3] bg-gradient-to-b from-[#5F3733] to-[#895E59] rounded-xl lg:rounded-3xl text-white p-6 lg:p-8 flex flex-col justify-center text-xl gap-2 relative overflow-hidden group">
                        <div className="w-2/3 h-full absolute left-0 bg-gradient-to-r from-black to-transparent opacity-30"></div>
                        <img
                            src={prof}
                            alt=""
                            className="w-48 lg:w-48 xl:w-64 absolute right-0 lg:-right-10 group-hover:scale-110 scale-100 transition-all duration-300"
                        />
                        <h3 className="font-semibold xl:text-2xl relative">
                            Kelas Bimbel
                        </h3>
                        <p className="relative w-1/2 md:w-2/3 lg:w-2/3 xl:w-3/4 text-sm xl:text-lg">
                            Bimbel online yang menyediakan berbagai macam fitur
                            dan konseling terkait pemilihan Perguruan Tinggi
                            Negeri maupun Kedinasan.
                        </p>
                    </div>
                </div>
            </section>

            <section
                className="px-4 md:px-14 lg:px-24 xl:px-32 py-14 bg-white relative"
                id="testimoni"
            >
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    #ApaKata<span className="text-[#DA5957]">Mereka</span>
                </h1>
                <div
                    className="overflow-x-scroll snap-x snap-mandatory py-8 scrollbar-hide relative"
                    id="testi-wrapper"
                    style={{ scrollBehavior: "smooth" }}
                >
                    <div className="flex w-[3000px] md:w-[5000px] xl:w-[20000px] px-[100px] md:px-[300px] xl:px-[500px] gap-8 justify-start relative">
                        {testiData.map((testi, i) => (
                            <TestiCard
                                key={i}
                                isActive={activeTesti === i}
                                {...testi}
                            />
                        ))}
                    </div>
                </div>
                <div className="absolute w-full left-0 top-[calc(50%_+_36px)] -translate-y-1/2 flex justify-between px-8 md:px-3 lg:px-8 xl:px-8">
                    <button
                        onClick={prevTesti}
                        className="p-4 bg-white shadow-md rounded-full hover:bg-slate-300 transition-colors duration-150"
                    >
                        <ArrowLeftIcon className="w-6 h-6 stroke-slate-700" />
                    </button>
                    <button
                        onClick={nextTesti}
                        className="p-4 bg-white shadow-md rounded-full hover:bg-slate-300 transition-colors duration-150"
                    >
                        <ArrowRightIcon className="w-6 h-6 stroke-slate-700" />
                    </button>
                </div>
            </section>

            <section className="lg:px-0 py-14 bg-white" id="paket">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Paket Try Out
                </h1>
                <div
                    className="overflow-x-scroll w-full snap-x snap-mandatory scrollbar-hide"
                    id="scroll-container-tryout"
                >
                    <div
                        className="flex px-24 lg:px-14 gap-4 w-[1200px] md:w-[1500px] lg:max-w-5xl xl:max-w-7xl justify-center items-stretch xl:mx-auto mx-auto"
                        id="scroll-element"
                    >
                        {mandiriPacket.map((dt) => (
                            <PacketCard key={dt.id} {...dt} />
                        ))}
                    </div>
                </div>
            </section>

            <section className="lg:px-0 py-14 bg-white">
                <div className="max-w-3xl mx-auto px-4">
                    <h1 className="text-3xl font-bold text-slate-700 mb-4 text-center">
                        Kelas Bimbel online
                    </h1>
                    <p className="text-center mb-8">
                        Program bimbel online hadir untuk meningkatkan kemampuan
                        analitis dan berpikir cepat dalam menyelesaikan tipe
                        soal yang beragam. Selain itu, #SobatCampus akan
                        dibimbing oleh Mentor terbaik dari Campus Today.
                    </p>
                </div>
                <div
                    className="overflow-x-scroll w-full snap-x snap-mandatory scrollbar-hide"
                    id="scroll-container-bimbel"
                >
                    <div className="flex px-24 lg:px-14 gap-4 w-[1200px] md:w-[1500px] lg:max-w-5xl xl:max-w-7xl justify-center items-stretch mx-auto">
                        {bimbelPacket.map((dt) => (
                            <PacketCard key={dt.id} {...dt} />
                        ))}
                    </div>
                </div>
            </section>

            <section
                className="px-4 lg:px-24 xl:px-32 py-14 bg-white relative"
                id="testimoni"
            >
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Testimoni Buku Kedinasan
                </h1>
                <div className="w-full aspect-auto mx-auto relative px-4 py-3">
                    <div
                        className="w-72 overflow-x-scroll snap-x snap-mandatory scrollbar-hide mx-auto"
                        id="buku-wrapper"
                        style={{ scrollBehavior: "smooth" }}
                    >
                        <div
                            className="flex px-4"
                            style={{ width: (288 + 16) * 10 }}
                        >
                            {testiBuku.map((ts, i) => (
                                <img
                                    key={i}
                                    src={ts.img}
                                    alt=""
                                    id="buku-card"
                                    className={`w-72 aspect-auto relative snap-center px-4`}
                                />
                            ))}
                        </div>
                    </div>
                    <img
                        src={MockUpHp}
                        alt="mockup-hp"
                        className="w-72 h-full aspect-auto mx-auto absolute top-0 left-1/2 -translate-x-1/2"
                    />
                </div>
                <div className="absolute max-w-lg w-full mx-auto left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 flex justify-between">
                    <button
                        onClick={prevBuku}
                        className="p-4 bg-white shadow-md rounded-full hover:bg-slate-300 transition-colors duration-150"
                    >
                        <ArrowLeftIcon className="w-6 h-6 stroke-slate-700" />
                    </button>
                    <button
                        onClick={nextBuku}
                        className="p-4 bg-white shadow-md rounded-full hover:bg-slate-300 transition-colors duration-150"
                    >
                        <ArrowRightIcon className="w-6 h-6 stroke-slate-700" />
                    </button>
                </div>
            </section>

            <section className="px-4 lg:px-24 xl:px-32 py-14 bg-white" id="faq">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Kamu Nanya, Kami Jawab
                </h1>
                <div className="flex flex-col gap-2 max-w-4xl mx-auto">
                    {FAQ.map((dt, i) => (
                        <FAQCard key={i} index={i} {...dt} />
                    ))}
                </div>
            </section>

            <section className="px-4 lg:px-24 xl:px-32 py-14 bg-white">
                <div className="bg-[#00A8E8] text-center text-white px-6 py-20 rounded-2xl relative overflow-clip">
                    <div className="absolute bg-[#6366F1] bg-opacity-40 w-screen h-screen top-1/2 lg:top-[85%] -left-24 lg:-left-44 rotate-[15deg]"></div>
                    <div className="absolute bg-[#4338CA] bg-opacity-40 w-screen h-screen top-1/2 lg:top-[85%] -right-24 lg:-right-44 -rotate-[15deg]"></div>
                    <div className="relative">
                        <h1 className="text-3xl font-bold">
                            Sudah berapa persen persiapan UTBK/UM/SKD Kedinasan?
                        </h1>
                        <p className="mt-6 opacity-80">
                            Yuk bergabung dengan Campus Today untuk mengejar
                            kampus impian
                        </p>
                        <div className="flex gap-4 mt-8 justify-center">
                            <Link
                                href={route("dashboard")}
                                className="btn bg-white text-curious-blue border-none"
                            >
                                Mulai Belajar
                            </Link>
                            <a
                                href="https://wa.me/+6285786742735"
                                target="_blank"
                                className="btn bg-white text-curious-blue border-none"
                            >
                                Tanya Admin
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </PublicLayout>
    );
}
