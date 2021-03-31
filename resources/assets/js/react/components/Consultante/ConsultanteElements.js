import styled from 'styled-components';
import consbg from '../../images/consbg.svg';

export const Container = styled.div`
    background: #F4DD4F;
    width: 100%;
    height: 100%;
`

export const Main = styled.div`
    display: felx;
    flex-direction: row;
    width: 100%;
    height: 100%;
    min-height: 700px;
    flex-wrap: wrap;

    @media screen and (max-width: 555px){
        min-height: 100%;
    }
`

export const Left = styled.div`
    width: 70%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 700px;

    @media screen and (max-width: 555px){
        width: 100%;
        min-height: 100%;
    }
`

export const Right = styled.div`
    width: 30%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 700px;

    @media screen and (max-width: 555px){
        width: 100%;
        min-height: 100%;
    }
`

export const TextContainer = styled.div`
    height: 600px;
    width: 60vw;
    background: #fff;
    background-size: cover;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;

    @media screen and (max-width: 555px){
        width: 90%;
        margin-top: 20px;
    }
    @media screen and (min-width: 555px){
        align-items: center;
    }
    @media screen and (min-width: 1755px){
        align-items: center;
    }
`

export const Text = styled.div`
    height: 100%;
    width: 90%;
    padding: 40px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;

    @media screen and (min-width: 555px){
        align-items: center;
    }
`

export const ImgContainer = styled.div`
    height: 33.33%;
    width: 150%;
    margin-left: -50%;

    @media screen and (max-width: 555px){
        margin: -30px 0 50% 0;
        width: 100%;
    }
`

export const Img = styled.img`
    width: 100%;
    height: 100%;
`

export const H1 = styled.h1`
    direction: rtl;

    @media screen and (min-width: 555px){
        margin-left: 50px;
    }
`

export const Form = styled.form`
    display: flex;
    flex-direction: column;
    align-items: center;
    direction: rtl;

    @media screen and (min-width: 555px){
        align-items: center;
    }
`

export const Name = styled.input`
    width: 40vw;
    max-width: 580px;
    height: 40px;
    margin: ${props => props.active ? '50px 0' : '0 0 0 0'};
    border-radius: 10px;
    outline: none;
    border: 1px solid black;
    padding: 0 5px;
    font-size: 18px;

    @media screen and (max-width: 555px){
        width: 80vw;
    }
`

export const Area = styled.textarea`
    width: 40vw;
    max-width: 600px;
    resize: none;
    height: 70px;
    border-radius: 10px;
    outline: none;
    border: 1px solid black;
    padding: 0 5px;
    margin: ${props => props.active ? '50px 0' : '0 0 50px 0'};

    @media screen and (max-width: 555px){
        width: 80vw;
    }
`

export const Submit = styled.input`
    width: 40vw;
    max-width: 380px;
    height: 40px;
    border-radius: 5px;
    margin-top: 50px;
    outline: none;
    border: none;
    background: grey;
    color: white;
    font-size: 20px;

    @media screen and (max-width: 555px){
        width: 80vw;
    }
`

export const Block = styled.blockquote`
    background: #eee;
    padding: 1em;
    border-radius: 1em;
    margin: 50px 1em 0 1em;
    width: auto;
`