import React, { useState } from 'react';
import {
  Container,
  MainLoginPage,
  Top,
  Bottom,
  Logo,
  InputContainer,
  Input,
  Submit,
  H2,
  Links
} from './SignupElements';
import LoginLogo from '../../images/LoginLogo.svg';
import axios from 'axios';
import { useHistory } from "react-router-dom";

axios.defaults.withCredentials = true;

const Signup = () => {
  const [pass, setPass] = useState("");
  const [email, setEmail] = useState("");
  const [name, setName] = useState("");
  const [confPass, setConfPass] = useState("");
  const [phone, setPhone] = useState("");
  const [verify, setVerify] = useState(false);
  const [registerToken, setRegisterToken] = useState("");

  const token = 'parsur';

  function submit(){
    axios.get('http://sararajabi.com/sanctum/csrf-cookie', {
      withCredentials: true,
      xsrfCookieName: "XSRF-TOKEN",
      xsrfHeaderName: "X-XSRF-TOKEN"
    }).then(response => {
      axios.post('http://sararajabi.com/api/v1/register', {
        email: email,
        password: pass,
        password_confirmation: confPass,
        name: name,
        phone_number: phone
    }, {
        headers: {
          'api_key': `${token}` 
        },
        withCredentials: true,
        xsrfCookieName: "XSRF-TOKEN",
        xsrfHeaderName: "X-XSRF-TOKEN"
      }
    )
    .then(function (response) {
        setRegisterToken(response.data.register_token);
        if(response.data.message === "ثبت نام شما با موفقیت انجام شد") {
          setVerify(true);
        }
    })
    .catch(function (error) {
        if(error.response.data.errors.email != undefined){
          alert(error.response.data.errors.email);
        }
        if(error.response.data.errors.name != undefined){
          alert(error.response.data.errors.name);
        }
        if(error.response.data.errors.password != undefined){
          alert(error.response.data.errors.password);
        }
        if(error.response.data.errors.phone_number != undefined){
          alert(error.response.data.errors.phone_number);
        }
    });
    });
}

  function resendMail(){
    axios.get('http://www.sararajabi.com/api/v1/email/resend', {
      headers: {
        'api_key': 'parsur',
        'Authorization': `Bearer ${registerToken}`,
      }
    })
    .then(function (response) {
      alert('ایمیل تاییدیه فرستاده شد')
    })
    .catch(function (error) {
        console.log(error);
    });
  }

  function verifyEmail(){
    if(verify === true){
      return <InputContainer><p>ایمیل تایید برای شما ارسال شد. <span style={{color:"blue"}} onClick={()=>resendMail()}>ارسال مجدد</span></p></InputContainer>
    }
  }

  return (
    <Container>
      <MainLoginPage>
        <Top to="/">
          <Logo src={LoginLogo} alt="login logo"/>
        </Top>
        <Bottom>
          <H2>ثبت نام</H2>
          <InputContainer>
            <Input onChange={event => setName(event.target.value)} top="true" type="text" placeholder="نام شما"/>
          </InputContainer>
          <InputContainer>
            <Input onChange={event => setEmail(event.target.value)} type="email" placeholder="ایمیل شما"/>
          </InputContainer>
          <InputContainer>
            <Input onChange={event => setPhone(event.target.value)} type="number" placeholder="شماره موبایل شما"/>
          </InputContainer>
          <InputContainer>
            <Input onChange={event => setPass(event.target.value)} type="password" placeholder="رمز شما (حداقل ۸ حرف)"/>
          </InputContainer>
          <InputContainer>
            <Input onChange={event => setConfPass(event.target.value)} type="password" placeholder="تایید رمز"/>
          </InputContainer>
          <InputContainer style={{height:"auto", alignItems:"flex-end", padding:"0 70px 0 0"}}>
            <Links to="/login">قبلا ثبت نام کرده اید؟</Links>
          </InputContainer>
          {verifyEmail()}
          <InputContainer>
            <Submit onClick={()=>submit()}>ثبت</Submit>
          </InputContainer>
        </Bottom>
      </MainLoginPage>
    </Container>
  )
}

export default Signup;