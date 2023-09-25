import { Link } from "@inertiajs/react";
import CTLogo from "@/images/ct_ 2.png";
import { forwardRef } from "react";

export default forwardRef(function Navbar({}, ref) {
    return (
        <nav
            className="navbar fixed bg-twilight-blue shadow-lg px-28 z-50"
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
