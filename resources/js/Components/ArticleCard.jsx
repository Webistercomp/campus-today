export default function ArticleCard({ photoURL, title, desc }) {
    return (
        <div className="card w-96 bg-base-100 shadow-xl text-left cursor-pointer">
            <figure>
                <img
                    src=""
                    alt=""
                    className="bg-slate-500 w-full aspect-video"
                />
            </figure>
            <div className="card-body">
                <h2 className="card-title">Judul Artikel</h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur. Consequat tincidunt
                    sollicitudin magna viverra ullamcorper.
                </p>
            </div>
        </div>
    );
}
