import { Link } from 'react-router-dom';
import styled from 'styled-components';

export const Contianer = styled.div`
  width: 100vw;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: #fff;
`

// top and bottom

export const Top = styled.div`
  width: 95%;
  background: #F4DD4F;
  display: flex;
  flex-direction: row;
  justify-content: center;
  flex-wrap: wrap;

  @media screen and (max-width:800px){
    flex-direction: column-reverse;
  }
`
export const Bottom = styled.div`
  width: 100%;
  background: #fff;
  z-index: 1;
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  align-items: center;
  flex-wrap: wrap;
  padding: 10px 0;
`

// right and left of top component

export const TLeft = styled.div`
  width: 35%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-evenly;
  padding: 40px 0;

  @media screen and (max-width:800px){
    width: 100%;
    flex-direction: column-reverse;
    justify-content: unset;
  }
`
export const TRight = styled.div`
  width: 65%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px 0;

  @media screen and (max-width:800px){
    width: 100%;
    padding: 0 0 40px 0;
  }
`

// main white component

export const Main = styled.div`
  width: 90%;
  border-bottom: 600px solid #fff;
	border-left: 70px solid transparent;
	height: 0;
  z-index: 1;
  direction: rtl;
  display: flex;
  flex-direction: column;
  align-items: flex-start;

  @media screen and (max-width:800px){
    width: 0;
    height: 400px;
    border-left: 90vw solid #fff;
    border-bottom: 50px solid transparent;
  }
`

// main texts

export const SubHeader = styled.h2`
  font-size: clamp(0.8rem, 1.8vw, 2.5rem);
  margin: 100px 30px 0 30px;

  @media screen and (max-width:800px){
    margin: 30px 30px 0 30px;
    width: 80vw;
  }
`
export const Header = styled.h1`
  font-size: clamp(1.8rem, 2.5vw, 4rem);
  margin: 30px 30px 0 30px;

  @media screen and (max-width:800px){
    width: 80vw;
  }

  @media screen and (max-width:350px){
        font-size: clamp(1.3rem, 2.5vw, 4rem);
  }
`
export const Description = styled.h4`
  font-size: clamp(0.7rem, 1.5vw, 2rem);
  margin: 30px 30px 0 30px;
  text-align: justify;
  width: 40vw;

  @media screen and (max-width:800px){
    width: 70vw;
  }
`

// logo and logo container

export const LogoContainer = styled.div`
  width: 100%;
  margin-right: -100px;
  z-index: 2;

  @media screen and (max-width:800px){
    margin-top: -200px;
    margin-right: 0;
  }
`
export const Logo = styled.img`
  width: 120%;
  height: auto;

  @media screen and (max-width:800px){
    width: 100%;
  }
`

// signin container

export const SigninContainer = styled.div`
  width: 100%;
  height: 100px;
  background: #fff;
  border-radius: 10px;
  margin-right: -100px;
  z-index: 1;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;

  @media screen and (max-width:800px){
    margin: 0;
    width: 80%;
    height: 90px;
  }
`
export const Login = styled(Link)`
  font-size: 40px;
  text-decoration: none;
  color: unset;
`
export const Logout = styled.div`
  width: 30%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: darkred;
  background: #a8323230;
  height: 100px;
  border-radius: 10px 0 0 10px;
  cursor: pointer;

  @media screen and (max-width:800px){
    height: 90px;
  }
`
export const User = styled(Link)`
  width: 70%;
  text-decoration: none;
  color: grey;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-size: 1.6rem;
`

// bottom links

export const LinkBlock = styled(Link)`
  height: 180px;
  width: 150px;
  text-decoration: none;
  color: unset;
  display: flex;
  flex-direction: column;
  align-items: center;
`
export const LTop = styled.div`
  width: 130px;
  height: 130px;
  background: #F4DD4F;
  border-radius: 50%;
`
export const LBottom = styled.div`
  width: 100%;
  height: 50px;
  padding: 5px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  direction: rtl;
`