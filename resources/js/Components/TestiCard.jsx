export default function TestiCard({
    name,
    as,
    image,
    testi,
    agency,
    isActive,
}) {
    return (
        <div
            className={`${
                isActive
                    ? "bg-curious-blue text-white"
                    : "bg-white text-slate-900"
            } transition-colors duration-500 p-6 lg:p-10 shadow-md rounded-lg lg:rounded-3xl flex flex-col-reverse md:flex-row-reverse w-full max-w-sm md:max-w-xl lg:max-w-3xl xl:max-w-5xl gap-8 lg:gap-8 items-center snap-center relative overflow-clip`}
            id="testi-card"
        >
            <div className="flex flex-col items-center text-lg basis-2/5 lg:basis-2/6 xl:basis-2/6">
                <img
                    src={image}
                    alt=""
                    className="w-24 object-cover aspect-square rounded-full bg-slate-500 mb-4 shadow-lg shadow-curious-blue-300"
                />
                <h4 className="font-semibold text-center">{name}</h4>
                <p className="text-center">{agency}</p>
                <p className="text-center text-sm">{as}</p>
            </div>
            <p className="text-justify text-sm lg:text-base basis-3/5 lg:basis-4/6 xl:basis-4/6">
                &quot;{testi}&quot;
            </p>
        </div>
    );
}
