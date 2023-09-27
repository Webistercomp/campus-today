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
        <div className="min-h-screen font-poppins">
            <Navbar isAuthed={true} ref={ref} />

            <div>{children}</div>

            <Footer />
        </div>
    );
}
