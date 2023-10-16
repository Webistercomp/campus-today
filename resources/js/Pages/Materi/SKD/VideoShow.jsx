import React from "react";
import { Head } from "@inertiajs/react";

function VideoShow(props) {
    return (
        <>
            <Head title="Untitled" />
            <div className="flex flex-col h-screen w-screen bg-slate-400 text-white items-center justify-center">
            {JSON.stringify(props.chapter)}
            </div>
        </>
    );
}

export default VideoShow;
