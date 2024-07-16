import React, { useEffect, useState } from "react";
import { Head, router } from "@inertiajs/react";
const Login = ({ errors }) => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [isError, setIsError] = useState();

    const handleSubmit = (e) => {
        e.preventDefault();
        router.post(
            "/login",
            {
                email,
                password,
            },
            {
                onSuccess: () => {},
                onError: () => setIsError(errors?.message),
            }
        );
    };

    return (
        <>
            <Head title="Login" />
            <div className="flex flex-col justify-center items-center full-height ">
                {isError && (
                    <>
                        <h1 className="text-red-500">{isError}</h1>
                    </>
                )}
                <form
                    method="POST"
                    onSubmit={handleSubmit}
                    className="flex flex-col justify-center items-center w-max "
                >
                    <div className="mb-4">
                        <label htmlFor="email" className="block text-gray-700">
                            Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value={email}
                            onChange={(e) => {
                                setEmail(e.target.value);
                                setIsError(null);
                            }}
                            required
                            autoFocus
                            className="form-input rounded-xl mt-1 block w-full"
                        />
                    </div>

                    <div className="mb-6">
                        <label
                            htmlFor="password"
                            className="block text-gray-700"
                        >
                            Password
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            value={password}
                            onChange={(e) => {
                                setPassword(e.target.value);
                                setIsError(null);
                            }}
                            required
                            className="form-input rounded-xl mt-1 block w-full"
                        />
                    </div>

                    <div className="text-center">
                        <button
                            type="submit"
                            className="bg-blue-500 hover:bg-blue-700 duration-150 text-white font-bold py-2 px-4 rounded-xl"
                        >
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </>
    );
};

export default Login;
