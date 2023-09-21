import Footer from "@/Components/Footer";
import Navbar from "@/Components/Navbar";

export default function PublicLayout({ children }) {
    return (
        <div className="min-h-screen font-poppins">
            <Navbar />

            <div>{children}</div>

            <Footer />
        </div>
    );
}
