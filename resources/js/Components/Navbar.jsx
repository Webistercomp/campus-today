import { Link } from "@inertiajs/react";
import CTLogo from "@/images/ct_ 2.png";

export default function Navbar() {
    return (
        <nav className="navbar bg-twilight-blue shadow-lg px-28">
            <div className="flex justify-between w-full">
                <Link href="/" className="">
                    <img src={CTLogo} alt="ct-logo" className="h-16" />
                </Link>
                <ul className="menu menu-horizontal px-1 gap-4">
                    <li>
                        <Link>Tentang</Link>
                    </li>
                    <li>
                        <Link>Keunggulan</Link>
                    </li>
                    <li>
                        <Link>Testimoni</Link>
                    </li>
                    <li>
                        <Link>Paket</Link>
                    </li>
                    <li>
                        <Link>Blog</Link>
                    </li>
                </ul>
            </div>
        </nav>
    );
}
