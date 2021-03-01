import styled from 'styled-components';

export const HeroContainer = styled.div`
    background: #064F7C;
`

export const HeroMainContainer = styled.div`
    background: #000;
    width: auto;
    margin: 0 40px;
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

    @media screen and (max-width: 610px) {
        margin-left: 10px;
    }

    @media screen and (max-width: 500px) {
        width: 0;
	    height: 50vh;
	    border-right: 70vw solid #fff;
	    border-bottom: 40px solid #F4DD4F;
        border-radius: 0 0 0 0;
        flex-direction: row;
    }
`

export const HeroRightSide = styled.div`
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 70vh;
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
    font-size: clamp(1rem, 1.5vw, 2.5rem);
    margin-bottom: 0.1vh;
`

export const HeroH1 = styled.div`
    font-size: clamp(2rem, 2.5vw, 4rem);
    margin-bottom: 2vh;
`

export const HeroDesc = styled.div`
    font-size: clamp(0.5rem, 1vw, 2rem);
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
    margin-left: -18vw;

    @media screen and (min-width: 1300px) {
        margin-left: -15vw;
    }
    @media screen and (max-width: 900px) {
        margin-left: -20vw;
    }
    @media screen and (max-width: 750px) {
        margin-left: -25vw;
    }
    @media screen and (max-width: 500px) {
        margin-top: -15vh;
        margin-left: -35vw;
    }
`

export const Filler = styled.div`
    width: 1vh;
    height: 1vh;
`

export const HeroSearchContainer = styled.div`
    display: flex;
    flex-direction: row;
    
    @media screen and (max-width: 500px) {
        display: none;
    }
`

export const Swrap = styled.div`
    width: 100%;
    height: 5vh;
    background: #097cc3;
    border: 1px solid #000;
    overflow: hidden;
    border-radius: 10px;
`

export const Smove = styled.div`
    position: relative;
    bottom: 0%;
    animation: slidev linear 20s infinite;
    margin-top: 0.6vh;

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
    height: 5vh;
    padding: 0 10px;
    border-radius: 10px;
`

export const SlideH3 = styled.h3`
    color: #fff;
    direction: rtl;
`

export const HeroLogo = styled.img`
    width: 250px;
    height: 206px;
`

export const HeroIconContainer = styled.div`
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    flex-wrap: wrap;
`

export const HeroIcon = styled.div`
    width: 100px;
    height: 100px;
    background: #F4DD4F;
    border-radius: 100%;
    
    @media screen and (min-width: 1400px) {
        width: 7vw;
        height: 7vw;
    }
    @media screen and (max-width: 750px) {
        width: 70px;
        height: 70px;
    }
`