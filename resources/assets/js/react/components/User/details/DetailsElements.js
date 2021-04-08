import styled from 'styled-components';

export const Container = styled.div`
    display: flex;
    width: 100%;
    height: 100%;
    flex-direction: column;
`

export const NameContainer = styled.div`
    width: 100%;
    height: 30%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    @media screen and (max-width: 500px){
        display: none;
    }
`

export const DetailContainer = styled.div`
    width: 100%;
    height: 70%;
    background: rgb(249, 249, 249);
    border-radius: 25px 25px 0 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    @media screen and (max-width: 500px){
        height: 100%;
    }
`

export const H1 = styled.h1`
    direction: rtl;
    font-size: clamp(2.5rem, 4vw, 3rem);
`

export const Detail = styled.div`
    width: 90%;
    height: 100%;
`

export const D1 = styled.div`
    width: 100%;
    height: 33.33%;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    flex-wrap: wrap;
`

export const D2 = styled.div`
    width: 100%;
    height: 33.33%;
    background: #ffffff;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    flex-wrap: wrap;
    border-radius: 30px;
`

export const D3 = styled.div`
    width: 100%;
    height: 33.33%;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    flex-wrap: wrap;
`

export const Email = styled.h3`
    direction: rtl;
`

export const Number = styled.h3`
    direction: rtl;
`

export const Created = styled.h3`
    direction: rtl;
    font-size: clamp(1.3rem, 1vw, 1.5vw);
`

export const Edited = styled.h3`
    direction: rtl;
    font-size: clamp(1.3rem, 1vw, 1.5vw);
`

export const Button = styled.button`
    width: 200px;
    height: 50px;
    background: #f0d20f;
    border: none;
    font-size: 18px;
    transition: 0.3s;
    color: #ffffff;

    &:hover {
        background: #F4DD4F;
        transition: 0.3s;
        color: #000000;
        border-radius: 20px;
    }
`