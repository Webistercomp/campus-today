import PropTypes from "prop-types";

function Alert({ type, isShow, msg }) {
    if (type === "info") {
        return (
            <div
                className={`w-full px-4 md:px-14 lg:px-24 xl:px-32 fixed left-1/2 -translate-x-1/2 transition-all duration-150 ${
                    isShow
                        ? "top-24 xl:top-28 opacity-100 z-[100]"
                        : "top-0 opacity-0 z-[0]"
                }`}
            >
                <div
                    className={`alert alert-info w-full md:w-fit shadow-lg flex mx-auto`}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        className="stroke-current shrink-0 w-6 h-6"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        ></path>
                    </svg>
                    <span>{msg}</span>
                </div>
            </div>
        );
    } else if (type === "success") {
        return (
            <div
                className={`w-full px-4 md:px-14 lg:px-24 xl:px-32 fixed left-1/2 -translate-x-1/2 transition-all duration-150 ${
                    isShow
                        ? "top-24 xl:top-28 opacity-100 z-[100]"
                        : "top-0 opacity-0 z-[0]"
                }`}
            >
                <div
                    className={`alert alert-success w-full md:w-fit shadow-lg flex mx-auto`}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="stroke-current shrink-0 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span>{msg}</span>
                </div>
            </div>
        );
    } else if (type === "warning") {
        return (
            <div
                className={`w-full px-4 md:px-14 lg:px-24 xl:px-32 fixed left-1/2 -translate-x-1/2 transition-all duration-150 ${
                    isShow
                        ? "top-24 xl:top-28 opacity-100 z-[100]"
                        : "top-0 opacity-0 z-[0]"
                }`}
            >
                <div
                    className={`alert alert-warning w-full md:w-fit shadow-lg flex mx-auto`}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="stroke-current shrink-0 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>
                    <span>{msg}</span>
                </div>
            </div>
        );
    } else if (type === "error") {
        return (
            <div
                className={`w-full px-4 md:px-14 lg:px-24 xl:px-32 fixed left-1/2 -translate-x-1/2 transition-all duration-150 ${
                    isShow
                        ? "top-24 xl:top-28 opacity-100 z-[100]"
                        : "top-0 opacity-0 z-[0]"
                }`}
            >
                <div
                    className={`alert alert-error w-full md:w-fit shadow-lg flex mx-auto`}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="stroke-current shrink-0 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span>{msg}</span>
                </div>
            </div>
        );
    }
}

Alert.propTypes = {
    type: PropTypes.oneOf(["info", "success", "warning", "error"]).isRequired,
    isShow: PropTypes.bool.isRequired,
    msg: PropTypes.string.isRequired,
};

export default Alert;
