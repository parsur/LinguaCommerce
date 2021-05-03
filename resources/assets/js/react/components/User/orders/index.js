import React, { useState, useEffect } from 'react';
import {
    Container,
    Block,
    BBlock,
    Bbutton,
    ODBlock,
    Wrap,
    WrapText
} from './OrderElements';
import Loader from "react-loader-spinner";
import apiAxios from '../../../axios';
import Modal from 'react-modal';
import { RiDeleteBin6Line } from 'react-icons/ri';
import axios from 'axios';

Modal.setAppElement("#app");

const Orders = () => {
    
    const [order, setOrder] = useState(null);
    const [modalOpen, setModalOpen] = useState(false);
    const [orderDetails, setOrderDetails] = useState([]);
    const [orderCourses, setOrderCourses] = useState([]);
    const [summery, setSummery] = useState([]);

    useEffect(() => {
      apiAxios('/order/showOrder')
      .then(function (response) {
        setOrder(response.data.orders);
      })
      .catch(function (error) {
        console.log(error);
      })
    }, []);
    
    function getDetails(factor){
      apiAxios(`/order/details?factor=${factor}`)
      .then(function (response) {
        setOrderDetails(response.data);
        setOrderCourses(response.data.orderCourses);
        setSummery(response.data.order);
        setModalOpen(true);
      })
      .catch(function (error) {
        console.log(error);
      })
    }

    function noOrders(){
      if(order == 0){
        return(
          <div style={{
            marginTop:"20px",
            background:"lime",
            borderRadius:"10px",
            padding:"10px"
          }}>سفارش ثبت شده ای برای شما وجود ندارد</div>
        )
      }
    }

    function handleBg(statuses){
      if(statuses.status == 0){
        return {borderRight:"5px solid red"}
      } else if(statuses.status == 1){
        return {borderRight:"5px solid lightgreen"}
      }
    }

    function handleBought(course){
      if(orderDetails.order.statuses.status == 1){
        return(<>
          <hr style={{border:"1px solid gray",width:"100px", margin:"10px 0"}}/>
          <h3><span style={{color:"gray"}}></span> <h3 style={{color:"gray"}}>لینک دریافت دوره</h3></h3>
          {course.files.map(({title, url}, i) => {
            return (
              <>
              <hr style={{border:"2px solid white",width:"220px", margin:"10px 0"}}/>
              <h3>{title}</h3>
              <a href={url}>دانلود</a>
              </>
            )
          })}
          </>
        )
      }
    }

    function handlePay(id){
      axios.post('/api/v1/order/completeUnpaidOrder', {
          id: id
      }, {
          headers: {
            'api_key': 'parsur',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
          }
        }
      ).then(function (response) {
          window.location.replace(`${response.data.action}`);
      })
      .catch(function (error) {
          console.log(error);
      })
    }

    function handleButton(statuses, factor, id){
      if(statuses.status == 0){
        return <BBlock><h3 onClick={()=>handlePay(id)} style={{color:"red"}}>پرداخت سفارش</h3></BBlock>
      } else if(statuses.status == 1){
        return <BBlock><Bbutton onClick={()=>getDetails(factor)}>جزیات سفارش</Bbutton></BBlock>
      }
    }

    function handleDeleteShop(id){
      apiAxios(`/order/delete/${id}`)
      .then(function (response) {
        window.location.reload(false);
      })
      .catch(function (error) {
        console.log(error);
      })
    }

    return order ? (
          <Container>
            <div style={orderCourses ? {display:"unset"} : {display:"none"}}>
            <Modal style={{overlay:{zIndex:"25"}}} isOpen={modalOpen} onRequestClose={()=>setModalOpen(false)}>
              <h2 style={{textAlign:"center",marginBottom:"20px",fontSize:"2rem"}}>جزیات سفارش</h2>
              {orderCourses.map(({course}, i) => {
                return (
                  <ODBlock key={i}>
                    <h3><span style={{color:"gray"}}>دوره :</span> <a style={{textDecoration:"none"}} href={`/course/${course.id}`}>{course.name}</a></h3>
                    {handleBought(course)}
                  </ODBlock>
                )
              })}
              <ODBlock style={{background:"#eee", marginTop:"20px"}}>
                <Wrap>
                  <WrapText>فاکتور: {summery.factor}</WrapText>
                  <WrapText>قیمت کل: {summery.total_price}</WrapText>
                </Wrap>
              </ODBlock>
            </Modal>
            </div>
            <h1 style={{margin:"10px 0", color:"darkcyan"}}>سفارش های شما</h1>
            {noOrders(order)}
            {order.map(({ total_price ,factor, statuses, id}, i) => {
              return <Block style={handleBg(statuses)} key={i}>
                
                <BBlock>فاکتور: {factor}</BBlock>

                <BBlock>قیمت کل: {total_price} تومان</BBlock>

                {handleButton(statuses, factor, id)}

                <div style={statuses.status == 0 ? {display:"unset",width:"100%"} : {display:"none"}}>
                  <BBlock style={{color:"#800000",fontWeight:"bold",cursor:"pointer"}}><span onClick={()=>handleDeleteShop(id)}><RiDeleteBin6Line/> حذف سفارش</span></BBlock>
                </div>

              </Block>
            })}
          </Container>
    ) : (
      <>
        <div style={{width:"100%", height:"100%", background:"#fff", display:"flex"}}>
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
