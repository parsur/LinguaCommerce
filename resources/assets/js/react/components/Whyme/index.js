import React from 'react';
import Footer from '../Footer';
import whymelogo from '../../images/whymelogo.png';
import {
    Container,
    Main,
    Left,
    Right,
    Top,
    Bottom,
    Filler,
    ImgContainer,
    TopContainer,
    BottomContainer,
    MB,
    Img,
    H1, P
} from './WhyMeElements';

const WhyMe = () => {
    return (
        <Container>
            <Main>
                <Left>
                    <Top>
                        <TopContainer>
                            <H1>چرا من؟</H1>
                            <P>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام </P>
                        </TopContainer>
                    </Top>
                    <Bottom>
                        <BottomContainer>
                            <MB>
                                <H1 active>چرا دوره ها؟</H1>
                                <P>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، </P>
                            </MB>
                        </BottomContainer>
                    </Bottom>
                </Left>
                <Right>
                    <Filler></Filler>
                    <ImgContainer>
                        <Img src={whymelogo} />
                    </ImgContainer>
                </Right>
            </Main>
            <Footer />
        </Container>
    )
}

export default WhyMe;
