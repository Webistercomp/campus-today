export default function ArticleCard({ image, title, body }) {
    return (
        <div className="card w-full max-w-lg bg-base-100 shadow-lg text-left cursor-pointer rounded-md">
            <figure>
                <img
                    src={image}
                    alt={title}
                    className="bg-slate-500 w-full aspect-video object-cover"
                />
            </figure>
            <div className="card-body p-2 md:p-4 text-sm xl:text-base">
                <h2 className="card-title text-lg">{title}</h2>
                <div className="line-clamp-2" dangerouslySetInnerHTML={{__html: body}} />
            </div>
        </div>
    );
}
