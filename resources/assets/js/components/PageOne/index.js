import React, { useState } from 'react';
import { 
    HeroContainer,
    HeroMainContainer,
    HeroTopContainer,
    HeroIcons,
    HeroLeftSide,
    HeroRightSide,
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
    SlideP,
    HeroLogo,
    HeroIconContainer,
    HeroIcon
 } from './HeroElements';
import SearchModal from './SearchModal';

const Hero = ({welcome, main, desc, data}) => {
    const [modalIsOpen, setmodalIsOpen] = useState(false);
    return (
        <HeroContainer>
            <SearchModal modalIsOpen={modalIsOpen} setmodalIsOpen={setmodalIsOpen} />
            <HeroMainContainer>
                <HeroTopContainer>
                    <HeroLeftSide>
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
                            <HeroLogo src={LogoImg} alt="image logo" />
                        </HeroMainLogo>
                        <Filler></Filler>
                    </HeroRightSide>
                </HeroTopContainer>
                <HeroIcons>
                    <HeroIconContainer>
                        <HeroIcon></HeroIcon>
                        <HeroIcon></HeroIcon>
                        <HeroIcon></HeroIcon>
                        <HeroIcon></HeroIcon>
                        <HeroIcon></HeroIcon>
                        <HeroIcon></HeroIcon>
                    </HeroIconContainer>
                </HeroIcons>
            </HeroMainContainer>
        </HeroContainer>
    )
}

export default Hero;