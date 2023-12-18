export default function ArticleCard({ image, title, body }) {
    return (
        <div className="card w-full max-w-lg bg-base-100 shadow-lg text-left cursor-pointer">
            <figure>
                <img
                    src={image}
                    alt={title}
                    className="bg-slate-500 w-full aspect-video object-cover"
                />
            </figure>
            <div className="card-body p-6">
                <h2 className="card-title text-lg">{title}</h2>
                <p className="line-clamp-3">{body}</p>
            </div>
        </div>
    );
}
