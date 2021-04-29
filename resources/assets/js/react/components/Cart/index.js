import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { IoMdCloseCircleOutline } from 'react-icons/io';
import Loader from 'react-loader-spinner';
import Navbar from '../Navbar';
import {
  Container,
  Main,
  Header,
  H2,
  Body,
  Block,
  BlockLeft,
  BlockRight,
  CourseName,
  Verify,
  NoOrder,
  PBlock,
  Pleft,
  Pright
} from './CartIndex';
import axiosApi from '../../axios';
import Particles from 'react-particles-js';
import { backStyleTwo, gifStyleTwo } from '../../Data';

const Cart = () => {

  const [orders, setOrders] = useState([]);
  const [isLoaded, setIsLoaded] = useState(false);
  const [count, setCount] = useState("");
  const [price, setPrice] = useState("");

  const token = 'parsur';

  useEffect(() => {
    axiosApi(`/cart/show`)
    .then(function (response) {
        setOrders(response.data.carts);
        setCount(response.data.count);
        setPrice(response.data.total_price);
        setIsLoaded(true);
    })
    .catch(function (error) {
        console.log(error);
    });
  }, []);

  function deleter(id){
      axiosApi(`/cart/delete/${id}`)
      .then(function (response) {
          window.location.reload(false);
      })
      .catch(function (error) {
          console.log(error);
      });
  }

  function submit(){
    axios.post('http://sararajabi.com/api/v1/order/store', {}, {
        headers: {
          'api_key': `${token}`,
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      }
    ).then(function (response) {
      if(response.data.action == undefined){
        
      } else {
        window.location.replace(`${response.data.action}`);
      }
    })
    .catch(function (error) {
        console.log(error.response);
        if(error.response.data.success === false){
          alert('شما بیشتر از 4 سفارش بدون پرداخت نمیتوانید داشته باشید')
        }
    });
  }

  function noCart(){
    if(orders == 0){
        return <NoOrder>سفارشی ندارید</NoOrder>
    }
  }

  return isLoaded ? (
    <>
    <Particles params={backStyleTwo} style={gifStyleTwo}/>
    <Navbar/>
    <Container>
      
      <Main>
        <Header>
          <H2>سبد خرید</H2>
        </Header>
        <Body>
        {noCart()}
        {orders.map(({course, id}, i) => {
          return (
              <Block key={i}>
                <BlockLeft onClick={()=>deleter(id)}>
                  <IoMdCloseCircleOutline/>
                </BlockLeft>
                <BlockRight>
                  <CourseName>
                    {course.name}
                  </CourseName>
                </BlockRight>
              </Block>
            )
        })}
          <PBlock style={(orders == 0) ? {display:"none"} : {display:"flex"}}>
            <Pleft>قیمت کل: {price} تومان</Pleft>
            <Pright>تعداد: {count}</Pright>
          </PBlock>
        <div style={(orders == 0) ? {display:"none"} : {display:"unset"}}>
          <Verify onClick={()=>submit()}>
            <h3 dir="rtl">
              نهایی کردن خرید
            </h3>
          </Verify>
        </div>
        </Body>
      </Main>
    </Container>
    </>
  ) : (
    <>
    <Particles params={backStyleTwo} style={gifStyleTwo}/>
    <Navbar/>
    <Container>
      <Main>
        <Header>
          <H2>سبد خرید</H2>
        </Header>
        <Body>
        <div style={{width:"100%", height:"100%", display:"flex"}}>
        <Loader
        type="Oval"
        color="#f4dd4f"
        height={150}
        width={150}
        timeout={3000} //3 secs
        style={{margin: "auto"}}
        />
        </div>
        </Body>
      </Main>
    </Container>
    </>
  )
}

export default Cart;
