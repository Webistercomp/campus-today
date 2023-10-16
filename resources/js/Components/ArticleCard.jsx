export default function ArticleCard({ image, title, desc }) {
    return (
        <div className="card w-96 bg-base-100 shadow-xl text-left cursor-pointer">
            <figure>
                <img
                    src={image}
                    alt={title}
                    className="bg-slate-500 w-full aspect-video"
                />
            </figure>
            <div className="card-body">
                <h2 className="card-title">{title}</h2>
                <p>
                    {desc}
                </p>
            </div>
        </div>
    );
}
