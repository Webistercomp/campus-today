import React from "react";
import { Head } from "@inertiajs/react";

function Index(props) {
    return (
        <>
            <Head title="Untitled" />
            <div className="flex flex-col h-screen w-screen bg-slate-400 text-white items-center justify-center">
                <h1>Ini halaman materi skd index</h1>
            </div>
        </>
    );
}

export default Index;
