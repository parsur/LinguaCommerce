import React from 'react';
import { 
    AboutContainer,
    AboutBoxContainer,
    AboutRowOne,
    AboutRowTwo,
    BoxTopOne,
    BoxBottomOne,
    BoxBottomTwo,
    SmallerBox,
    BoxImgContainer,
    BoxImg
 } from './AboutUsElements';
 import aboutlogo from '../../images/officeabout.svg';
 import Footer from '../Footer';

const About = () => {
    return (
        <AboutContainer>
            <AboutBoxContainer>
                <AboutRowOne>
                    <BoxTopOne>
                        {/* Here is going to be box things */}
                    </BoxTopOne>
                </AboutRowOne>
                <AboutRowTwo>
                    <BoxBottomOne>
                        <SmallerBox>
                            {/* Here is going to be the petit box things */}
                        </SmallerBox>
                    </BoxBottomOne>
                    <BoxBottomTwo>
                        <BoxImgContainer>
                            <BoxImg src={aboutlogo} alt='office work' />
                        </BoxImgContainer>
                    </BoxBottomTwo>
                </AboutRowTwo>
            </AboutBoxContainer>
            <Footer style={{marginTop:"-30px", zIndex:"999"}} />
        </AboutContainer>
    )
}

export default About;
