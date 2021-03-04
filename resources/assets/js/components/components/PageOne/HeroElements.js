import styled from 'styled-components';
import { CgLogIn } from 'react-icons/cg';

export const HeroContainer = styled.div`
    background: #064F7C;
`

export const HeroMainContainer = styled.div`
    background: #000;
    width: auto;
    margin: 0 40px;

    @media screen and (max-width: 500px) {
        margin: 0 10px;
    }
`

export const HeroTopContainer = styled.div`
    background: #F4DD4F;
    height: 80vh;
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;

    @media screen and (max-width: 500px) {
        flex-direction: column;
        justify-content: space-between;
    }
`

export const HeroIcons = styled.div`
    height: 20vh;
    width: 100%;
    background: #fff;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    flex-wrap: wrap;

    @media screen and (max-width: 500px) {
        height: 30vh;
    }
`

export const HeroWhiteBg = styled.div`
    background-color: #fff;
    z-index: 999;
    height: 20vh;
    width: 100%;
    background: #fff;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    flex-wrap: wrap;

    @media screen and (max-width: 500px) {
        height: auto;
    }
`

export const HeroLeftSide = styled.div`
    background: #fff;
    border-bottom: 70vh solid #fff;
	border-right: 100px solid #F4DD4F;
	height: 0;
	width: 55vw;
    display: flex;
    flex-direction: column;
    border-radius: 10px 0 0 10px;
    direction: rtl;
    z-index: 1;

    @media screen and (max-width: 610px) {
        margin-left: 10px;
    }

    @media screen and (max-width: 500px) {
        width: 0;
	    height: 200vh;
	    border-right: 80vw solid #fff;
	    border-bottom: 40px solid #F4DD4F;
        border-radius: 0 0 0 0;
        flex-direction: column;
    }
`

export const HeroRightSide = styled.div`
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 70vh;
    z-index: 2;
`

export const HeroLoginContainer = styled.div`
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    width: 100%;
    margin-top: 20px;
    align-items: right;

    @media screen and (max-width: 500px) {
        margin-right: -68vw;
        width: 100px;
    }
`

export const LogIn = styled.button`
    width: 15vw;
    height: auto;
    cursor: pointer;
    direction: rtl;
    text-align: center;
    font-size: clamp(1rem, 2vw, 1.2rem);
    min-width: 50px;
    background: #F4DD4F;
    border: none;
    color: #064F7C;
    border-radius: 5px 20px 5px 5px;
    margin-right: 20px;
    transition: 0.5s;
    display: flex;
    flex-direction: row;
    justify-content: space-around;

    &:hover {
        background: #064F7C;
        color: #F4DD4F;
        transform: scale(1.1);
        transition: 0.5s;
    }
    &:focus {
        outline: none;
    }

    @media screen and (max-width: 500px) {
        width: 100%;
    }
`

export const LoginCol = styled.div`
    display: flex;
`

export const LoginButton = styled.p`
    margin-right: auto 0;
    font-size: clamp(1.2rem, 2vw, 2rem);
`

export const LoginIcon = styled(CgLogIn)`
    margin: auto 5px;
    font-size: clamp(1.2rem, 2vw, 2rem);
`

export const HeroTextContainer = styled.div`
    display: flex;
    flex-direction: column;
    margin: 10vh 5vw;

    @media screen and (max-width: 500px) {
        margin: 3vh 40px;
        margin-right: -65vw;
    }
`

export const HeroP = styled.p`
    font-size: clamp(1rem, 1.8vw, 2.5rem);
    margin-bottom: 0.1vh;
`

export const HeroH1 = styled.h1`
    font-size: clamp(2rem, 2.5vw, 4rem);
    margin-bottom: 2vh;
`

export const HeroDesc = styled.p`
    font-size: clamp(0.7rem, 1.5vw, 2rem);
`

export const HeroTopButton = styled.div`
    background: transparent;
    width: 30vw;
    height: 10vh;

    @media screen and (max-width: 500px) {
        display: none;
    }
`

export const HeroMainLogo = styled.div`
    width: 25vw;
    height: 22vh;
    background: transparent;
    margin-left: -15vw;

    @media screen and (min-width: 1300px) {
        margin-left: -14vw;
        margin-bottom: 7vw;
    }
    @media screen and (max-width: 900px) {
        margin-left: -17vw;
    }
    @media screen and (max-width: 750px) {
        margin-left: -22vw;
    }
    @media screen and (max-width: 500px) {
        margin-top: -18vh;
        margin-left: -40vw;
    }
    @media screen and (max-width: 350px) {
        margin-top: -18vh;
        margin-left: -45vw;
    }
`

export const Filler = styled.div`
    width: 1vh;
    height: 1vh;
`

export const HeroSearchContainer = styled.div`
    display: flex;
    flex-direction: row;
`

export const Swrap = styled.div`
    width: 100%;
    height: 40px;
    background: #fff;
    border: 1px solid #000;
    overflow: hidden;
    border-radius: 10px;

    @media screen and (min-width: 1300px) {
        height: 60px;
    }
`

export const Smove = styled.div`
    position: relative;
    bottom: 0%;
    animation: slidev linear 20s infinite;
    margin-top: 0;

    @keyframes slidev {
        0% { bottom: 0; }
        15% { bottom: 0; }
        20% { bottom: 100%; }
        35% { bottom: 100%; }
        40% { bottom: 200%; }
        55% { bottom: 200%; }
        60% { bottom: 300%; }
        75% { bottom: 300%; }
        80% { bottom: 400%; }
        95% { bottom: 400%; }
        100% { bottom: 0; }
    }
`

export const Slide = styled.div`
    width: 100%;
    height: 40px;
    padding: 0 10px;
    border-radius: 10px;

    @media screen and (min-width: 1300px) {
        height: 60px;
    }
`

export const SlideH3 = styled.h3`
    color: #000;
    direction: rtl;

    @media screen and (min-width: 1300px) {
        height: 60px;
        font-size: clamp(1rem, 2vw, 2rem);
    }
`

export const HeroLogo = styled.img`
    width: 291.7px;
    height: auto;

    @media screen and (max-width: 350px) {
        width: 261.7px;
        height: auto;
    }
    @media screen and (max-width: 500px) {
        width: 291.7px;
        height: auto;
    }
    @media screen and (min-width: 700px) {
        width: 45vw;
        height: auto;
    }
    @media screen and (min-width: 1000px) {
        width: 45vw;
        height: auto;
    }
    @media screen and (min-width: 1200px) {
        width: 43vw;
        height: auto;
    }
`

export const HeroIconContainer = styled.div`
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    flex-wrap: wrap;
    z-index: 999;
`

export const Col = styled.div`
    display: flex;
    flex-direction: column;
    width: auto;
    height: auto;
    transition: 0.3s;

    &:hover {
        transform: scale(1.1);
        transition: 0.3s;
    }
`

export const IconTextContainer = styled.div`
    display: flex;
    justify-content: space-around;
    margin-top: 5px;
    height: auto;
    text-align: center;
`

export const IconText = styled.p`
    background: #F4DD4F;
    padding: 1px 10px;
    border-radius: 0 0 20px 20px;
    height: 100%;
    direction: rtl;
    font-size: clamp(1rem, 2vw, 2rem)
`

export const HeroIcon = styled.div`
    width: 100px;
    height: 100px;
    background: #F4DD4F;
    border-radius: 100%;
    align-items: flex-end;
    
    @media screen and (min-width: 1400px) {
        width: 7vw;
        height: 7vw;
    }
    @media screen and (max-width: 750px) {
        width: 70px;
        height: 70px;
        margin: 10px;
    }
`