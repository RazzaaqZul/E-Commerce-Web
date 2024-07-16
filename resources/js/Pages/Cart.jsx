import { router } from "@inertiajs/react";
import React from "react";

const Cart = ({ products }) => {
    const handleDelete = (cart_id) => {
        router.delete(`/users/carts/${cart_id}`, {
            onError: () => {
                confirm("error");
            },
        });

        console.log(cart_id);
    };
    console.log(products);
    return (
        <>
            <main>
                <h1>Your Carts</h1>

                <section className="flex flex-col justify-center items-center gap-5">
                    {products.map(
                        ({ cart_id, detail, subtotal, quantity }, index) => (
                            <div className="flex justify-center items-center gap-5 bg-green-200 rounded-lg p-3">
                                <section>
                                    <h1>Nama Produk: {detail.name}</h1>
                                    <h3>quantity : {quantity}</h3>
                                    <h2>Total : Rp.{subtotal}</h2>
                                </section>

                                <section>
                                    <button
                                        className="bg-red-400 p-2 rounded-lg hover:bg-red-100 duration-100"
                                        onClick={() => handleDelete(cart_id)}
                                    >
                                        DELETE
                                    </button>
                                </section>
                            </div>
                        )
                    )}
                </section>
            </main>
        </>
    );
};

export default Cart;
