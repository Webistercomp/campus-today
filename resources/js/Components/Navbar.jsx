import { Link } from "@inertiajs/react";
import CTLogo from "@/images/ct_ 2.png";
import { forwardRef } from "react";
import ProfileIcon from "@/icons/ProfileIcon";

export default forwardRef(function Navbar({ isAuthed }, ref) {
    if (isAuthed) {
        return (
            <nav
                className="navbar fixed bg-white shadow-lg px-28 z-50 top-0"
                ref={ref}
            >
                <div className="flex justify-between w-full">
                    <Link href="/" className="">
                        <img src={CTLogo} alt="ct-logo" className="h-16" />
                    </Link>
                    <ul className="menu menu-horizontal px-1 gap-4 items-center">
                        <li>
                            <Link href={route("dashboard")}>Home</Link>
                        </li>
                        <li>
                            <Link href="">Artikel</Link>
                        </li>
                        <div className="divider divider-horizontal"></div>
                        <Link
                            href=""
                            className="h-fit p-2 rounded-full bg-white hover:bg-slate-200 transition-all duration-300"
                        >
                            <ProfileIcon />
                        </Link>
                    </ul>
                </div>
            </nav>
        );
    }

    return (
        <nav
            className="navbar fixed bg-white shadow-lg px-28 z-50 top-0"
            ref={ref}
        >
            <div className="flex justify-between w-full">
                <Link href="/" className="">
                    <img src={CTLogo} alt="ct-logo" className="h-16" />
                </Link>
                <ul className="menu menu-horizontal px-1 gap-4">
                    <li>
                        <Link href="#about-us">Tentang</Link>
                    </li>
                    <li>
                        <Link href="#benefit">Keunggulan</Link>
                    </li>
                    <li>
                        <Link href="#testimoni">Testimoni</Link>
                    </li>
                    <li>
                        <Link href="#paket">Paket</Link>
                    </li>
                    <li>
                        <Link href="#blog">Blog</Link>
                    </li>
                </ul>
            </div>
        </nav>
    );
});
