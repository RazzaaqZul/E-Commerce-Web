import { Head, Link, router } from "@inertiajs/react";
import moment from "moment-timezone";
import React, { useEffect, useState } from "react";

const DetailProduct = ({ detailProduct }) => {
    const [detail, setDetail] = useState(detailProduct);
    const [quantity, setQuantity] = useState(0);
    const [price, setPrice] = useState(0);
    const [modal, setModal] = useState(false);

    useEffect(() => {
        if (detail.length > 0) {
            setPrice(quantity * detail[0].price);
        }
    }, [quantity, detail]);

    const handleIncrease = () => {
        if (quantity < detail[0].stock) {
            setQuantity(quantity + 1);
        } else {
            setQuantity(detail[0].stock);
        }
    };

    const handleDecrease = () => {
        if (quantity > 0) {
            setQuantity(quantity - 1);
        }
    };

    const handleOrder = () => {
        const currentDate = moment().tz("Asia/Jakarta");
        const formattedDate = currentDate.format("YYYY-MM-DD HH:mm:ss");

        router.post("/users/orders", {
            order_date: formattedDate,
            status: false,
        });

        setModal(true);
    };

    const handleCheckOut = () => {
        router.post(
            `/users/carts`,
            {
                id_product: detail[0].id_product,
                quantity,
                subtotal: price,
            },
            {
                replace: false,
                onBefore: () => confirm("Apa anda yakin ingin Checkout"),
                onError: () => {
                    confirm("error");
                },
                onSuccess: () => {
                    router.get("/users/carts");
                },
            }
        );
    };
    return (
        <>
            <Head title="Product Detail" />
            <main className="flex flex-col gap-10">
                {detail.map(
                    (
                        { id_product, name, price, stock, description },
                        index
                    ) => (
                        <div
                            className="bg-gray-300 rounded-xl p-10"
                            key={index}
                        >
                            <h1 className="text-xl font-bold">{name}</h1>
                            <h2 className="text-lg font-semibold mb-2">
                                {price}
                            </h2>
                            <h2>{stock}</h2>
                            <p>{description}</p>
                        </div>
                    )
                )}

                <section className="flex flex-row justify-center items-center gap-8">
                    <button
                        className="bg-blue-500 p-7 font-bold text-2xl rounded-full"
                        onClick={handleIncrease}
                    >
                        +
                    </button>
                    <h1 className="text-2xl">{quantity}</h1>
                    <button
                        className="bg-red-500 p-7 font-bold text-2xl rounded-full"
                        onClick={handleDecrease}
                    >
                        -
                    </button>
                </section>

                <aside className="flex justify-center items-center">
                    <h1 className="text-2xl font-bold">{price}</h1>
                </aside>
                <section className="flex justify-center items-center">
                    <button
                        className="bg-green-400 p-4 rounded-xl font-bold"
                        onClick={handleCheckOut}
                    >
                        Checkout
                    </button>
                </section>
            </main>
        </>
    );
};

export default DetailProduct;
