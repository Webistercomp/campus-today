export default function InputError({ message, className = "", ...props }) {
    return (
        <p
            {...props}
            className={`text-sm ${
                message !== undefined ? "text-error" : "text-transparent"
            } ${className}`}
        >
            {message || "error"}
        </p>
    );
}
