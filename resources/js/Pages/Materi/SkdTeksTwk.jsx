import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function SkdTeksTwk({ title }) {
    return (
        <AuthenticatedLayout>
            <Head title={title} />

            <section className="mt-4 w-1/5 float-left fixed top-28 pr-8 flex flex-col pb-8 h-[calc(100vh_-_200px)]">
                <Link onClick={() => history.back()} className="link-hover">
                    &laquo; Kembali ke Materi
                </Link>

                <h1 className="text-3xl text-curious-blue font-semibold mt-4">
                    {title}
                </h1>

                <div className="flex flex-col gap-2 mt-6 overflow-y-scroll scrollbar-hide flex-auto">
                    <button className="btn materi materi-active capitalize">
                        Judul Materi Pertama
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Kedua
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Ketiga
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keempat
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Kelima
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                    <button className="btn materi capitalize">
                        Judul Materi Keenam
                    </button>
                </div>
            </section>

            <section className="mt-8 float-right w-4/5 relative pl-10 py-16 flex flex-col">
                <div>
                    <h5 className="judul-materi">Judul Materi</h5>
                    <h6 className="subjudul-materi">Subjudul Materi</h6>
                    <p className="isi-materi">
                        Lorem ipsum dolor, sit amet consectetur adipisicing
                        elit. Non totam sapiente laborum mollitia cupiditate
                        animi ex sequi quae debitis perferendis! Hic, esse in
                        iste dolorum nemo repellendus id eveniet quos tempora
                        deleniti asperiores facere? Nam sapiente reiciendis quae
                        fuga maiores nesciunt accusantium deleniti, incidunt
                        dolor nobis quia! Rerum expedita praesentium sint quis
                        dolor debitis earum blanditiis, omnis, nisi at voluptas.
                    </p>
                    <p className="isi-materi">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Exercitationem nam inventore corporis, laboriosam
                        nesciunt modi, distinctio tempore enim consectetur,
                        dignissimos a maxime eos? Natus expedita cumque, dolorem
                        quod totam officiis.
                    </p>
                    <img
                        src=""
                        alt=""
                        className="aspect-video bg-slate-200 w-2/3 gambar-materi"
                    />
                    <p className="isi-materi">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Eos in vero eius necessitatibus animi nam aliquid harum
                        sequi nihil assumenda. Facilis, quia perspiciatis
                        ducimus eligendi ipsa consectetur rerum totam nulla
                        libero voluptatum beatae quibusdam debitis voluptatem?
                        Quas dicta dolorum aperiam culpa dolor, doloremque,
                        assumenda accusantium consequuntur necessitatibus fugit
                        nulla optio quis? Distinctio ut unde similique
                        repudiandae totam sequi ad ipsum quisquam, non explicabo
                        doloribus voluptas reprehenderit praesentium aut earum
                        blanditiis?
                    </p>
                    <p className="isi-materi">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Debitis aliquid inventore dicta! Qui veritatis rem
                        eius adipisci, excepturi corrupti quibusdam, natus
                        blanditiis cum sit sint modi officiis earum culpa
                        mollitia!
                    </p>
                </div>
                <button className="btn btn-primary text-white capitalize mt-6 self-end px-6">
                    Lanjut &raquo;
                </button>
            </section>
        </AuthenticatedLayout>
    );
}
