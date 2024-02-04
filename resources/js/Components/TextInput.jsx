import { forwardRef, useEffect, useRef } from "react";

export default forwardRef(function TextInput(
    {
        type = "text",
        className = "",
        isFocused = false,
        icon = false,
        id = "",
        endIcon = false,
        ...props
    },
    ref
) {
    const input = ref ? ref : useRef();

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    return (
        <label htmlFor={id} className="relative">
            <span className="absolute top-1/2 -translate-y-1/2 left-2">
                {icon}
            </span>
            <input
                {...props}
                id={id}
                type={type}
                className={`border-b-2 border-black py-2 ${
                    icon === false ? "pl-2" : "pl-10"
                } pr-2 outline-none focus:border-b-primary-focus focus:bg-slate-50 w-full ${className}`}
                ref={input}
            />
            {endIcon && endIcon}
        </label>
    );
});
