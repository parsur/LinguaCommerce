import React, { useState } from 'react';
import { FaCartPlus, FaUserCircle } from 'react-icons/fa';
import { AiFillHome } from 'react-icons/ai';
import { IoIosPaper } from 'react-icons/io';
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
    MenuLink,
} from './NavbarElemnts';

function NavbarTwo(props) {
    const [condition, setCondition] = useState(false)
    const showNav = () => setCondition(!condition);
    return (
        <div style={props.style}>
        <Navbar>
            <NavLink to='#'>
                <FaBarsIcon onClick={showNav} />
            </NavLink>
                        <MenuLiTop>
                            <MenuLinkTop last to='/userpage'>
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
                            <MenuLinkTop to='/reports'>
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
                            <MenuLinkTop active to='/'>
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
                            <MenuLink active to='/'>
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
                            <MenuLink to='/reports'>
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
            </NavUl>
            <nav className={condition ? 'nav-menu-filler active' : 'nav-menu-filler'} onClick={showNav}></nav>
        </nav>
        </div>
    )
}

export default NavbarTwo;
