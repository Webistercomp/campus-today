import InputError from "@/Components/InputError";
import { Head, Link, useForm } from "@inertiajs/react";
import { useEffect } from "react";
import CTIcon from "@/images/ct_ 2.png";
import IllusAuth from "@/images/illus-auth.png";
import EnvelopeIcon from "@/icons/EnvelopeIcon";
import TextInput from "@/Components/TextInput";
import LockIcon from "@/icons/LockIcon";

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        email: "",
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

        post(route("register"));
    };

    return (
        <>
            <Head title="Sign Up" />
            <div className="font-poppins lg:text-base block lg:flex h-screen overflow-clip">
                <div className="md:w-fit md:mx-auto lg:basis-3/5 px-4 lg:pl-14 xl:pl-36">
                    <Link href="/">
                        <img
                            src={CTIcon}
                            alt="Ct-icon"
                            className="aspect-auto w-24 lg:w-36 xl:w-48 mb-4 mx-auto lg:ml-0"
                        />
                    </Link>
                    <div className="max-w-md xl:max-w-xl xl:mt-8">
                        <h1 className="font-semibold text-2xl text-center lg:text-left lg:text-3xl xl:text-4xl">
                            Sign Up
                        </h1>
                        <p className="mt-2 lg:mt-2 xl:mt-6 text-sm lg:text-base xl:text-xl">
                            if you already have an account, you can{" "}
                            <Link
                                href={route("login")}
                                className="text-primary hover:underline"
                            >
                                Login here
                            </Link>
                        </p>
                        <form
                            onSubmit={submit}
                            className="mt-6 lg:mt-4 flex flex-col gap-0 lg:gap-0 xl:gap-8"
                        >
                            <div className="flex flex-col mb-4">
                                <label
                                    htmlFor="username"
                                    className="text-slate-400"
                                >
                                    Username
                                </label>
                                <TextInput
                                    id="username"
                                    icon={<EnvelopeIcon />}
                                    placeholder="Enter your username"
                                    type="text"
                                    isFocused={true}
                                    value={data.name}
                                    onChange={(e) =>
                                        setData("name", e.target.value)
                                    }
                                />
                            </div>

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
                                    value={data.password}
                                    onChange={(e) =>
                                        setData("password", e.target.value)
                                    }
                                />

                                <InputError
                                    message={errors.password}
                                    className="mt-2"
                                />
                            </div>

                            <div className="flex flex-col">
                                <label
                                    htmlFor="password_confirmation"
                                    className="text-slate-400"
                                >
                                    Confirm Password
                                </label>
                                <TextInput
                                    id="password_confirmation"
                                    icon={<LockIcon />}
                                    placeholder="Enter your email address"
                                    type="password"
                                    value={data.password_confirmation}
                                    onChange={(e) =>
                                        setData(
                                            "password_confirmation",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>

                            <button
                                type="submit"
                                className="btn btn-primary text-white rounded-full shadow-lg mt-8"
                                disabled={processing}
                            >
                                Register
                            </button>
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
