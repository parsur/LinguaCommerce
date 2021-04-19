import styled from 'styled-components';
import whymebg from '../../images/whymebg.png';

export const Container = styled.div`
    background: url(${whymebg});
    background-size: cover;
`

export const Main = styled.div`
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
`

export const Left = styled.div`
    width: 50%;
    height: 80vh;
    display: flex;
    flex-direction: column;

    @media screen and (max-width: 700px){
        width: 100%;
        height: auto;
    }
`

export const Right = styled.div`
    width: 50%;
    height: 80vh;
    display: flex;
    flex-direction: column;

    @media screen and (max-width: 700px){
        width: 100%;
        height: auto;
    }
`

export const Top = styled.div`
    width: 100%;
    height: 50%;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: flex-end;

    @media screen and (max-width: 700px){
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }
`

export const Bottom = styled.div`
    width: 100%;
    height: 50%;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: flex-start;
    @media screen and (max-width: 700px){
        align-items: center;
        justify-content: center;
    }
`

export const Filler = styled.div`
    width: 100%;
    height: 50%;

    @media screen and (min-width: 1700px){
        height: 40%;
    }
    @media screen and (max-width: 700px){
        display: none;
    }
`

export const ImgContainer = styled.div`
    width: 100%;
    height: 50%;
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;

    @media screen and (min-width: 1700px){
        height: 60%;
    }
    @media screen and (max-width: 700px){
        width: unset;
        height: unset;
        display: flex;
        flex-direction: column;
        justify-content: unset;
        align-items: unset;
        padding: 30px;
    }
`

export const TopContainer = styled.div`
    width: 80%;
    height: 30vh;
    overflow: scroll;
    display: flex;
    flex-direction: column;
    padding: 10px;
    text-align: justify;
    background: linear-gradient(0deg, rgba(244,221,79,0.3) 1%, rgba(14,0,255,0) 40%);
`

export const BottomContainer = styled.div`
    width: 80%;
    height: 30vh;
    overflow: scroll;
    text-align: justify;
    background: linear-gradient(0deg, rgba(244,221,79,0.3) 1%, rgba(14,0,255,0) 40%);
`

export const MB = styled.div`
    width: 90%;
    height: 90%;
    margin: 20px auto;
    display: flex;
    flex-direction: column;
    padding: 10px;
`

export const Img = styled.img`
    width: 100%;
    height: auto;

    @media screen and (max-width: 950px){
        width: auto;
        height: 70%;
    }
    @media screen and (max-width: 700px){
        height: 100%;
        width: 100%;
    }
`

export const H1 = styled.h1`
    direction: rtl;
    font-size: ${props => props.active ? 'clamp(1.5rem, 2.5vw, 2rem)' : 'clamp(2rem, 3vw, 2.5rem)'};
`

export const P = styled.p`
    direction: rtl;
    font-size: ${props => props.active ? "clamp(0.4rem, 2.9vw, 1.2rem)" : "clamp(0.2rem, 2.8vw, 1rem)"};
    font-weight: bold;

    @media screen and (max-width: 880px){
        font-size: clamp(0.2rem, 1.8vw, 1rem);
    }
    @media screen and (max-width: 700px){
        font-size: clamp(0.2rem, 2.8vw, 1rem);
    }
`

export const CKEditors = styled.div`
    width: 100%;
    height: 100%;
`