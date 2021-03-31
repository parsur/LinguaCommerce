import React from 'react';
import { 
    HeroContainer,
    HeroMainContainer,
    HeroTopContainer,
    HeroIcons,
    HeroLeftSide,
    HeroRightSide,
    HeroLoginContainer,
    LogIn,
    LoginButton,
    LoginIcon,
    LoginCol,
    HeroTextContainer,
    HeroP,
    HeroH1,
    HeroDesc,
    HeroTopButton,
    HeroMainLogo,
    Filler,
    HeroSearchContainer,
    Swrap,
    Smove,
    Slide,
    SlideH3,
    HeroWhiteBg,
    HeroLogo,
    HeroIconContainer,
    Col,
    IconTextContainer,
    IconText,
    HeroIcon
 } from './HeroElements';
import Particles from 'react-particles-js';
import about from '../../images/about.png';
import course from '../../images/course.png';
import article from '../../images/article.png';
import callus from '../../images/callus.png';
import shop from '../../images/shop.png';
import mainlogo from '../../images/mainlogo.png';
import { backStyle, gifStyle } from '../../Data';
import { Link } from 'react-router-dom';

const Hero = ({welcome, main, desc, data}) => {
    return (
        <HeroContainer>
            <HeroMainContainer>
                <HeroTopContainer>
                    <Particles params={backStyle} style={gifStyle}/>
                    <HeroLeftSide>
                      <HeroLoginContainer>
                        <LogIn>
                          <LoginCol>
                            <LoginButton>ورود</LoginButton>
                            <LoginIcon></LoginIcon>
                          </LoginCol>
                        </LogIn>
                      </HeroLoginContainer>
                      <HeroTextContainer>
                          <HeroP>{welcome}</HeroP>
                          <HeroH1>{main}</HeroH1>
                          <HeroDesc>{desc}</HeroDesc>
                      </HeroTextContainer>
                    </HeroLeftSide>
                    <HeroRightSide>
                        <HeroTopButton>
                            <HeroSearchContainer>
                                <Swrap>
                                    <Smove>
                                        {data.map(({slideText}) => {
                                            return(
                                                <Slide>
                                                    <SlideH3>{slideText}</SlideH3>
                                                </Slide>
                                            );
                                        })}
                                    </Smove>
                                </Swrap>
                            </HeroSearchContainer>
                        </HeroTopButton>
                        <HeroMainLogo>
                            <HeroLogo src={mainlogo} alt="image logo" />
                        </HeroMainLogo>
                        <Filler></Filler>
                    </HeroRightSide>
                </HeroTopContainer>
                <HeroIcons>
                    <HeroWhiteBg>
                    <HeroIconContainer>
                      <Col>
                        <Link to='/courselist' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={course} width='100%' height='100%'/></HeroIcon>
                          <IconTextContainer><IconText>دوره ها</IconText></IconTextContainer>
                        </Link>
                      </Col>
                      <Col>
                        <Link to='/' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={article} width='100%' height='100%'/></HeroIcon>
                          <IconTextContainer><IconText>مقاله ها</IconText></IconTextContainer>
                        </Link>
                      </Col>
                      <Col>
                        <Link to='/whyme' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={shop} width='100%' height='100%'/></HeroIcon>
                          <IconTextContainer><IconText>چرا من؟</IconText></IconTextContainer>
                        </Link>
                      </Col>
                      <Col>
                        <Link to='/consultante' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={callus} width='100%' height='100%'/></HeroIcon>
                          <IconTextContainer><IconText>مشاوره</IconText></IconTextContainer>
                        </Link>
                      </Col>
                      <Col>
                        <Link to='/aboutus' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={about} width='100%' height='100%'/></HeroIcon>
                          <IconTextContainer><IconText>درباره ما</IconText></IconTextContainer>
                        </Link>
                      </Col>
                    </HeroIconContainer>
                    </HeroWhiteBg>
                </HeroIcons>
            </HeroMainContainer>
        </HeroContainer>
    )
}

export default Hero;