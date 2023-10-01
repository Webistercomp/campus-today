import { Link } from "@inertiajs/react";
import CTLogo from "@/images/ct_ 2.png";
import { forwardRef } from "react";
import ProfileIcon from "@/icons/ProfileIcon";

export default forwardRef(function Navbar({ isAuthed }, ref) {
    if (isAuthed) {
        return (
            <nav
                className="navbar fixed bg-twilight-blue shadow-lg px-28 z-50 top-0"
                ref={ref}
            >
                <div className="flex justify-between w-full">
                    <Link href="/" className="">
                        <img src={CTLogo} alt="ct-logo" className="h-16" />
                    </Link>
                    <ul className="menu menu-horizontal px-1 gap-4 items-center">
                        <li>
                            <Link href="">Home</Link>
                        </li>
                        <li>
                            <Link href="">Artikel</Link>
                        </li>
                        <div className="divider divider-horizontal"></div>
                        <div className="dropdown dropdown-end">
                            <button
                                tabIndex={0}
                                className="h-fit p-2 rounded-full bg-twilight-blue hover:bg-slate-200 transition-all duration-300"
                            >
                                <ProfileIcon />
                            </button>
                            <ul
                                tabIndex={0}
                                className="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52"
                            >
                                <li>
                                    <a>Item 1</a>
                                </li>
                                <li>
                                    <a>Item 2</a>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </nav>
        );
    }

    return (
        <nav
            className="navbar fixed bg-twilight-blue shadow-lg px-28 z-50 top-0"
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
