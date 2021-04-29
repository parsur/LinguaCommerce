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
                            <P active><span style={{background:"orange"}}>به وب سایت من خوش آمدید .</span>
                                <br/>
ما در این وب سایت به آموزش مهارت‌های ارتباطی، فن بیان، سخنرانی می‌پردازیم که برای یک زندگی موثرتر و حرفه‌ای‌تر نیاز است.
<br/>
 با این آموزش‌ها می توانید بهتر و موثر تر ارتباط برقرار کنید و دوستی های پایداری رو شکل بدید
دوره ها در این وبسایت با یک قیمت عالی برگزار میشود شما می تونید با پرداخت کمترین قیمت بیشترین بازخورد و بازدهی رو بگیرید .</P>
                        </TopContainer>
                    </Top>
                    <Bottom>
                        <BottomContainer>
                            <MB>
                                <H1 active>مدرس این سایت: <span style={{color:"red"}}>سارا رجبی</span></H1>
                                <P>مدرس فن بیان و مهارت های ارتباطی
                                    <br/>
مدرس تولید محتوا
<br/>
مدرس مجموعه فرهنگی ، آموزشی گیلدا
<br/>
برگزار کننده چندین دوره ی آنلاین فن بیان
<br/>
مجری جشن ها و مراسم ها
<br/>
مجری اولین همایش کشوری کودکان صلح و گفت و گو
<br/>
مستر مجری جشنواره ی قصه گویی
<br/>
دومین مجری جوان کشور در سال 1397
<br/>
هنرجو دوره ی فن بیان حرفه ای
<br/>
دارنده ی چکاوک سیمین جشنواره مجریان و هنرمندان صحنه ایران
<br/>
دارنده ی گواهی معتبر از باشگاه ایرآنمجری
<br/>
دارنده مدرک حرفه ای فن بیان و اجرا
<br/>
دارنده گواهی معتبر سخنرانی حرفه ای  از فنی حرفه ای
<br/>
برگزیده جشنواره قصه گویی
<br/>
نویسنده کتاب (( خدا ))
<br/>
نویسنده کتاب (( ملکه باشیم ))
<br/>
نویسنده چندین مقاله در زمینه فن بیان و مهارت های ارتباطی</P>
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