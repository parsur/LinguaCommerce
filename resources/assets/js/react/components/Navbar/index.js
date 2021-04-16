import React, { useEffect, useState } from 'react';
import { FaCartPlus, FaRemoveFormat, FaShoppingBasket, FaUserCircle } from 'react-icons/fa';
import { AiFillHome } from 'react-icons/ai';
import { IoIosPaper, IoMdClose, IoMdCloseCircle, IoMdCloseCircleOutline, IoMdRemoveCircleOutline } from 'react-icons/io';
import './Navbar.css'
import {
    Navbar,
    NavLink,
    FaBarsIcon,
    NavUl,
    NavLi,
    AiClose,
    MenuLiTop,
    MenuLi,
    MenuLinkTop,
    MenuLinkTops,
    MenuLink,
    MenuLinks,
    ModalBlock,
    ModalLeft,
    ModalRight,
    ModalHeader,
    NoOrder,
    Verify
} from './NavbarElemnts';
import Modal from 'react-modal';
import axios from 'axios';

Modal.setAppElement("#app");

const token = 'parsur';

function NavbarTwo(props) {
    const [condition, setCondition] = useState(false)
    const [modalOpen, setModalOpen] = useState(false)
    const [orders, setOrders] = useState([])
    const showNav = () => setCondition(!condition);

    useEffect(() => {
        axios.get('http://sararajabi.com/api/v1/cart/show', {
            headers: {
                'api_key': `${token}`,
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
          }
        ).then(function (response) {
            console.log(response);
            setOrders(response.data.carts);
        })
        .catch(function (error) {
            console.log(error);
        });
    }, []);

    function submit(){
        axios.post('http://sararajabi.com/api/v1/order/store', {}, {
            headers: {
              'api_key': `${token}`,
              'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
          }
        ).then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    function noCart(){
        if(orders == 0){
            return <NoOrder>سفارشی ندارید</NoOrder>
        }
    }

    return (
        <div style={props.style}>
            <Modal style={{
                overlay: {
                    direction:"rtl",
                    zIndex:"200",
                    transition:"0.3s"
                },
                content: {
                    padding:"0 5px",
                    background:"#F4DD4F",
                    display:"flex",
                    flexDirection:"column",
                    alignItems:"center",
                    transition:"0.3s"
                }
            }} onRequestClose={() => setModalOpen(false)} isOpen={modalOpen}>
                <ModalHeader>سبد خرید</ModalHeader>
                {noCart()}
                {orders.map(({course, id}, i) => {
                    return (
                        <>
                            <ModalBlock key="i">
                                <ModalRight>
                                    {course.name}
                                </ModalRight>
                                <ModalLeft onClick={() => {
                                    axios.get(`http://sararajabi.com/api/v1/cart/delete/${id}`, {
                                        headers: {
                                            'api_key': `${token}`,
                                            'Authorization': `Bearer ${localStorage.getItem('token')}`
                                        }
                                    }
                                    ).then(function (response) {
                                        console.log(response);
                                        window.location.reload(false);
                                        setModalOpen(true);
                                    })
                                    .catch(function (error) {
                                        console.log(error);
                                    });
                                }}>
                                    <IoMdCloseCircleOutline/>
                                </ModalLeft>
                            </ModalBlock>
                        </>
                    )
                })}
                <div style={(orders == 0) ? {display:"none"} : {display:"unset"}}>
                    <Verify onClick={()=>submit()}>
                        نهایی کردن خرید
                    </Verify>
                </div>
            </Modal>
        <Navbar>
            <NavLink to='#'>
                <FaBarsIcon onClick={showNav} />
            </NavLink>
                        <MenuLiTop>
                            <MenuLinkTops user="true" last="true" onClick={() => setModalOpen(true)}>
                                <FaShoppingBasket />
                                <span style={{marginLeft: '16px'}}>سبد خرید</span>
                            </MenuLinkTops>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop user="true" to='/userpage'>
                                <FaUserCircle />
                                <span style={{marginLeft: '16px'}}>حساب من</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/aboutus'>
                                <AiFillHome />
                                <span style={{marginLeft: '16px'}}>درباره</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/consultante'>
                                <AiFillHome />
                                <span style={{marginLeft: '16px'}}>مشاوره</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/whyme'>
                                <AiFillHome />
                                <span style={{marginLeft: '16px'}}>چرا من؟</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/articlelists'>
                                <IoIosPaper />
                                <span style={{marginLeft: '16px'}}>مقاله ها</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/courselist'>
                                <FaCartPlus />
                                <span style={{marginLeft: '16px'}}>دوره ها</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop active="true" to='/'>
                                <AiFillHome />
                                <span style={{marginLeft: '16px'}}>خانه</span>
                            </MenuLinkTop>
                        </MenuLiTop>
        </Navbar>
        <nav className={condition ? 'nav-menu active' : 'nav-menu'}>
            <NavUl onClick={showNav}>
                <NavLi>
                    <NavLink to='#'>
                        <AiClose />
                    </NavLink>
                </NavLi>
                        <MenuLi>
                            <MenuLink active="true" to='/'>
                                <AiFillHome />
                                <span style={{marginLeft: '16px'}}>خانه</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/courselist'>
                                <FaCartPlus />
                                <span style={{marginLeft: '16px'}}>دوره ها</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/articlelists'>
                                <IoIosPaper />
                                <span style={{marginLeft: '16px'}}>مقاله ها</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/whyme'>
                                <AiFillHome />
                                <span style={{marginLeft: '16px'}}>چرا من</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/consultante'>
                                <AiFillHome />
                                <span style={{marginLeft: '16px'}}>مشاوره</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/aboutus'>
                                <AiFillHome />
                                <span style={{marginLeft: '16px'}}>درباره</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/userpage'>
                                <FaUserCircle />
                                <span style={{marginLeft: '16px'}}>حساب من</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLinks user="true" last="true" onClick={() => setModalOpen(true)}>
                                <FaShoppingBasket />
                                <span style={{marginLeft: '16px'}}>سبد خرید</span>
                            </MenuLinks>
                        </MenuLi>
            </NavUl>
            <nav className={condition ? 'nav-menu-filler active' : 'nav-menu-filler'} onClick={showNav}></nav>
        </nav>
        </div>
    )
}

export default NavbarTwo;
