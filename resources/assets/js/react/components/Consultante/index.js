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

const Consultante = () => {

    const [isSignedIn, setIsSignedIn] = useState(false);
    const [phone, setPhone] = useState(null);
    const [desc, setDesc] = useState(null);

    const token = 'parsur';

    useEffect(() => {
        axios.get('http://sararajabi.com/api/v1/user/show', {
            headers: {
                'api_key': `${token}`,
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
          }
        ).then(function (response) {
            console.log(response);
            // setName(response.data.user); YOU WILL NEED THIS
            if(response.data.user == null){
                setIsSignedIn(false);
            } else {
                setIsSignedIn(true);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
        // api("api/user/show")
        //     .then(({ user }) => {
        //         setUser(user);
        //     })
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
            console.log(response);
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
                                <H1>برای درخاست مشاوره درگاه هارا وارد کنید!</H1>
                                <Form onSubmit={event => event.preventDefault()}>
                                    <Area maxLength="250" onChange={event => setDesc(event.target.value)} active placeholder='درخاست خود را وارد کنید.' />
                                    <Submit onClick={()=>submit()} value="ثبت کنید" type='submit' />
                                </Form>
                                <Block>
                                    پس از درخاست با شما در ارتباط خواهیم بود.
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
                                <H1>برای درخاست مشاوره درگاه هارا وارد کنید!</H1>
                                <Form onSubmit={event => event.preventDefault()}>
                                    <Area disabled active placeholder='درخاست خود را وارد کنید.' />
                                    <Name onChange={event => setPhone(event.target.value)} type='text' name='fname' placeholder='شماره تلفن' />
                                    <Submit onClick={()=>submit()} value="ثبت کنید" type='submit' />
                                </Form>
                                <Block>
                                    برای نوشتن درخاست کامل تر، وارد شوید.
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