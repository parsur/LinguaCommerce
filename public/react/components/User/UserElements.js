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
`

export const Display = styled.div`
    height: 100%;
    width: 70%;
    border-radius: 25px 0 0 25px;
    padding: 20px 20px 0 20px;
`

export const UserNavbar = styled.div`
    width: 30%;
    height: 100%;
    background: #F4DD4F;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 0 25px 25px 0;
`

export const ProfileContainer = styled.div`
    width: 85%;
    height: 180px;
    background: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 0 0 20px 20px;
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
`

export const ProfileTxt = styled.p`
    font-size: 20px;
    margin-top: 8px;
`

export const ItemContainer = styled.div`
    height: 100%;
    width: 85%;
    display: flex;
    flex-direction: column;
    margin-top: 10px;
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
`

export const Lp = styled.p`
    direction: rtl;
    margin-right: 8px;
`