import React, { useEffect, useState } from "react";
import { Head, router } from "@inertiajs/react";

const Resgister = ({ error }) => {
    const [data, setData] = useState({
        email: "faraub@gmail.com",
        username: "fara123",
        password: "rahasia",
        fullname: "fara ahmad",
        gender: "male",
        address: "bekasi",
    });
    const [isError, setIsError] = useState(error);

    console.log(error);

    useEffect(() => {
        setIsError(error?.message);
    }, [error]);

    const handleChange = (e) => {
        const key = e.target.id;
        const value = e.target.value;
        setData((data) => ({
            ...data,
            [key]: value,
        }));
        setIsError(null);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(data);
        router.post("/register", data);
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
                            value={data.email}
                            onChange={handleChange}
                            required
                            autoFocus
                            className="form-input rounded-xl mt-1 block w-full"
                        />
                    </div>

                    <div className="mb-4">
                        <label htmlFor="email" className="block text-gray-700">
                            Username
                        </label>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            value={data.username}
                            onChange={handleChange}
                            required
                            autoFocus
                            className="form-input rounded-xl mt-1 block w-full"
                        />
                    </div>

                    <div className="mb-4">
                        <label htmlFor="email" className="block text-gray-700">
                            Fullname
                        </label>
                        <input
                            id="fullname"
                            type="text"
                            name="fullname"
                            value={data.fullname}
                            onChange={handleChange}
                            required
                            autoFocus
                            className="form-input rounded-xl mt-1 block w-full"
                        />
                    </div>

                    <div className="mb-4 w-full">
                        <label htmlFor="gender" className="block text-gray-700">
                            Gender
                        </label>
                        <select
                            id="gender"
                            name="gender"
                            value={data.gender}
                            onChange={handleChange}
                            required
                            autoFocus
                            className="form-select rounded-xl mt-1 block w-full"
                        >
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div className="mb-4">
                        <label htmlFor="email" className="block text-gray-700">
                            Address
                        </label>
                        <input
                            id="address"
                            type="text"
                            name="address"
                            value={data.address}
                            onChange={handleChange}
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
                            value={data.password}
                            onChange={handleChange}
                            required
                            className="form-input rounded-xl mt-1 block w-full"
                        />
                    </div>

                    <div className="text-center">
                        <button
                            type="submit"
                            className="bg-blue-500 hover:bg-blue-700 duration-150 text-white font-bold py-2 px-4 rounded-xl"
                        >
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </>
    );
};

export default Resgister;
