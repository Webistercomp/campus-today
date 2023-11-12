import { Link } from "@inertiajs/react";
import CTLogo from "@/images/ct_ 2.png";
import { forwardRef } from "react";
import ProfileIcon from "@/icons/ProfileIcon";

export default forwardRef(function Navbar({ isAuthed, user }, ref) {
    if (isAuthed) {
        return (
            <>
                <nav
                    className="navbar fixed bg-white shadow-lg px-28 z-50 top-0"
                    ref={ref}
                >
                    <div className="flex justify-between w-full">
                        <Link href={route("dashboard")} className="">
                            <img src={CTLogo} alt="ct-logo" className="h-16" />
                        </Link>
                        <ul className="menu menu-horizontal px-1 gap-4 items-center">
                            <li>
                                <Link href={route("dashboard")}>Home</Link>
                            </li>
                            <li>
                                <Link href={route("article.index")}>Artikel</Link>
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
                            <Link
                                href={route("logout")}
                                method="post"
                                className="btn btn-error capitalize text-white"
                                as="button"
                            >
                                Logout
                            </Link>
                        </div>
                    </div>
                </dialog>
            </>
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
                        <Link href={route('article.index')}>Blog</Link>
                    </li>
                </ul>
            </div>
        </nav>
    );
});
