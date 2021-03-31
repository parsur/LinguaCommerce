import React, {useState} from 'react';
import Footer from '../Footer';
import { 
    Container,
    Main,
    Left,
    Right,
    ImgContainer,
    Img,
    TextContainer,
    Text,
    H1,
    Form,
    Name,
    Area,
    Submit,
    Block
 } from './ConsultanteElements';
import conlogo from '../../images/conlogo.png';

const Consultante = () => {
    const [isSignedIn] = useState(false);
    return (
        <>
        <div style={isSignedIn ? {display:"unset"} : {display:"none"}}>
            <Container>
                <Main> 
                    <Left>
                        <TextContainer>
                            <Text>
                                <H1>برای درخاست مشاوره درگاه هارا وارد کنید!</H1>
                                <Form>
                                    <Area active placeholder='درخاست خود را وارد کنید.' />
                                    <Name type='text' name='fname' placeholder='شماره تلفن' />
                                    <Submit value="ثبت کنید" type='submit' />
                                </Form>
                            </Text>
                        </TextContainer>
                    </Left>
                    <Right>
                        <ImgContainer>
                            <Img src={conlogo} alt="hello" />
                        </ImgContainer>
                    </Right>
                </Main>
                <Footer/>
            </Container>
        </div>
        <div style={isSignedIn ? {display:"none"} : {display:"unset"}}>
            <Container>
                <Main> 
                    <Left>
                        <TextContainer>
                            <Text>
                                <H1>برای درخاست مشاوره درگاه هارا وارد کنید!</H1>
                                <Form>
                                    <Area active placeholder='درخاست خود را وارد کنید.' />
                                    <Name type='text' name='fname' placeholder='شماره تلفن' />
                                    <Submit value="ثبت کنید" type='submit' />
                                    <Block>
                                        کاربر محترم شما وارد نشده اید, برای پاسخ سریعتر و اطلاعات بهتر لطفا وارد شوید
                                    </Block>
                                </Form>
                            </Text>
                        </TextContainer>
                    </Left>
                    <Right>
                        <ImgContainer>
                            <Img src={conlogo} alt="hello" />
                        </ImgContainer>
                    </Right>
                </Main>
                <Footer/>
            </Container>
        </div>
        </>
    )
}

export default Consultante;