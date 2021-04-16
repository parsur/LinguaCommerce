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

    @media screen and (min-width: 1060px) {
        display: none;
    }
`

export const FaBarsIcon = styled(FaBars)`
    display: unset;

    @media screen and (min-width: 1060px) {
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

    @media screen and (max-width: 1060px) {
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
    background: ${props => props.active ? '#F4DD4F' : 'transparent' && props.user ? '#eeeeee90' : 'transparent'};

    @media screen and (max-width: 1060px) {
        display: none;
    }

    &:hover {
        padding: ${props => props.active ? '0 30px' : '0 24px'};
        background: ${props => props.active ? '#F4DD4F' : 'rgb(233, 233, 233)'};
        transition: 0.3s;
    }
`

export const MenuLinkTops = styled.div`
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
    background: ${props => props.active ? '#F4DD4F' : 'transparent' && props.user ? '#eeeeee90' : 'transparent'};
    cursor: pointer;

    @media screen and (max-width: 1060px) {
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

export const MenuLinks = styled.div`
    text-decoration: none;
    margin: auto auto;
    font-size: 25px;
    color: #4e4e4e;
    border-radius: 10px;
    padding: 3px 30px 0 30px;
    cursor: pointer;
    background: ${props => props.active ? '#e6d14b' : 'transparent'};
`

export const ModalBlock = styled.div`
    width: 100%;
    padding: 20px 5px;
    background: #fff;
    margin-bottom: 10px;
    display: flex;
    justify-content: center;
    border-radius: 10px;
`

export const ModalLeft = styled.div`
    padding: 0 5px;
    font-size: 1.2rem;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
`

export const ModalRight = styled.div`
    width: 100%;
`

export const ModalHeader = styled.div`
    width: 100%;
    padding: 20px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
`

export const NoOrder = styled.h1`
    width: 50%;
    margin: 0 auto;
    font-size: 3rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: white;
    color: red;
    border-radius: 10px;
`

export const Verify = styled.button`
    padding: 5px;
    background: green;
    color: white;
    margin: 10px auto;
    border-radius: 10px;
    border: none;
    padding: 10px 50px;
    cursor: pointer;
`