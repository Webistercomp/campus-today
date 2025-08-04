import React from "react";
import { Head } from "@inertiajs/react";

function Test(props) {
    console.log(props);

    return (
        <>
            <Head title="INIT SETUP" />
            <div className="flex flex-col h-screen w-screen bg-slate-400 text-white items-center justify-center">
                <h1>THIS IS INIT SETUP FOR CAMPUS TODAY PROJECT</h1>
            </div>
        </>
    );
}

export default Test;
