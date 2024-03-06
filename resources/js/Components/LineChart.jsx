import { Line } from "react-chartjs-2";

export default function LineChart({ data, desc }) {
    return (
        <div>
            <Line
                data={data}
                options={{
                    plugins: {
                        title: { display: true },
                        legend: {
                            display: true,
                        },
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: "Tryout",
                                color: "#2A8AC9",
                                font: {
                                    size: 20,
                                    weight: 600,
                                },
                            },
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: "Score",
                                color: "#2A8AC9",
                                font: {
                                    size: 20,
                                    weight: 600,
                                },
                            },
                        },
                    },
                }}
            />
        </div>
    );
}
