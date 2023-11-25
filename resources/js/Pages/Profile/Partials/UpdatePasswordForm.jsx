import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import { useForm } from "@inertiajs/react";
import { useRef } from "react";

export default function UpdatePasswordForm({ setAlertData }) {
    const passwordInput = useRef();
    const currentPasswordInput = useRef();

    const {
        data,
        setData,
        errors,
        put,
        reset,
        processing,
        recentlySuccessful,
    } = useForm({
        current_password: "",
        password: "",
        password_confirmation: "",
    });

    const updatePassword = (e) => {
        e.preventDefault();

        put(route("password.update"), {
            preserveScroll: true,
            onSuccess: () => {
                reset();
                setAlertData({
                    type: "success",
                    isShow: true,
                    msg: "Berhasil mengubah password",
                });
                setTimeout(() => {
                    setAlertData({ type: "", isShow: false, msg: "" });
                }, 2000);
            },
            onError: (errors) => {
                if (errors.password) {
                    reset("password", "password_confirmation");
                    passwordInput.current.focus();
                }

                if (errors.current_password) {
                    reset("current_password");
                    currentPasswordInput.current.focus();
                }
            },
        });
    };

    return (
        <section className="bg-white p-8 shadow-lg rounded-lg mt-4">
            <header>
                <h2 className="text-xl font-medium text-curious-blue">
                    Ganti Password
                </h2>

                <p className="mt-1 text-sm text-gray-600">
                    Ensure your account is using a long, random password to stay
                    secure.
                </p>
            </header>

            <form onSubmit={updatePassword} className="mt-6 w-1/2">
                <div>
                    <InputLabel
                        htmlFor="current_password"
                        value="Password saat ini"
                    />

                    <input
                        id="current_password"
                        ref={currentPasswordInput}
                        value={data.current_password}
                        onChange={(e) =>
                            setData("current_password", e.target.value)
                        }
                        type="password"
                        className={`mt-3 w-full input ${
                            errors.current_password
                                ? "input-error text-error"
                                : "input-primary text-curious-blue"
                        }`}
                        autoComplete="current-password"
                    />

                    <InputError
                        message={errors.current_password}
                        className="mt-1"
                    />
                </div>

                <div>
                    <InputLabel htmlFor="password" value="Password baru" />

                    <input
                        id="password"
                        ref={passwordInput}
                        value={data.password}
                        onChange={(e) => setData("password", e.target.value)}
                        type="password"
                        className={`mt-3 w-full input ${
                            errors.password
                                ? "input-error text-error"
                                : "input-primary text-curious-blue"
                        }`}
                        autoComplete="new-password"
                    />

                    <InputError message={errors.password} className="mt-1" />
                </div>

                <div>
                    <InputLabel
                        htmlFor="password_confirmation"
                        value="Konfirmasi password"
                    />

                    <input
                        id="password_confirmation"
                        value={data.password_confirmation}
                        onChange={(e) =>
                            setData("password_confirmation", e.target.value)
                        }
                        type="password"
                        className={`mt-3 w-full input ${
                            errors.password_confirmation
                                ? "input-error text-error"
                                : "input-primary text-curious-blue"
                        }`}
                        autoComplete="new-password"
                    />

                    <InputError
                        message={errors.password_confirmation}
                        className="mt-1"
                    />
                </div>

                <div className="flex items-center gap-4">
                    <button
                        className="btn btn-primary text-white"
                        disabled={processing}
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </section>
    );
}
