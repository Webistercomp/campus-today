import { useEffect, useState } from "react";

export default function Timer({ durationMinutes }) {
    const [hours, setHours] = useState(0);
    const [minutes, setMinutes] = useState(0);
    const [seconds, setSeconds] = useState(0);
    const [stop, setStop] = useState(false);
    const expired = new Date().getTime() + durationMinutes * 60 * 1000;

    const handleIsExpired = () => {
        window.alert("WAKTU SUDAH HABIS !!");
    };

    const getTime = () => {
        const time = expired - Date.now();

        setHours(Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
        setMinutes(Math.floor((time % (1000 * 60 * 60)) / (1000 * 60)));
        setSeconds(Math.floor((time % (1000 * 60)) / 1000));

        if (time < 1000) {
            return true;
        }
    };

    useEffect(() => {
        const timerInterval = setInterval(() => {
            const isExpired = getTime(expired);

            if (isExpired) {
                clearInterval(timerInterval);
                handleIsExpired();
            }
        }, 1000);

        return () => clearInterval(timerInterval);
    }, []);

    return (
        <span>
            {hours} : {minutes} : {seconds}
        </span>
    );
}
