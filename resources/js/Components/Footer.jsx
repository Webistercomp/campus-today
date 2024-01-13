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
        <footer className="footer bg-ct-grey py-8 lg:py-16 text-white flex flex-col p-4 md:px-14 lg:px-24 xl:px-32">
            <div className="flex flex-col md:flex-row justify-between w-full max-w-4xl mx-auto gap-8">
                <aside className="w-full md:basis-1/2">
                    <img
                        src={CTLogo}
                        alt="ct-logo"
                        className="w-48 mx-auto lg:ml-0"
                    />
                    <p className="flex flex-col gap-2 mt-4 lg:mt-14">
                        <span className="text-xl">PT AYO KREASI BERSAMA</span>
                        <a href="mailto:campustoday3100@gmail.com" className="link link-hover underline flex gap-4 items-center">
                            <EnvelopeIcon />
                            <span>campustoday3100@gmail.com</span>
                        </a>
                        <a href="https://wa.me/6285172147217" className="link link-hover underline flex gap-4 items-center">
                            <WAIcon />
                            <span>+62 851-7214-7217</span>
                        </a>
                    </p>
                    <div className="mt-6">
                        Temukan Kami <br />
                        <ul className="flex gap-4 items-center py-2">
                            <li>
                                <a href="https://www.instagram.com/campus.today" target="_blank">
                                    <IgIcon />
                                </a>
                            </li>
                            {/* <li>
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
                            </li> */}
                        </ul>
                    </div>
                </aside>
                <div className="flex gap-8 pt-8 lg:pt-24 md:basis-1/2 md:justify-end lg:justify-center">
                    <nav className="flex flex-col gap-2">
                        <header className="footer-title">Layanan</header>
                        <a className="link link-hover" href={route('material.type', 'skd')}>Belajar SKD</a>
                        <a className="link link-hover" href={route('material.type', 'skb')}>Bimbel SKB</a>
                        <a className="link link-hover" href={route('material.type', 'utbk')}>Bimbel UTBK</a>
                        <a className="link link-hover" href={route('material.type', 'um')}>Bimbel UM</a>
                    </nav>
                    <nav className="flex flex-col gap-2">
                        <header className="footer-title">Halaman</header>
                        <a className="link link-hover" href={route('home') + '#about-us'}>Tentang Kami</a>
                        <a className="link link-hover" href={route('home') + '#paket'}>Paket</a>
                        <a className="link link-hover" href={route('home') + '#testimoni'}>Testimoni</a>
                        <a className="link link-hover" href={route('home') + '#faq'}>FAQ</a>
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
