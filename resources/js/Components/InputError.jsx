export default function InputError({ message, className = "", ...props }) {
    return (
        <p
            {...props}
            className={`text-sm ${
                message !== undefined ? "text-red-600" : "text-transparent"
            } ${className}`}
        >
            {message || "error"}
        </p>
    );
}
