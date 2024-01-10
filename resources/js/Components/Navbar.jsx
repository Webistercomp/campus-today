import { Link, router } from "@inertiajs/react";
import CTLogo from "@/images/ct_ 2.png";
import { forwardRef, useState } from "react";
import ProfileIcon from "@/icons/ProfileIcon";
import HamburgerIcon from "@/icons/HamburgerIcon";

export default forwardRef(function Navbar({ isAuthed, user }, ref) {
    const [isOpen, setIsOpen] = useState(false);

    const handleOnLogout = () => {
        localStorage.clear();

        return router.post(route("logout"));
    };

    if (isAuthed) {
        return (
            <>
                {isOpen && (
                    <div
                        className="fixed w-screen h-screen z-40"
                        onClick={() => setIsOpen(false)}
                    ></div>
                )}
                <div
                    className={`bg-white flex fixed justify-stretch z-40 w-full px-4 pb-4 pt-20 shadow-lg ${
                        isOpen === false ? "-translate-y-full" : "translate-y-0"
                    } transition-all duration-150`}
                >
                    <ul className="flex flex-col gap-2 w-full">
                        <Link href={route("dashboard")}>
                            <li className="py-2 px-4 bg-slate-200 hover:bg-slate-700 hover:text-white rounded-md transition-all duration-150">
                                Home
                            </li>
                        </Link>
                        <Link href={route("article.index")}>
                            <li className="py-2 px-4 bg-slate-200 hover:bg-slate-700 hover:text-white rounded-md transition-all duration-150">
                                Artikel
                            </li>
                        </Link>
                    </ul>
                    <div className="divider divider-horizontal"></div>
                    <div className="dropdown dropdown-end">
                        <button
                            tabIndex={0}
                            className="h-fit p-2 rounded-full bg-white hover:bg-slate-200 transition-all duration-300"
                        >
                            <ProfileIcon />
                        </button>
                        <ul
                            tabIndex={0}
                            className="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52"
                        >
                            <li className="p-2 text-center font-semibold text-lg">
                                {user.name}
                            </li>
                            <li>
                                <Link href={route("profile")}>Profil Saya</Link>
                            </li>
                            <div className="divider px-2 my-1"></div>
                            <button
                                className="btn btn-error btn-md capitalize text-white"
                                onClick={() =>
                                    document
                                        .getElementById("logout_modal")
                                        .showModal()
                                }
                            >
                                Logout
                            </button>
                        </ul>
                    </div>
                </div>
                <nav
                    className={`navbar fixed bg-white ${
                        isOpen === false ? "shadow-lg" : ""
                    } px-4 md:px-14 lg:px-24 xl:px-32 z-50 top-0`}
                    ref={ref}
                >
                    <div className="flex justify-between w-full">
                        <Link href={route("dashboard")} className="">
                            <img
                                src={CTLogo}
                                alt="ct-logo"
                                className="h-12 lg:h-16 xl:h-20"
                            />
                        </Link>
                        <ul className="menu menu-horizontal px-1 gap-4 items-center hidden md:inline-flex">
                            <li>
                                <Link href={route("dashboard")}>Home</Link>
                            </li>
                            <li>
                                <Link href={route("article.index")}>
                                    Artikel
                                </Link>
                            </li>
                            <div className="divider divider-horizontal"></div>
                            <div className="dropdown dropdown-end">
                                <button
                                    tabIndex={0}
                                    className="h-fit p-2 rounded-full bg-white hover:bg-slate-200 transition-all duration-300"
                                >
                                    <ProfileIcon />
                                </button>
                                <ul
                                    tabIndex={0}
                                    className="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52"
                                >
                                    <li className="p-2 text-center font-semibold text-lg">
                                        {user.name}
                                    </li>
                                    <li>
                                        <Link href={route("profile")}>
                                            Profil Saya
                                        </Link>
                                    </li>
                                    <div className="divider px-2 my-1"></div>
                                    <button
                                        className="btn btn-error btn-md capitalize text-white"
                                        onClick={() =>
                                            document
                                                .getElementById("logout_modal")
                                                .showModal()
                                        }
                                    >
                                        Logout
                                    </button>
                                </ul>
                            </div>
                        </ul>
                        <button
                            className="btn md:hidden"
                            onClick={() => setIsOpen(!isOpen)}
                        >
                            <HamburgerIcon />
                        </button>
                    </div>
                </nav>
                <dialog id="logout_modal" className="modal">
                    <div className="modal-box">
                        <h3 className="font-bold text-lg">Logout</h3>
                        <p className="py-4">Apakah anda ingin logout ?</p>
                        <div className="modal-action">
                            <form method="dialog">
                                {/* if there is a button in form, it will close the modal */}
                                <button className="btn capitalize">
                                    Batal
                                </button>
                            </form>
                            <button
                                className="btn btn-error capitalize text-white"
                                onClick={handleOnLogout}
                            >
                                Logout
                            </button>
                        </div>
                    </div>
                </dialog>
            </>
        );
    }

    return (
        <>
            {isOpen && (
                <div
                    className="fixed w-screen h-screen z-40"
                    onClick={() => setIsOpen(false)}
                ></div>
            )}
            <ul
                className={`fixed bg-white shadow-lg w-full px-4 flex flex-col z-50 gap-2 pt-20 pb-4 ${
                    isOpen === false ? "-translate-y-full" : "translate-y-0"
                } transition-all duration-150`}
            >
                <a
                    onClick={() => setIsOpen(false)}
                    href="#about-us"
                    className="py-2 px-4 bg-slate-200 hover:bg-slate-700 hover:text-white rounded-md transition-all duration-150"
                >
                    Tentang
                </a>
                <a
                    onClick={() => setIsOpen(false)}
                    href="#benefit"
                    className="py-2 px-4 bg-slate-200 hover:bg-slate-700 hover:text-white rounded-md transition-all duration-150"
                >
                    Keunggulan
                </a>
                <a
                    onClick={() => setIsOpen(false)}
                    href="#testimoni"
                    className="py-2 px-4 bg-slate-200 hover:bg-slate-700 hover:text-white rounded-md transition-all duration-150"
                >
                    Testimoni
                </a>
                <a
                    href="#paket"
                    className="py-2 px-4 bg-slate-200 hover:bg-slate-700 hover:text-white rounded-md transition-all duration-150"
                    onClick={() => setIsOpen(false)}
                >
                    Paket
                </a>
            </ul>
            <nav
                className={`navbar fixed bg-white ${
                    isOpen === false ? "shadow-lg" : ""
                } px-4 md:px-14 lg:px-24 xl:px-32 z-50 top-0`}
                ref={ref}
            >
                <div className="flex justify-between w-full relative">
                    <a href="#" className="relative">
                        <img
                            src={CTLogo}
                            alt="ct-logo"
                            className="h-12 lg:h-16 xl:h-20"
                        />
                    </a>
                    <ul className="menu menu-horizontal px-1 gap-4 hidden md:flex md:items-center relative">
                        <li>
                            <a href="#about-us">Tentang</a>
                        </li>
                        <li>
                            <a href="#benefit">Keunggulan</a>
                        </li>
                        <li>
                            <a href="#testimoni">Testimoni</a>
                        </li>
                        <li>
                            <a href="#paket">Paket</a>
                        </li>
                    </ul>
                    <button
                        className="btn md:hidden"
                        onClick={() => setIsOpen(!isOpen)}
                    >
                        <HamburgerIcon />
                    </button>
                </div>
            </nav>
        </>
    );
});
