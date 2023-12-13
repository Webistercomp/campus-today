import InputError from "@/Components/InputError";
import PublicLayout from "@/Layouts/PublicLayout";
import { Head, useForm } from "@inertiajs/react";

export default function ForgotPassword({ status }) {
    const { data, setData, post, processing, errors } = useForm({
        email: "",
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("password.email"));
    };

    return (
        <PublicLayout>
            <Head title="Forgot Password" />

            <section className="pt-28 pb-14 px-28">
                <div className="p-8 bg-white shadow-lg rounded-lg max-w-lg mx-auto">
                    <h1 className="text-3xl text-curious-blue font-semibold">
                        Forgot Password?
                    </h1>
                    <div className="mb-4 text-sm text-slate-500 mt-4">
                        Forgot your password? No problem. Just let us know your
                        email address and we will email you a password reset
                        link that will allow you to choose a new one.
                    </div>

                    {status && (
                        <div className="mb-4 font-medium text-sm text-green-600">
                            {status}
                        </div>
                    )}

                    <form onSubmit={submit}>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className={`input ${
                                errors.email
                                    ? "input-error text-error"
                                    : "input-primary text-curious-blue"
                            } w-full`}
                            autoFocus={true}
                            onChange={(e) => setData("email", e.target.value)}
                        />

                        <InputError message={errors.email} className="mt-2" />

                        <div className="flex items-center justify-end mt-4">
                            <button
                                className="btn btn-primary text-white"
                                disabled={processing}
                            >
                                Email Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </PublicLayout>
    );
}
