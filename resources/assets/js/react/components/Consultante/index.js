import React, {useEffect, useState} from 'react';
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
import axios from 'axios';
import axiosApi from '../../axios';

const Consultante = () => {

    const [isSignedIn, setIsSignedIn] = useState(false);
    const [phone, setPhone] = useState(null);
    const [desc, setDesc] = useState(null);

    const token = 'parsur';

    useEffect(() => {
        axiosApi('/user/show')
        .then(function (response) {
            if(response.data.user == null){
                setIsSignedIn(false);
            } else {
                setIsSignedIn(true);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }, []);

    function submit(){
        axios.post('http://sararajabi.com/api/v1/consultation/store', {
            description: desc,
            phone_number: phone
        }, {
            headers: {
              'api_key': `${token}`,
              'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
          }
        ).then(function (response) {
        })
        .catch(function (error) {
            console.log(error);
        })
    }

    return (
        <>
        <div style={isSignedIn ? {display:"unset"} : {display:"none"}}>
            <Container>
                <Main> 
                    <Left>
                        <TextContainer>
                            <Text>
                                <H1>برای درخواست مشاوره درگاه هارا وارد کنید</H1>
                                <Form onSubmit={event => event.preventDefault()}>
                                    <Area maxLength="250" onChange={event => setDesc(event.target.value)} active placeholder='درخواست خود را وارد کنید.' />
                                    <Submit onClick={()=>submit()} value="ثبت کنید" type='submit' />
                                </Form>
                                <Block>
                                    پس از درخواست با شما در ارتباط خواهیم بود.
                                </Block>
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
                                <H1>برای درخواست مشاوره درگاه هارا وارد کنید</H1>
                                <Form onSubmit={event => event.preventDefault()}>
                                    <Area disabled active placeholder='درخواست خود را وارد کنید.' />
                                    <Name onChange={event => setPhone(event.target.value)} type='text' name='fname' placeholder='شماره تلفن' />
                                    <Submit onClick={()=>submit()} value="ثبت کنید" type='submit' />
                                </Form>
                                <Block>
                                    برای نوشتن درخواست کامل تر، وارد شوید.
                                </Block>
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