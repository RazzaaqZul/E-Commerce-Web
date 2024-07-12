import { Head, usePage } from "@inertiajs/react";
import React, { useState } from "react";

const DetailOrder = ({ detailProduct, queryParams }) => {
    const [detail, setDetail] = useState(detailProduct);
    const { props } = usePage();
    const user = props.auth?.user;
    const { username, address, email, gender, fullname } = user;
    console.log(queryParams);

    return (
        <>
            <Head title="Order Detail" />
            <div className="full-height flex justify-center items-center gap-5 ">
                <aside className="bg-slate-400 rounded-md p-10">
                    <h1>Data Pemesan</h1>
                    <ul>
                        <li>username : {username}</li>
                        <li>email : {email}</li>
                        <li>fullname : {fullname}</li>
                        <li>gender : {gender}</li>
                        <li>alamat : {address}</li>
                    </ul>
                </aside>
                <main className="bg-red-200 p-7 rounded-xl">
                    <h1>Detail Product</h1>
                    <ul>
                        <li>Nama Product : {detail[0].name}</li>
                        <li>Jumlah total : {queryParams[0].price}</li>
                        <li>Kuantitas : {queryParams[0].quantity}</li>
                    </ul>
                </main>
            </div>
        </>
    );
};

export default DetailOrder;
