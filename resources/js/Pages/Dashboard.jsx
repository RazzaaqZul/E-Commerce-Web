import React, { useEffect, useState } from "react";
import { Head, Link, router, usePage } from "@inertiajs/react";
// import { Inertia } from "@inertiajs/inertia";

const Dashboard = ({ dataProducts }) => {
    const [products, setProducts] = useState(dataProducts);
    const { props } = usePage();
    const username = props.auth.user.username;
    const address = props.auth.user.address;

    console.log(dataProducts);

    return (
        <>
            <Head title="Dashboard" />
            <h1 className="text-3xl font-bold underline">Welcome</h1>
            <p>Hello Dashboard</p>
            <p>Hello {username}</p>
            <div className="flex flex-row gap-2 justify-center ">
                {products.map(
                    (
                        { id_product, name, price, stock, description },
                        index
                    ) => (
                        <Link
                            href={`/users/products/${id_product}`}
                            method="get"
                            as="button"
                            key={index}
                        >
                            <div className="bg-gray-300 rounded-xl p-10">
                                <h1 className="text-xl font-bold">{name}</h1>
                                <h2 className="text-lg font-semibold mb-2">
                                    {price}
                                </h2>
                                <h2>{stock}</h2>
                                <p>{description}</p>
                            </div>
                        </Link>
                    )
                )}
            </div>
        </>
    );
};

export default Dashboard;
