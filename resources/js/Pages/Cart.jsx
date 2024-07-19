import { router } from "@inertiajs/react";
import { filter } from "lodash";
import React, { useEffect, useState } from "react";

const Cart = ({ products }) => {
    const [selected, setSelected] = useState([]);
    const [totalPrice, setTotalPrice] = useState(0);
    const handleDelete = (cart_id, productId) => {
        router.delete(`/users/carts/${cart_id}/products/${productId}`, {
            onError: () => {
                confirm("error");
            },
        });

        console.log(cart_id);
    };

    const handleIsCheck = (e, cart_id, subtotal) => {
        if (e.target.checked) {
            setSelected([...selected, cart_id]);
            setTotalPrice((prev) => prev + subtotal);
        } else {
            const remove = selected.filter((item) => item !== cart_id);
            setSelected(remove);
            setTotalPrice((prev) => prev - subtotal);
        }
    };

    useEffect(() => {
        console.log(selected);
    }, [selected]);
    console.log(products);
    return (
        <>
            <main>
                <h1>Your Carts</h1>

                <section className="flex flex-col justify-center items-center gap-5">
                    {products.map(
                        ({ cart_id, detail, subtotal, quantity }, index) => (
                            <div className="flex justify-center items-center gap-5 bg-green-200 rounded-lg p-3">
                                <div>
                                    <input
                                        type="checkbox"
                                        id={cart_id}
                                        name={`cart-${cart_id}`}
                                        onChange={(e) =>
                                            handleIsCheck(e, cart_id, subtotal)
                                        }
                                    />
                                </div>
                                <section>
                                    <h1>Nama Produk: {detail.name}</h1>
                                    <h3>quantity : {quantity}</h3>
                                    <h2>Total : Rp.{subtotal}</h2>
                                </section>

                                <section>
                                    <button
                                        className="bg-red-400 p-2 rounded-lg hover:bg-red-100 duration-100"
                                        onClick={() =>
                                            handleDelete(cart_id, detail.id)
                                        }
                                    >
                                        DELETE
                                    </button>
                                </section>
                            </div>
                        )
                    )}
                </section>

                <section className="flex flex-col justify-center items-center mt-4 ">
                    <h1>Selected Item {selected.length}</h1>
                    <h1>Total Harga {totalPrice}</h1>
                    <button
                        className=" bg-sky-500 hover:bg-sky-200 p-4 rounded-lg disabled:bg-red-400"
                        disabled={selected == 0 ? true : false}
                    >
                        Order Now!
                    </button>
                </section>
            </main>
        </>
    );
};

export default Cart;
