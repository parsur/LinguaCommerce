import styled from 'styled-components';

export const Container = styled.div`
    background: #ffffff80;
`

export const MainContainer = styled.div`
    width: 100%;
    height: 75vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
`

export const NotSignIn = styled.div`
    width: 90%;
    height: 90%;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
`

export const H1 = styled.h1`
    direction: rtl;
    font-size: 50px;
`

export const Hr = styled.hr`
    margin: 50px 0 50px 0;
    width: 500px;
    border: 1px solid #000;
`

export const Button = styled.button`
    height: 75px;
    width: 300px;
    font-size: 25px;
    background: darkcyan;
    border: none;
    color: #fff;
    transition: 0.5s;
    border-radius: 0 25px 25px 0;

    &:hover {
        width: 500px;
        transition: 0.5s;
        border-radius: 0 0 25px 25px;
    }
`