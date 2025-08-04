import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PublicLayout from "@/Layouts/PublicLayout";
import { Head, useForm } from "@inertiajs/react";
import { useEffect } from "react";

export default function ResetPassword({ token, email }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        token: token,
        email: email,
        password: "",
        password_confirmation: "",
    });

    useEffect(() => {
        return () => {
            reset("password", "password_confirmation");
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route("password.store"));
    };

    return (
        <PublicLayout>
            <Head title="Reset Password" />

            <section className="pt-28 pb-14">
                <div className=" max-w-lg mx-auto p-8 bg-white shadow-lg rounded-lg">
                    <h1 className="text-curious-blue font-semibold text-3xl">
                        Reset Password
                    </h1>
                    <form onSubmit={submit} className="mt-8">
                        <div>
                            <InputLabel htmlFor="email" value="Email" />

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value={data.email}
                                className={`input mt-2 ${
                                    errors.email
                                        ? "input-error text-error"
                                        : "input-primary text-curious-blue"
                                } w-full`}
                                autoComplete="username"
                                onChange={(e) =>
                                    setData("email", e.target.value)
                                }
                            />

                            <InputError
                                message={errors.email}
                                className="mt-2"
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="password" value="Password" />

                            <input
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                className={`input mt-2 ${
                                    errors.password
                                        ? "input-error text-error"
                                        : "input-primary text-curious-blue"
                                } w-full`}
                                autoComplete="new-password"
                                isFocused={true}
                                onChange={(e) =>
                                    setData("password", e.target.value)
                                }
                            />

                            <InputError
                                message={errors.password}
                                className="mt-2"
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel
                                htmlFor="password_confirmation"
                                value="Confirm Password"
                            />

                            <input
                                type="password"
                                name="password_confirmation"
                                value={data.password_confirmation}
                                className={`input mt-2 ${
                                    errors.password_confirmation
                                        ? "input-error text-error"
                                        : "input-primary text-curious-blue"
                                } w-full`}
                                autoComplete="new-password"
                                onChange={(e) =>
                                    setData(
                                        "password_confirmation",
                                        e.target.value
                                    )
                                }
                            />

                            <InputError
                                message={errors.password_confirmation}
                                className="mt-2"
                            />
                        </div>

                        <div className="flex items-center justify-end mt-4">
                            <button
                                className="btn btn-primary text-white"
                                disabled={processing}
                            >
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </PublicLayout>
    );
}
