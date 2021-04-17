import styled from 'styled-components';
import AboutBgImg from '../../images/aboutusbg.png';

export const AboutContainer = styled.div`
    width: 100vw;
    height: 100%;
    background: url(${AboutBgImg});
    background-size: cover;
`

export const AboutBoxContainer = styled.div`
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
    align-items: center;
    justify-content: space-evenly;
`

export const AboutRowOne = styled.div`
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    align-items: flex-start;
    flex-wrap: wrap;
    margin: 25px 0;
`

export const AboutRowTwo = styled.div`
    width: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-evenly;
    margin: 25px 0 50px 0;
`

export const BoxTopOne = styled.div`
    height: 350px;
    width: 700px;
    background: #f7e172;
    margin: 10px 0 10px 18vw;
    padding: 13px;

    @media screen and (max-width: 924px) {
        margin: 0 auto;
    }
    @media screen and (max-width: 770px) {
        width: 90vw;
    }
`

export const BoxBottomOne = styled.div`
    display: flex;
    flex-direction: column;
    width: auto;
    height: 100%;
    flex-wrap: wrap;
`

export const BoxBottomTwo = styled.div`
    display: flex;
    flex-direction: column;
    height: 100%;
    align-items: flex-end;
    justify-content: flex-end;
    flex-wrap: wrap;

    @media screen and (max-width: 924px) {
        margin: 40px auto;
    }
`

export const SmallerBox = styled.div`
    width: 600px;
    height: 250px;
    background: transparent;
    padding: 15px;

    @media screen and (max-width: 677px) {
        width: 90vw;
    }

    @media screen and (max-width: 900px) {
        display: none;
    }
`

export const BoxImgContainer = styled.div`
    display: flex;
    flex-direction: row;
    justify-content: center;
`

export const BoxImg = styled.img`
    width: 35vw;
    height: auto;
    margin: 0 0 -10px 0;
    @media screen and (max-width: 924px) {
        width: 80vw;
    }
`

export const H3 = styled.h3`
    direction: rtl;
    font-size: 20px;
    margin-bottom: 10px;
`

export const P = styled.p`
    direction: rtl;
`