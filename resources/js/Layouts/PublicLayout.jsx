import Footer from "@/Components/Footer";
import Navbar from "@/Components/Navbar";
import { useEffect, useRef, useState } from "react";

export default function PublicLayout({ children }) {
    const ref = useRef(null);

    useEffect(() => {
        const h = ref.current?.clientHeight;
        const doc = document.querySelector("html");
        doc.style.scrollBehavior = "smooth";
        doc.style.scrollPaddingTop = `${h - 36}px`;
    }, []);

    return (
        <div className="min-h-screen font-poppins">
            <Navbar isAuthed={false} ref={ref} />

            <div>{children}</div>

            <Footer />
        </div>
    );
}
