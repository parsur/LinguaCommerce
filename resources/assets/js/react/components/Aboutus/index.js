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
                    <H3>برای ارتباط بیشتر با مدرس از راه های ارتباطی زیر اقدام کنید :</H3>
                            <P>شماره تماس : 09140734880 <br/>
<a href="https://www.instagram.com/sararajabi.ir/">آیدی اینستاگرام سارا رجبی</a> <br/>
<a href="https://t.me/joinchat/UzdcLu101RM6DgAp">گروه آموزشی تلگرام</a> <br/>
<a href="https://t.me/sara_rajabi">کانال تلگرام</a> <br/>
<a href="mailto:sararajabiart3@gmail.com">ایمیل</a></P>
                    </BoxTopOne>
                </AboutRowOne>
                <AboutRowTwo>
                    <BoxBottomOne>
                        <SmallerBox>
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
