import styled from 'styled-components';
import { FaBars } from 'react-icons/fa';
import { AiOutlineClose } from 'react-icons/ai';
import { Link } from 'react-router-dom';

export const Navbar = styled.div`
    background-color: #fff;
    height: 80px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 20px;
    border-bottom: 1px solid #060b26;
`

export const NavLink = styled(Link)`
    margin-left: 2rem;
    font-size: 2rem;
    background: none;
    color: #4e4e4e;

    @media screen and (min-width: 900px) {
        display: none;
    }
`

export const FaBarsIcon = styled(FaBars)`
    display: unset;

    @media screen and (min-width: 900px) {
        display: none;
    }
`

export const NavUl = styled.ul`
    width: 100%;
`

export const NavLi = styled.li`
    background-color: rgb(233, 233, 233);
    width: 100%;
    height: 80px;
    display: flex;
    justify-content: start;
    align-items: center;
`

export const AiClose = styled(AiOutlineClose)`
    margin-left: 160px;
`

export const MenuLiTop = styled.li`
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 8px 0 8px 0;
    list-style: none;
    height: 60px;
    width: auto;

    @media screen and (max-width: 900px) {
        display: none;
    }
`

export const MenuLinkTop = styled(Link)`
    text-decoration: none;
    color: #4e4e4e;
    font-size: 18px;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    padding: 0 24px;
    border-radius: ${props => props.active ? '0 20px 20px 0' : 'none'};
    border-radius: ${props => props.last ? '20px 0 0 20px' : 'none'};
    transition: 0.3s;
    background: ${props => props.active ? '#F4DD4F' : 'transparent'};

    @media screen and (max-width: 900px) {
        display: none;
    }

    &:hover {
        padding: ${props => props.active ? '0 30px' : '0 24px'};
        background: ${props => props.active ? '#F4DD4F' : 'rgb(233, 233, 233)'};
        transition: 0.3s;
    }
`

export const MenuLi = styled.li`
    list-style-type: none;
    height: 65px;
    width: 100%;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
`

export const MenuLink = styled(Link)`
    text-decoration: none;
    margin: auto auto;
    font-size: 25px;
    color: #4e4e4e;
    border-radius: 10px;
    padding: 3px 30px 0 30px;
    background: ${props => props.active ? '#e6d14b' : 'transparent'};
`