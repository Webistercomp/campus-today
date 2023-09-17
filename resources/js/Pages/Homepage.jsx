import { Head, Link, router } from "@inertiajs/react";

export default function Homepage(props) {
    return (
        <>
            <Head title={props.title} />
            <div>
                <section className="flex h-screen items-center">
                    <div className="basis-[45%] px-36">
                        <h1 className="text-3xl text-slate-600 mb-8">
                            Ayo Mulai Karir PNS mu bersama kami
                        </h1>
                        <button className="btn btn-primary px-12 capitalize">
                            Daftar
                        </button>
                        <Link href="/login">
                            <button className="btn btn-primary px-12 btn-outline capitalize ml-4">
                                Masuk
                            </button>
                        </Link>
                    </div>
                    <div className="basis-[55%] bg-slate-300 w-full h-full">
                        <img src="" alt="" />
                    </div>
                </section>
                <section className="mx-auto max-w-xl text-center py-14">
                    <h1 className="text-3xl font-bold text-slate-700 mb-4">
                        Tentang Kami
                    </h1>
                    <p className="text-lg text-slate-500">
                        Berisi deskripsi singkat tentang perusahaan Berisi
                        deskripsi singkat tentang perusahaan Berisi deskripsi
                        singkat tentang perusahaan Berisi deskripsi singkat
                        tentang perusahaan Berisi deskripsi singkat tentang
                        perusahaan
                    </p>
                </section>
                <section className="mx-auto text-center py-14 px-36">
                    <h1 className="text-3xl font-bold text-slate-700 mb-12">
                        Perjalanan Menjadi PNS
                    </h1>
                    <div className="flex flex-col items-center gap-6 justify-center">
                        <div className="flex w-full items-center gap-6">
                            <span className="basis-1/2 text-right text-lg"></span>
                            <div className="w-10 aspect-square bg-slate-500 rounded-full text-white flex items-center justify-center">
                                1
                            </div>
                            <span className="basis-1/2 text-left text-lg">
                                Langkah pertama menjadi PNS
                            </span>
                        </div>
                        <div className="w-1 h-24 bg-slate-300"></div>
                        <div className="flex w-full items-center gap-6">
                            <span className="basis-1/2 text-right text-lg">
                                Langkah kedua menjadi PNS
                            </span>
                            <div className="w-10 aspect-square bg-slate-500 rounded-full text-white flex items-center justify-center">
                                2
                            </div>
                            <span className="basis-1/2 text-left text-lg"></span>
                        </div>
                        <div className="w-1 h-24 bg-slate-300"></div>
                        <div className="flex w-full items-center gap-6">
                            <span className="basis-1/2 text-right text-lg"></span>
                            <div className="w-10 aspect-square bg-slate-500 rounded-full text-white flex items-center justify-center">
                                3
                            </div>
                            <span className="basis-1/2 text-left text-lg">
                                Langkah ketiga menjadi PNS
                            </span>
                        </div>
                        <div className="w-1 h-24 bg-slate-300"></div>
                        <div className="flex w-full items-center gap-6">
                            <span className="basis-1/2 text-right text-lg">
                                Langkah keempat menjadi PNS
                            </span>
                            <div className="w-10 aspect-square bg-slate-500 rounded-full text-white flex items-center justify-center">
                                4
                            </div>
                            <span className="basis-1/2 text-left text-lg"></span>
                        </div>
                    </div>
                </section>
                <section className="mx-auto text-center py-14 px-36">
                    <h1 className="text-3xl font-bold text-slate-700 mb-12">
                        Alasan Bergabung dengan Kami
                    </h1>
                    <div className="flex gap-6">
                        <div className="basis-2/5 flex flex-col text-right gap-4">
                            <div>
                                <h3 className="text-xl font-bold text-slate-600">
                                    Benefit Pertama
                                </h3>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Excepturi itaque quos
                                    fugit alias recusandae iste inventore vero,
                                    dignissimos ullam non voluptatem laudantium
                                    totam reprehenderit minima tenetur ut earum
                                    qui quam?
                                </p>
                            </div>
                            <div>
                                <h3 className="text-xl font-bold text-slate-600">
                                    Benefit Kedua
                                </h3>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Excepturi itaque quos
                                    fugit alias recusandae iste inventore vero,
                                    dignissimos ullam non voluptatem laudantium
                                    totam reprehenderit minima tenetur ut earum
                                    qui quam?
                                </p>
                            </div>
                            <div>
                                <h3 className="text-xl font-bold text-slate-600">
                                    Benefit Ketiga
                                </h3>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Excepturi itaque quos
                                    fugit alias recusandae iste inventore vero,
                                    dignissimos ullam non voluptatem laudantium
                                    totam reprehenderit minima tenetur ut earum
                                    qui quam?
                                </p>
                            </div>
                        </div>
                        <img className="basis-1/5 bg-slate-300" />
                        <div className="basis-2/5 flex flex-col gap-4 text-left">
                            <div>
                                <h3 className="text-xl font-bold text-slate-600">
                                    Benefit Pertama
                                </h3>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Excepturi itaque quos
                                    fugit alias recusandae iste inventore vero,
                                    dignissimos ullam non voluptatem laudantium
                                    totam reprehenderit minima tenetur ut earum
                                    qui quam?
                                </p>
                            </div>
                            <div>
                                <h3 className="text-xl font-bold text-slate-600">
                                    Benefit Pertama
                                </h3>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Excepturi itaque quos
                                    fugit alias recusandae iste inventore vero,
                                    dignissimos ullam non voluptatem laudantium
                                    totam reprehenderit minima tenetur ut earum
                                    qui quam?
                                </p>
                            </div>
                            <div>
                                <h3 className="text-xl font-bold text-slate-600">
                                    Benefit Pertama
                                </h3>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Excepturi itaque quos
                                    fugit alias recusandae iste inventore vero,
                                    dignissimos ullam non voluptatem laudantium
                                    totam reprehenderit minima tenetur ut earum
                                    qui quam?
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <section className="px-36 py-14">
                    <div className="grid grid-cols-3 grid-rows-2 gap-10">
                        <div className="w-full aspect-[4/3] text-6xl font-bold flex items-center">
                            What We Offer
                        </div>
                        <img
                            src=""
                            alt=""
                            className="w-full aspect-[4/3] bg-slate-300"
                        />
                        <img
                            src=""
                            alt=""
                            className="w-full aspect-[4/3] bg-slate-300"
                        />
                        <img
                            src=""
                            alt=""
                            className="w-full aspect-[4/3] bg-slate-300"
                        />
                        <img
                            src=""
                            alt=""
                            className="w-full aspect-[4/3] bg-slate-300"
                        />
                        <img
                            src=""
                            alt=""
                            className="w-full aspect-[4/3] bg-slate-300"
                        />
                    </div>
                </section>
                <section className="px-36 py-14">
                    <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                        Testimoni
                    </h1>
                    <div className="max-w-2xl p-6 border-2 mx-auto">
                        <span className="flex items-center gap-4">
                            <img
                                src=""
                                alt=""
                                className="w-10 aspect-square bg-slate-400 rounded-full"
                            />
                            <p className="text-xl">Nama Siswa</p>
                        </span>
                        <p className="mt-4">
                            &quot;Lorem ipsum, dolor sit amet consectetur
                            adipisicing elit. Eum placeat quas quam debitis
                            dolores laudantium aspernatur aliquid animi pariatur
                            cupiditate architecto, quo voluptatum eveniet nam
                            totam, distinctio tempora nihil repudiandae!&quot;
                        </p>
                    </div>
                </section>
                <section className="px-36 py-14">
                    <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                        Paket Belanja
                    </h1>
                    <div className="flex gap-8 justify-center">
                        <div className="p-8 border-2 flex flex-col items-center justify-between">
                            <div className="text-center">
                                <h3 className="text-3xl font-bold text-slate-600">
                                    Paket Satu
                                </h3>
                                <p className="text-slate-400 mb-4">
                                    Keterangan paket 1
                                </p>
                                <p className="text-4xl text-blue-500 font-bold">
                                    Rp. 10.000
                                </p>
                                <ul className="text-left list-disc list-inside text-slate-500 mt-10">
                                    <li>Fasilitas paket 1</li>
                                    <li>Fasilitas paket 1</li>
                                    <li>Fasilitas paket 1</li>
                                </ul>
                            </div>
                            <button className="btn btn-info capitalize text-white px-10">
                                Beli
                            </button>
                        </div>
                        <div className="p-8 border-2 flex flex-col items-center justify-between">
                            <div className="text-center">
                                <h3 className="text-3xl font-bold text-slate-600">
                                    Paket Dua
                                </h3>
                                <p className="text-slate-400 mb-4">
                                    Keterangan paket 2
                                </p>
                                <p className="text-4xl text-blue-500 font-bold">
                                    Rp. 50.000
                                </p>
                                <ul className="text-left list-disc list-inside text-slate-500 mt-10">
                                    <li>Fasilitas paket 2</li>
                                    <li>Fasilitas paket 2</li>
                                    <li>Fasilitas paket 2</li>
                                    <li>Fasilitas paket 2</li>
                                    <li>Fasilitas paket 2</li>
                                </ul>
                            </div>
                            <button className="btn btn-info capitalize text-white px-10">
                                Beli
                            </button>
                        </div>
                        <div className="p-8 border-2 flex flex-col items-center justify-between">
                            <div className="text-center">
                                <h3 className="text-3xl font-bold text-slate-600">
                                    Paket Tiga
                                </h3>
                                <p className="text-slate-400 mb-4">
                                    Keterangan paket 3
                                </p>
                                <p className="text-4xl text-blue-500 font-bold">
                                    Rp. 100.000
                                </p>
                                <ul className="text-left list-disc list-inside text-slate-500 mt-10">
                                    <li>Fasilitas paket 3</li>
                                    <li>Fasilitas paket 3</li>
                                    <li>Fasilitas paket 3</li>
                                    <li>Fasilitas paket 3</li>
                                    <li>Fasilitas paket 3</li>
                                    <li>Fasilitas paket 3</li>
                                </ul>
                            </div>
                            <button className="btn btn-info capitalize text-white mt-24 px-10">
                                Beli
                            </button>
                        </div>
                    </div>
                </section>
                <section className="px-36 py-14">
                    <h1 className="text-3xl font-bold text-slate-700 mb-12 text-center">
                        FAQ
                    </h1>
                    <div className="flex flex-col gap-2">
                        <div className="collapse collapse-arrow bg-base-200">
                            <input type="radio" name="my-accordion-2" />
                            <div className="collapse-title text-xl font-medium">
                                Click to open this one and close others
                            </div>
                            <div className="collapse-content">
                                <p>hello</p>
                            </div>
                        </div>
                        <div className="collapse collapse-arrow bg-base-200">
                            <input type="radio" name="my-accordion-2" />
                            <div className="collapse-title text-xl font-medium">
                                Click to open this one and close others
                            </div>
                            <div className="collapse-content">
                                <p>hello</p>
                            </div>
                        </div>
                        <div className="collapse collapse-arrow bg-base-200">
                            <input type="radio" name="my-accordion-2" />
                            <div className="collapse-title text-xl font-medium">
                                Click to open this one and close others
                            </div>
                            <div className="collapse-content">
                                <p>hello</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section className="px-36 py-14">
                    <div className="px-8 py-6 bg-blue-200 flex">
                        <div className="basis-1/2">
                            <h3 className="text-lg mb-4 font-bold text-slate-600">
                                Ayo bergabung dengan kami
                            </h3>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Totam ea non tempore iure
                                autem porro delectus, minima quis tenetur!
                                Delectus error inventore.
                            </p>
                        </div>
                        <img
                            src=""
                            alt=""
                            className="basis-1/2 bg-slate-300 w-full"
                        />
                    </div>
                </section>
            </div>
        </>
    );
}
