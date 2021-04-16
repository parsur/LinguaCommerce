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

  const token = 'parsur';

  let history = useHistory();

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
        // setCourse(response.data);
        console.log(response);
        if(response.data.success === "کاربر با موفقیت ثبت نام کرد") {
          setVerify(true);
        }
    })
    .catch(function (error) {
        console.log(error);
        alert("لطفا درگاه ها را درست وارد کنید");
    });
    });
}

  function verifyEmail(){
    if(verify === true){
      return <InputContainer><p>ایمیل تایید برای شما ارسال شده، لطفا پس از تایید در سایت وارد شوید.</p></InputContainer>
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
            <Input onChange={event => setPass(event.target.value)} type="password" placeholder="رمز شما"/>
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