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
    BoxImg,
    H3, P
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
                            <H3>برای ارتباط بیشتر با مدرس از راه های ارتباطی زیر اقدام کنید :</H3>
                            <P>شماره تماس : 09140734880 <br/>
آیدی اینستاگرام سارا رجبی : <a href="https://www.instagram.com/sararajabi.ir/">sararajabi.ir@</a> <br/>
گروه آموزشی تلگرام : <a href="https://t.me/joinchat/UzdcLu101RM6DgAp">sararajabi</a> <br/>
کانال تلگرام : <a href="https://t.me/sara_rajabi">@sara_rajabi</a> <br/>
ایمیل : <a href="mailto:sararajabiart3@gmail.com">sararajabiart3@gmail.com</a></P>
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
