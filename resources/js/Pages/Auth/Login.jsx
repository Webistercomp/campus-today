import InputError from "@/Components/InputError";
import { Head, Link, useForm } from "@inertiajs/react";
import { useEffect } from "react";
import CTIcon from "@/images/ct_ 2.png";
import IllusAuth from "@/images/illus-auth.png";
import EnvelopeIcon from "@/icons/EnvelopeIcon";
import TextInput from "@/Components/TextInput";
import LockIcon from "@/icons/LockIcon";
import FbIcon from "@/images/fb-icon.png";
import GoogleIcon from "@/images/google-icon.png";

export default function Login({ canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        password: "",
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset("password");
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route("login"));
    };

    return (
        <>
            <Head title="Sign In" />
            <div className="font-poppins lg:text-base block lg:flex h-screen overflow-y-clip">
                <div className="md:w-fit md:mx-auto lg:basis-3/5 px-4 lg:pl-14 xl:pl-36">
                    <Link href="/">
                        <img
                            src={CTIcon}
                            alt="Ct-icon"
                            className="aspect-auto w-24 lg:w-36 mb-4 mx-auto lg:ml-0"
                        />
                    </Link>
                    <div className="max-w-md xl:max-w-xl xl:mt-4">
                        <h1 className="font-semibold text-2xl text-center lg:text-left lg:text-3xl xl:text-4xl">
                            Sign In
                        </h1>
                        <p className="mt-2 lg:mt-2 xl:mt-4 text-sm lg:text-base xl:text-xl">
                            if you don't have an account, you can{" "}
                            <Link
                                href={route("register")}
                                className="text-primary hover:underline"
                            >
                                Register here
                            </Link>
                        </p>
                        <form
                            onSubmit={submit}
                            className="mt-6 lg:mt-4 flex flex-col gap-2 lg:gap-2 xl:gap-2"
                        >
                            <div className="flex flex-col">
                                <label
                                    htmlFor="email"
                                    className="text-slate-400"
                                >
                                    Email
                                </label>
                                <TextInput
                                    id="email"
                                    icon={<EnvelopeIcon />}
                                    placeholder="Enter your email address"
                                    type="email"
                                    isFocused={true}
                                    autoComplete="username"
                                    value={data.email}
                                    onChange={(e) =>
                                        setData("email", e.target.value)
                                    }
                                />

                                <InputError
                                    message={errors.email}
                                    className="mt-2"
                                />
                            </div>

                            <div className="flex flex-col">
                                <label
                                    htmlFor="password"
                                    className="text-slate-400"
                                >
                                    Password
                                </label>
                                <TextInput
                                    id="password"
                                    icon={<LockIcon />}
                                    placeholder="Enter your email address"
                                    type="password"
                                    autoComplete="current-password"
                                    value={data.password}
                                    onChange={(e) =>
                                        setData("password", e.target.value)
                                    }
                                />

                                <InputError
                                    message={errors.password}
                                    className="mt-2"
                                />

                                <div className="flex items-center justify-between gap-2 mt-2">
                                    <label className="label cursor-pointer flex items-center">
                                        <input
                                            type="checkbox"
                                            checked={data.remember}
                                            onChange={(e) =>
                                                setData(
                                                    "remember",
                                                    e.target.checked
                                                )
                                            }
                                            className="checkbox checkbox-primary"
                                        />
                                        <span className="label-text ml-2">
                                            Remember me
                                        </span>
                                    </label>
                                    {canResetPassword && (
                                        <Link
                                            href={route("password.request")}
                                            className="text-slate-500 text-sm hover:underline"
                                        >
                                            Forgot Password?
                                        </Link>
                                    )}
                                </div>
                            </div>

                            <button
                                type="submit"
                                className="btn btn-primary text-white rounded-full shadow-lg"
                                disabled={processing}
                            >
                                Login
                            </button>

                            <p className="text-center text-slate-400">
                                or continue with
                            </p>

                            <div className="flex gap-4 mx-auto">
                                <Link href="#">
                                    <img src={FbIcon} alt="facebook-icon" />
                                </Link>
                                <Link href="#">
                                    <img src={GoogleIcon} alt="google-icon" />
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
                <div className="basis-2/5 p-6 invisible lg:visible">
                    <div className="bg-[#000842] w-full min-h-full rounded-2xl flex items-start justify-center">
                        <img src={IllusAuth} alt="illustration" />
                    </div>
                </div>
            </div>
        </>
    );
}
