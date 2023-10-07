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
        <div className="min-h-screen font-poppins bg-twilight-blue overflow-auto">
            <Navbar isAuthed={true} ref={ref} />

            <div className="pt-24 px-28 bg-twilight-blue">{children}</div>

            {route().current() === "dashboard" ? <Footer /> : ""}
        </div>
    );
}
