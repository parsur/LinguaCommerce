import React, { useState } from 'react';
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

function NavbarTwo() {
    const [condition, setCondition] = useState(false)
    const showNav = () => setCondition(!condition);
    return (
        <>
        <Navbar>
            <NavLink to='#'>
                <FaBarsIcon onClick={showNav} />
            </NavLink>
                        <MenuLiTop>
                            <MenuLinkTop last to='/reports'>
                                <span style={{marginLeft: '16px'}}>درباره</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/reports'>
                                <span style={{marginLeft: '16px'}}>مشاوره</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/reports'>
                                <span style={{marginLeft: '16px'}}>فروشگاه</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/reports'>
                                <span style={{marginLeft: '16px'}}>مقاله ها</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop to='/courselist'>
                                <span style={{marginLeft: '16px'}}>دوره ها</span>
                            </MenuLinkTop>
                        </MenuLiTop>
                        <MenuLiTop>
                            <MenuLinkTop active to='/'>
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
                                <span style={{marginLeft: '16px'}}>خانه</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/courselist'>
                                <span style={{marginLeft: '16px'}}>دوره ها</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/reports'>
                                <span style={{marginLeft: '16px'}}>مقاله ها</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/reports'>
                                <span style={{marginLeft: '16px'}}>فروشگاه</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/reports'>
                                <span style={{marginLeft: '16px'}}>مشاوره</span>
                            </MenuLink>
                        </MenuLi>
                        <MenuLi>
                            <MenuLink to='/reports'>
                                <span style={{marginLeft: '16px'}}>درباره</span>
                            </MenuLink>
                        </MenuLi>
            </NavUl>
            <nav className={condition ? 'nav-menu-filler active' : 'nav-menu-filler'} onClick={showNav}></nav>
        </nav>
        </>
    )
}

export default NavbarTwo;
