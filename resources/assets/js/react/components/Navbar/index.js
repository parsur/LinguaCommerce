import React, { useState } from 'react';
import { FaShoppingBasket, FaUserCircle } from 'react-icons/fa';
import { AiFillHome } from 'react-icons/ai';
import { ImQuestion } from 'react-icons/im';
import { FiMessageSquare, FiPhoneCall } from 'react-icons/fi';
import { CgTranscript } from 'react-icons/cg';
import { SiMinds } from 'react-icons/si';
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
                            <MenuLinkTops user="true" last="true" to="/cart">
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
                                <FiMessageSquare />
                                <span style={{marginLeft: '16px'}}>درباره من</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/consultante'>
                                <FiPhoneCall />
                                <span style={{marginLeft: '16px'}}>مشاوره</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/whyme'>
                                <ImQuestion />
                                <span style={{marginLeft: '16px'}}>چرا من؟</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/articlelists'>
                                <CgTranscript />
                                <span style={{marginLeft: '16px'}}>مقاله ها</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/courselist'>
                                <SiMinds />
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
                                <SiMinds />
                                <span style={{marginLeft: '16px'}}>دوره ها</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/articlelists'>
                                <CgTranscript />
                                <span style={{marginLeft: '16px'}}>مقاله ها</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/whyme'>
                                <ImQuestion />
                                <span style={{marginLeft: '16px'}}>چرا من</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/consultante'>
                                <FiPhoneCall />
                                <span style={{marginLeft: '16px'}}>مشاوره</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/aboutus'>
                                <FiMessageSquare />
                                <span style={{marginLeft: '16px'}}>درباره من</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/userpage'>
                                <FaUserCircle />
                                <span style={{marginLeft: '16px'}}>حساب من</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLinks user="true" last="true" to="/cart">
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
