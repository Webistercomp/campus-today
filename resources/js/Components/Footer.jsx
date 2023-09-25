import EnvelopeIcon from "@/icons/EnvelopeIcon";
import FbIcon from "@/icons/FbIcon";
import IgIcon from "@/icons/IgIcon";
import TiktokIcon from "@/icons/TiktokIcon";
import TwitterIcon from "@/icons/TwitterIcon";
import WAIcon from "@/icons/WaIcon";
import YtIcon from "@/icons/YtIcon";
import CTLogo from "@/images/ct_ 2.png";
import { Link } from "@inertiajs/react";

export default function Footer() {
    return (
        <footer className="footer bg-ct-grey py-16 text-white flex flex-col px-24">
            <div className="flex justify-between w-full max-w-4xl mx-auto">
                <aside>
                    <img src={CTLogo} alt="ct-logo" className="w-48" />
                    <p className="flex flex-col gap-2 mt-14">
                        PT AYO KREASI BERSAMA
                        <br />
                        <Link
                            href="mailto:campustoday3100@gmail.com"
                            className="link link-hover underline flex gap-4 items-center"
                        >
                            <EnvelopeIcon />
                            <span>campustoday3100@gmail.com</span>
                        </Link>
                        <Link
                            href="mailto:campustoday3100@gmail.com"
                            className="link link-hover underline flex gap-4 items-center"
                        >
                            <WAIcon />
                            <span>+62 851-7214-7217</span>
                        </Link>
                    </p>
                    <div className="mt-6">
                        Temukan Kami <br />
                        <ul className="flex gap-4 items-center py-2">
                            <li>
                                <Link href="">
                                    <IgIcon />
                                </Link>
                            </li>
                            <li>
                                <Link href="">
                                    <FbIcon />
                                </Link>
                            </li>
                            <li>
                                <Link href="">
                                    <TiktokIcon />
                                </Link>
                            </li>
                            <li>
                                <Link href="">
                                    <TwitterIcon />
                                </Link>
                            </li>
                            <li>
                                <Link href="">
                                    <YtIcon />
                                </Link>
                            </li>
                        </ul>
                    </div>
                </aside>
                <div className="flex gap-14 pt-24">
                    <nav className="flex flex-col gap-2">
                        <header className="footer-title">Layanan</header>
                        <a className="link link-hover">Bimbel UTBK</a>
                        <a className="link link-hover">Bimbel UM</a>
                        <a className="link link-hover">Bimbel SKD</a>
                    </nav>
                    <nav className="flex flex-col gap-2">
                        <header className="footer-title">Halaman</header>
                        <a className="link link-hover">Tentang Kami</a>
                        <a className="link link-hover">Pricing</a>
                        <a className="link link-hover">FAQ</a>
                        <a className="link link-hover">Testimoni</a>
                    </nav>
                </div>
            </div>
            <hr className="h-[1px] border-0 bg-gradient-to-r from-ct-grey via-slate-500 to-ct-grey w-full my-2" />
            <p className="text-center mx-auto">
                &copy; {new Date().getFullYear()} CAMPUS TODAY. All rights
                reserved
            </p>
        </footer>
    );
}
