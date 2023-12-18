import Footer from "@/Components/Footer";
import Navbar from "@/Components/Navbar";
import React, { useRef, useEffect } from "react";

export default function AuthenticatedLayout({ user, header, children }) {
    const ref = useRef(null);

    useEffect(() => {
        const h = ref.current.clientHeight;
        const doc = document.querySelector("html");
        doc.style.scrollBehavior = "smooth";
        doc.style.scrollPaddingTop = `${h - 30}px`;
    }, []);

    return (
        <div className="min-h-screen font-poppins bg-white overflow-x-clip">
            <Navbar isAuthed={true} user={user} ref={ref} />

            <div
                className={`${
                    !["dashboard", "paket.index"].includes(route().current()) &&
                    "px-4 md:px-14 lg:px-24 xl:px-32"
                } pt-20 md:pt-24 bg-white`}
            >
                {children}
            </div>

            {route().current() === "dashboard" ? <Footer /> : ""}
        </div>
    );
}
