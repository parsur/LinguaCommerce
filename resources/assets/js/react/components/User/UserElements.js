import { Link } from 'react-router-dom';
import styled from 'styled-components';

export const Container = styled.div`
    width: 100%;
    height: 100%;
    background: #ffffff80;
`

export const MainContainer = styled.div`
    width: 1000px;
    height: 700px;
    background: #fff;
    margin: 55px auto;
    border-radius: 25px;
    display: flex;
    flex-direction: row;

    @media screen and (max-width: 1000px){
        width: 95%;
    }

    @media screen and (max-width: 500px){
        flex-direction: column-reverse;
        margin: 10px auto;
        width: 100%;
    }
`

export const Display = styled.div`
    height: 100%;
    width: 70%;
    border-radius: 25px 0 0 25px;
    padding: 20px 20px 0 20px;

    @media screen and (max-width: 500px){
        width: 100%;
    }
`

export const UserNavbar = styled.div`
    width: 30%;
    height: 100%;
    background: #F4DD4F;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 0 25px 25px 0;

    @media screen and (max-width: 500px){
        flex-direction: column-reverse;
        width: 100%;
        height: unset;
        border-radius: 0 0 25px 25px;
    }
`

export const ProfileContainer = styled.div`
    width: 85%;
    height: 180px;
    background: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 0 0 20px 20px;

    @media screen and (max-width: 500px){
        height: 150px;
        border-radius: 20px 20px 0 0;
        border-bottom: 2px solid #F4DD4F;
    }
`

export const Profile = styled.div`
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    align-items: center;
    cursor: pointer;
`

export const ProfileImg = styled.img`
    width: 60%;
    height: auto;

    @media screen and (max-width: 500px){
        display: none;
    }
`

export const ProfileTxt = styled.p`
    font-size: 20px;
    margin-top: 8px;

    @media screen and (max-width: 500px){
        width: 100%;
        height: 100%;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }
`

export const ItemContainer = styled.div`
    height: 100%;
    width: 85%;
    display: flex;
    flex-direction: column;
    margin-top: 10px;

    @media screen and (max-width: 500px){
        flex-direction: row-reverse;
        width: 100%;
    }
`

export const LinkContainer = styled(Link)`
    margin: 0 0 10px 0;
    width: 100%;
    height: auto;
    text-decoration: none;
    display: flex;
    justify-content: flex-end;
    font-size: 23px;
    color: #000;
    transition: 0.2s;
    padding: 10px 5px;
    border-radius: 15px;

    &:hover {
        background: #00000020;
        transition: 0.2s;
    }

    @media screen and (max-width: 500px){
        font-size: 18px;
        padding: 10px 1px;
    }

    @media screen and (max-width: 390px){
        font-size: 15px;
    }
`

export const Lp = styled.p`
    direction: rtl;
    margin-right: 8px;
`

export const Span = styled.span`
    @media screen and (max-width:500px){
        display: none;
    }
`