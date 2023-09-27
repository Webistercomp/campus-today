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

export default function Homepage(props) {
    const tryOutPacket = [
        {
            type: "Gratis",
            price: 0,
            benefit: ["Akses Tryout Gratis"],
            nonBenefit: [
                "Try Out Premium SKD Sistem CAT",
                "Try Out Premium UTBK",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Latihan Soal UTBK",
                "Materi SKD, UTBK, UM Terupdate",
                "Ranking Try Out Nasional",
                "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.",
                "Video Series SKD, UTBK, dan UM",
            ],
            isPopular: false,
        },
        {
            type: "Friendly",
            price: 120000,
            benefit: [
                "Akses Tryout Gratis",
                "Try Out Premium SKD Sistem CAT",
                "Try Out Premium UTBK",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Latihan Soal UTBK",
                "Materi SKD, UTBK, UM Terupdate",
                "Ranking Try Out Nasional",
            ],
            nonBenefit: [
                "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.",
                "Video Series SKD, UTBK, dan UM",
            ],
            isPopular: true,
        },
        {
            type: "Ambisius",
            price: 200000,
            benefit: [
                "Akses Tryout Gratis",
                "Try Out Premium SKD Sistem CAT",
                "Try Out Premium UTBK",
                "Kunci dan Pembahasan Try Out Lengkap",
                "Latihan Soal SKD / Mini Try Out (TWK, TIU dan TKP)",
                "Latihan Soal UTBK",
                "Materi SKD, UTBK, UM Terupdate",
                "Ranking Try Out Nasional",
                "Try Out Exclusive Platinum SKD Sistem CAT, UTBK, UM dengan Pembahasan Video",
                "Analisis Waktu Pengerjaan Try Out (Manajemen Waktu)",
                "Sebaran Data Nilai Try Out Pengguna Lain (Pesaing)",
                "Video Materi SKD (TWK, TIU dan TKP), UTBK, dan UM.",
                "Video Series SKD, UTBK, dan UM",
            ],
            nonBenefit: [],
            isPopular: false,
        },
    ];

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
        <PublicLayout>
            <Head title={props.title} />

            <section
                className="flex h-screen items-center bg-twilight-blue"
                id="homepage"
            >
                <div className="basis-[60%] px-36">
                    <h1 className="text-3xl font-bold mb-8">
                        Solusi Belajar Cerdas Tembus Seleksi
                        <br />
                        <span className="text-red-500 uppercase">
                            Perguruan Tinggi dan Kedinasan
                        </span>
                    </h1>
                    <p className="text-slate-500 mb-4">
                        Khawatir dengan persiapan SNBP, UTBK, dan Ujian Mandiri?
                        Seberapa siap #SobatCampus seleksi sekolah kedinasan,
                        nih?
                        <br />
                        <br />
                        Yuk, kita belajar biar #TambahJago ngerjain soal-soal
                        ujian!
                    </p>
                    <Link href={route("login")}>
                        <button className="btn btn-primary px-12 capitalize">
                            Masuk
                        </button>
                    </Link>
                    <Link href={route("register")}>
                        <button className="btn btn-primary px-12 btn-outline capitalize ml-4">
                            Daftar
                        </button>
                    </Link>
                </div>
                <div className="basis-[40%] w-full h-full flex items-center justify-start">
                    <img src={ThesisPhana} alt="illus" />
                </div>
            </section>

            <section
                className="w-full text-center py-14 bg-twilight-blue"
                id="about-us"
            >
                <div className="mx-auto max-w-4xl">
                    <h1 className="text-3xl font-bold text-slate-700 mb-6">
                        Tentang <br />
                        <span>
                            <TextLogo />
                        </span>
                    </h1>
                    <p className="text-lg text-slate-500">
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
                className="mx-auto text-center py-14 px-36 bg-twilight-blue"
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
                        <span className="basis-1/2 text-left">
                            <h3 className="font-semibold mb-2">
                                Fokus Belajar Bersama Campus Today
                            </h3>
                            <p>
                                Silahkan #SobatCampus membuat akun dan pilih
                                paket belajarnya. Terdapat paket yang super
                                lengkap untuk kamu yang spesial.
                            </p>
                        </span>
                    </div>
                    <div className="w-1 h-24 bg-slate-400 relative after:absolute after:w-0 after:h-0 after:-bottom-1 after:-translate-x-1/2 after:border-t-[20px] after:border-l-[15px] after:border-r-[15px] after:border-l-transparent after:border-r-transparent after:border-t-slate-400"></div>
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right">
                            <h3 className="font-semibold mb-2">
                                Strategi Pendaftaran PTN dan PTK
                            </h3>
                            <p>
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
                    <div className="w-1 h-24 bg-slate-400 relative after:absolute after:w-0 after:h-0 after:-bottom-1 after:-translate-x-1/2 after:border-t-[20px] after:border-l-[15px] after:border-r-[15px] after:border-l-transparent after:border-r-transparent after:border-t-slate-400"></div>
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right"></span>
                        <div className="w-24 aspect-square bg-selective-yellow rounded-full text-white flex items-center justify-center">
                            <LaptopIcon className="w-10 h-10" />
                        </div>
                        <span className="basis-1/2 text-left">
                            <h3 className="font-semibold mb-2">
                                #MakinJago Ngerjain Soal
                            </h3>
                            <p>
                                Mentor akan membimbing sepenuh hati untuk
                                meningkatkan pemahaman materi dan jawaban dengan
                                trik jitu ditiap soal.
                            </p>
                        </span>
                    </div>
                    <div className="w-1 h-24 bg-slate-400 relative after:absolute after:w-0 after:h-0 after:-bottom-1 after:-translate-x-1/2 after:border-t-[20px] after:border-l-[15px] after:border-r-[15px] after:border-l-transparent after:border-r-transparent after:border-t-slate-400"></div>
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right">
                            <h3 className="font-semibold mb-2">
                                Interview untuk #SobatCampus
                            </h3>
                            <p>
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
                    <div className="w-1 h-24 bg-slate-400 relative after:absolute after:w-0 after:h-0 after:-bottom-1 after:-translate-x-1/2 after:border-t-[20px] after:border-l-[15px] after:border-r-[15px] after:border-l-transparent after:border-r-transparent after:border-t-slate-400"></div>
                    <div className="flex w-full items-center gap-6">
                        <span className="basis-1/2 text-right"></span>
                        <div className="w-24 aspect-square bg-indigo rounded-full text-white flex items-center justify-center">
                            <PhoneIcon className="w-10 h-10" />
                        </div>
                        <span className="basis-1/2 text-left">
                            <h3 className="font-semibold mb-2">
                                PDKT dengan Campus Today
                            </h3>
                            <p>
                                Follow akun sosial media Instagram dan Tiktok.
                            </p>
                        </span>
                    </div>
                </div>
            </section>

            <section
                className="mx-auto text-center py-14 px-36 bg-twilight-blue"
                id="benefit"
            >
                <h1 className="text-3xl font-bold text-slate-700 mb-12">
                    Benefit Belajar Bersama
                    <TextLogo />
                </h1>
                <div className="flex gap-6">
                    <div className="basis-2/5 flex flex-col text-right gap-4 justify-between">
                        <div className="basis-1/3">
                            <h3 className="text-xl font-bold text-slate-600">
                                Time Management
                            </h3>
                            <p>
                                Fitur manajemen waktu sangat menunjang dalam
                                pengerjaan soal dan melihat soal mana yang
                                membutuhkan waktu singkat
                            </p>
                        </div>
                        <div className="basis-1/3">
                            <h3 className="text-xl font-bold text-slate-600">
                                Peringkat Nasional
                            </h3>
                            <p>
                                Sistem peringkat secara real time dapat
                                dinikmati oleh #SobatCampus guna memberikan
                                motivasi belajar yang lebih rajin lagi.
                            </p>
                        </div>
                        <div className="basis-1/3">
                            <h3 className="text-xl font-bold text-slate-600">
                                Evaluasi Rinci
                            </h3>
                            <p>
                                #SobatCampus dapat diberikan evaluasi dari
                                pembahasan soal yang tersedia. Tujuannya untuk
                                memahami jawaban dari setiap soal.
                            </p>
                        </div>
                    </div>
                    <div className="bg-curious-blue basis-1/5 pt-8">
                        <img src={BookGirl} alt="book-girl" />
                    </div>
                    <div className="basis-2/5 flex flex-col gap-4 text-left justify-between">
                        <div className="basis-1/3">
                            <h3 className="text-xl font-bold text-slate-600">
                                Soal, Pembahasan, kisi-kisi dan prediksi selalu
                                update.
                            </h3>
                            <p>
                                Campus Today memiliki jumlah ribuan soal dan
                                menyamakan kisi-kisi tahun selanjutnya.
                            </p>
                        </div>
                        <div className="basis-1/3">
                            <h3 className="text-xl font-bold text-slate-600">
                                Akses Belajar Anywhere
                            </h3>
                            <p>
                                #SobatCampus sangat dimudahkan untuk akses
                                materi, soal, try out, dan video dimanapun dan
                                kapanpun.
                            </p>
                        </div>
                        <div className="basis-1/3">
                            <h3 className="text-xl font-bold text-slate-600">
                                Mentor Lulusan Universitas Ternama
                            </h3>
                            <p>
                                Pengajar sangat berpengalaman dibidangnya dan
                                profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section className="px-36 py-14 bg-twilight-blue">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    #ApaKata
                    <span>
                        <span className="text-pelorous">M</span>
                        <span className="text-apple">e</span>
                        <span className="text-selective-yellow">r</span>
                        <span className="text-fuzzy-brown">e</span>
                        <span className="text-apple">k</span>
                        <span className="text-indigo">a</span>
                    </span>
                </h1>
                <div>
                    <iframe
                        width="560"
                        height="315"
                        src="https://www.youtube.com/embed/0nfOlN9DoNw?si=iFu_9peG8XmvI1e1"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                        className="mx-auto"
                    ></iframe>
                </div>
            </section>

            <section className="px-36 py-14 bg-twilight-blue">
                <div className="grid grid-cols-3 grid-rows-2 gap-2">
                    <div className="w-full aspect-[4/3] text-6xl font-bold flex items-center">
                        Fasilitas Belajar
                    </div>
                    <div className="w-full aspect-[4/3] bg-gradient-to-b from-pelorous-500 to-pelorous-300 rounded-3xl text-white p-8 flex flex-col justify-center text-xl gap-2">
                        <h3 className="font-semibold">
                            Try Out & Latihan Soal
                        </h3>
                        <p>
                            #SobatCampus percaya deh, semakin sering mengerjakan
                            soal, kamu bakal #MakinJago
                        </p>
                    </div>
                    <div className="w-full aspect-[4/3] bg-gradient-to-b from-apple-500 to-apple-300 rounded-3xl text-white p-8 flex flex-col justify-center text-xl gap-2">
                        <h3 className="font-semibold">Materi Teks</h3>
                        <p>
                            Materi yang lengkap menjadikan kamu agar lebih siap
                            menerima cara-cara baru dalam mengerjakan tipe soal.
                        </p>
                    </div>
                    <div className="w-full aspect-[4/3] bg-gradient-to-b from-selective-yellow-500 to-selective-yellow-300 rounded-3xl text-white p-8 flex flex-col justify-center text-xl gap-2">
                        <h3 className="font-semibold">Pojok Video</h3>
                        <p>
                            Terdapat banyak video pengerjaan soal dengan cara
                            jitu ala Campus Today.
                        </p>
                    </div>
                    <div className="w-full aspect-[4/3] bg-gradient-to-b from-fuzzy-brown-500 to-fuzzy-brown-300 rounded-3xl text-white p-8 flex flex-col justify-center text-xl gap-2">
                        <h3 className="font-semibold">
                            Event Try Out Nasional
                        </h3>
                        <p>
                            Bertujuan mengukur kemampuan #SobatCampus untuk
                            bersaing dengan skala yang lebih luas.
                        </p>
                    </div>
                    <div className="w-full aspect-[4/3] bg-gradient-to-b from-indigo-500 to-indigo-300 rounded-3xl text-white p-8 flex flex-col justify-center text-xl gap-2">
                        <h3 className="font-semibold">Kelas Bimbel</h3>
                        <p>
                            Bimbel online yang menyediakan berbagai macam fitur
                            dan konseling terkait pemilihan Perguruan Tinggi
                            Negeri maupun Kedinasan.
                        </p>
                    </div>
                </div>
            </section>

            <section className="px-36 py-14 bg-twilight-blue">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    #ApaKata
                    <span>
                        <span className="text-pelorous">M</span>
                        <span className="text-apple">e</span>
                        <span className="text-selective-yellow">r</span>
                        <span className="text-fuzzy-brown">e</span>
                        <span className="text-apple">k</span>
                        <span className="text-indigo">a</span>
                    </span>
                </h1>
                <div className="">
                    <TestiCard />
                </div>
            </section>

            <section className="px-36 py-14 bg-twilight-blue" id="paket">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Paket Try Out
                </h1>
                <div className="flex gap-4 max-w-5xl justify-center mx-auto">
                    {tryOutPacket.map((dt) => (
                        <PacketCard {...dt} />
                    ))}
                </div>
            </section>

            <section className="px-36 py-14 bg-twilight-blue">
                <div className="max-w-3xl mx-auto">
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
                <div className="flex gap-4 max-w-5xl justify-center mx-auto">
                    {tryOutPacket.map((dt) => (
                        <PacketCard {...dt} />
                    ))}
                </div>
            </section>

            <section className="px-36 py-14 bg-twilight-blue" id="testimoni">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Testimoni Buku Kedinasan
                </h1>
                <div>
                    <img
                        src={MockUpHp}
                        alt="mockup-hp"
                        className="w-72 aspect-auto mx-auto"
                    />
                </div>
            </section>

            <section className="px-36 py-14 bg-twilight-blue">
                <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                    Kamu Nanya, Kami Jawab
                </h1>
                <div className="flex flex-col gap-2 max-w-4xl mx-auto">
                    {FAQ.map((dt, i) => (
                        <FAQCard key={i} index={i} {...dt} />
                    ))}
                </div>
            </section>

            <section className="px-36 py-14 bg-twilight-blue">
                <div className="bg-[#00A8E8] text-center text-white px-6 py-20 rounded-2xl relative overflow-clip">
                    <div className="absolute bg-[#6366F1] bg-opacity-40 w-screen h-screen top-[85%] -left-44 rotate-[15deg]"></div>
                    <div className="absolute bg-[#4338CA] bg-opacity-40 w-screen h-screen top-[85%] -right-44 -rotate-[15deg]"></div>
                    <div className="relative">
                        <h1 className="text-3xl font-bold">
                            Sudah berapa persen persiapan UTBK/UM/SKD Kedinasan?
                        </h1>
                        <p className="mt-6 opacity-80">
                            Yuk bergabung dengan Campus Today untuk mengejar
                            kampus impian
                        </p>
                        <div className="flex gap-4 mt-8 justify-center">
                            <button className="btn bg-white text-curious-blue border-none">
                                Mulai Belajar
                            </button>
                            <button className="btn bg-white text-curious-blue border-none">
                                Tanya Admin
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </PublicLayout>
    );
}
