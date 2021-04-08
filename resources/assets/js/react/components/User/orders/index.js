import React, { useState, useEffect } from 'react';
import {
    Container,
    Block,
    Hr,
    BBlock
} from './OrderElements';
import api from '../../../api';
import Loader from "react-loader-spinner";

const Orders = ({}) => {
    
    const [order, setOrder] = useState(null);

    useEffect(() => {
        api("api/order/showOrder")
            .then(({ orders }) => {
                setOrder(orders);
            })
    }, []);


    return order ? (
        <>
          <Container>
            <h1 style={{margin:"10px 0", color:"darkcyan"}}>سفارش های شما</h1>

            {order.map(({ id, course: {name}, course: {price} ,factor}, i) => {
              return <Block key={i}>
                
                <BBlock>دوره: {name}</BBlock>

                <BBlock>قیمت دوره: {price}</BBlock>

                <BBlock>فاکتور: {factor}</BBlock>

                <BBlock>شماره سفارش: {id}</BBlock>

                <Hr></Hr>

              </Block>
            })}
          </Container>
        </>
    ) : (
      <>
        <div style={{width:"100%", height:"100%", display:"flex"}}>
            <Loader
            type="Oval"
            color="#F4DD4F"
            height={50}
            width={50}
            timeout={3000} //3 secs
            style={{margin: "auto"}}
            />
        </div>
      </>
    );
}

export default Orders;
