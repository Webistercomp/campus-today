export default function TestiCard({ name, as, photo, testi }) {
    return (
        <div className="bg-white p-10 shadow-xl rounded-3xl flex flex-row-reverse max-w-4xl gap-14 items-center mx-auto">
            <div className="flex flex-col items-center text-lg">
                <img
                    src=""
                    alt=""
                    className="w-20 aspect-square rounded-full bg-slate-500 mb-4"
                />
                <h4 className="font-semibold">Nama</h4>
                <p>Jabatan</p>
            </div>
            <p className="text-justify">
                &quot;Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Alias autem porro, voluptas ab cum qui nisi aperiam incidunt
                rerum tenetur voluptatibus officiis quae aut asperiores, tempore
                architecto animi excepturi. Mollitia.&quot;
            </p>
        </div>
    );
}
