import styled from 'styled-components';

export const Container = styled.div`
    display: flex;
    width: 100%;
    background: #fff;
    z-index: 1;
    direction: rtl;

    @media screen and (max-width: 770px) {
        flex-direction: column;
        align-items: center;
    }
`

export const Left = styled.div`
    width: 400px;
    display: flex;
    flex-direction: column;
    margin-bottom: -20px;

    @media screen and (max-width: 770px) {
        width: 90%;
    }
`

export const Sticky = styled.div`
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 1;
`

export const Right = styled.div`
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    padding: 2vw 0;
`

export const Top = styled.div`
    width: 100%;
    height: 60vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;

    @media screen and (max-width: 770px) {
        height: 300px;
    }
`

export const TContainer = styled.div`
    width: 90%;
    padding: 20px 10px;
    height: 95%;
    background: #F4DD4F;
    border-radius: 0 0 25px 25px;
`

export const Bottom = styled.div`
    width: 100%;
    height: 40vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;

    @media screen and (max-width: 770px) {
        height: 35vh;
        justify-content: center;
    }
`

export const Img = styled.img`
    width: auto;
    height: 100%;
`

export const H1 = styled.h1`
    font-size: clamp(2rem, 3vw, 2.5rem);
`

export const P = styled.p`
    font-size: clamp(1rem, 2vw, 1.5rem);
`

export const SearchContainer = styled.div`
    width: 100%;
    height: 70px;
    margin-bottom: 10px;
    background: #fff;
    border-radius: 0 0 20px 20px;
    margin-top: -20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
`

export const Search = styled.input`
    width: 80%;
    height: 30px;
    border-radius: 5px;
    border: 1px solid black;
    padding: 0 10px;
`

export const Block = styled.div`
    width: 500px;
    height: 300px;
    background: #F4DD4F;
    margin: 10px 0;
    display: flex;
    flex-direction: column;

    @media screen and (max-width: 500px) {
        width: 95%;
    }
`

export const TopB = styled.div`
    width: 100%;
    height: 25%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    background: #ffffff50;
    justify-content: space-around;
`

export const BottomB = styled.div`
    width: 100%;
    height: 75%;
    display: flex;
`

export const Price = styled.h2`
    direction: rtl;
    color: darkgreen;
`

export const Cname = styled.h1`
    direction: rtl;
    font-size: 35px;
`

export const RightB = styled.div`
    // height is 225px :)
    width: 46%;
    background: #eee; //remove
`

export const LeftB = styled.div`
    width: 54%;
`