import styled from 'styled-components';

export const Imagebruh = styled.div`
    width: 100%;
    height: 100%;
`;

export const TopContainer = styled.div`
    width: 100%;
    height: 6vh;
    display: flex;
    flex-direction: row;
    background-color: transparent;
    flex-wrap: wrap;
    justify-content: space-around;
`

export const Filters = styled.div`
    display: flex;
    align-items: flex-start;
    flex-direction: column;
    border-radius: 10px;
    background: #9B9B9B;
    width: 65%;
    height: 4vh;
`

export const Search = styled.input`
    display: flex;
    align-items: flex-end;
    flex-direction: column;
    border-radius: 50vw;
    height: 4vh;
    width: 25%;
    border: none;
    direction: rtl;
    padding: 10px;
`

export const MiddleContainer = styled.div`
    width: 95%;
    height: 15vh;
    background: linear-gradient(to right, rgba(0,0,0,0.6), rgb(0, 0, 0, 0.1),
    rgba(0,0,0,0.1)), rgb(255, 255, 0);
    margin: 0 auto;
    border: 2px solid white;
    display: flex;
    flex-direction: row;
`

export const LeftContainer = styled.div`
    display: flex;
    flex-direction: column;
    width: 50%;
`

export const SearchResults = styled.h2`
    color: #fff;
    margin: auto auto;
    font-size: clamp(0.75rem, 3vw, 2.5rem);
`

export const RightContainer = styled.div`
    display: flex;
    flex-direction: column;
    width: 50%;
`

export const ModalH2 = styled.h2`
    color: #000;
    margin: auto auto;
    font-size: clamp(1rem, 4vw, 3rem);
`

export const ButtomContainer = styled.div`
    width: 95%;
    margin: 0 auto;
    margin-top: 1vh;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
`

export const ResultCol = styled.div`
    display: flex;
    flex-direction: column;
    width: 350px;
    justify-content: space-evenly;
`

export const ResultContainer = styled.div`
    width: 100%;
    margin: 1vh auto;
    height: 150px;
    background: #fff;
    display: flex;
    flex-direction: row;
`

export const ResultLeft = styled.div`
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
`

export const ResultImg = styled.img`
    width: 100%;
    height: 100%;
`

export const ResultRight = styled.div`
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    direction: rtl;
`

export const ResultH2 = styled.h2`
    color: #000;
    padding: 0 10px;
    padding-top: 5px;
`

export const Hr = styled.hr`
    width: 80%;
    margin: 0.5vh auto;
`

export const ResultP = styled.p`
    padding: 0 10px;
`

export const ButtonContainer = styled.div`
    width: 70%;
    margin: 1vh auto;
`

export const Button = styled.button`
    width: 100%;
    cursor: pointer;
    height: 5vh;
    border-radius: 15px;
    border: 2px solid orange;
    font-size: 20px;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    font-weight: bold;
    transition: 0.3s;

    &:hover {
        background: rgba(555, 555, 555, 0.5);
        border: 2px dotted black;
        color: #000;
        transition: 0.3s;
    }
`