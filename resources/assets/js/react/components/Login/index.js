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
} from './LoginElements';
import LoginLogo from '../../images/LoginLogo.svg';
import axios from 'axios';
import { useHistory } from "react-router-dom";

axios.defaults.withCredentials = true;

const Login = () => {
  const [pass, setPass] = useState("");
  const [email, setEmail] = useState("");

  const token = 'parsur';

  let history = useHistory();

  function submit(){
    axios.get('http://sararajabi.com/sanctum/csrf-cookie', {
      withCredentials: true,
      xsrfCookieName: "XSRF-TOKEN",
      xsrfHeaderName: "X-XSRF-TOKEN"
    }).then(response => {
      axios.post('http://sararajabi.com/api/v1/login', {
        email: email,
        password: pass,
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
        if(response.data.access_token !== undefined) {
          localStorage.setItem("token", (response.data.access_token));
          history.push('/');
        } else if(response.data.success === false){
          alert(response.data.message);
        }
    })
    .catch(function (error) {
        if(error.response.data.errors != undefined){
          alert(error.response.data.errors.email);
        } else if(error.response.data.errors != undefined){
          alert(error.response.data.errors.password);
        } else if(error.response.data.success === false){
          alert(error.response.data.message);
        }
    });
    });
}

  return (
    <Container>
      <MainLoginPage>
        <Top to="/">
          <Logo src={LoginLogo} alt="login logo"/>
        </Top>
        <Bottom>
          <H2>ورود</H2>
          <InputContainer>
            <Input onChange={event => setEmail(event.target.value)} top="true" type="email" placeholder="ایمیل شما"/>
          </InputContainer>
          <InputContainer>
            <Input onChange={event => setPass(event.target.value)} type="password" placeholder="رمز"/>
          </InputContainer>
          <InputContainer style={{height:"auto", alignItems:"flex-end", padding:"0 70px 0 0"}}>
            <Links to="/register">ثبت نام نکرده اید؟</Links>
          </InputContainer>
          <InputContainer>
            <Submit onClick={()=>submit()}>ورود</Submit>
          </InputContainer>
        </Bottom>
      </MainLoginPage>
    </Container>
  )
}

export default Login;