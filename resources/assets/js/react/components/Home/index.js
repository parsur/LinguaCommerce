import React, { useEffect, useState } from 'react';
import {
  Contianer,
  Top,
  Bottom,
  TLeft,
  TRight,
  Main,
  LogoContainer,
  Logo,
  SigninContainer,
  LinkBlock,
  LTop,
  LBottom,
  Login,
  Logout,
  User,
  SubHeader,
  Header,
  Description
} from './homeElements';
import mainlogo from '../../images/mainlogo.svg';
import Particles from 'react-particles-js';
import { backStyle, gifStyle } from '../../Data';
import about from '../../images/about.png';
import course from '../../images/course.png';
import article from '../../images/article.png';
import callus from '../../images/callus.png';
import shop from '../../images/shop.png';
import axios from 'axios';
import { useHistory } from 'react-router';
import Loader from 'react-loader-spinner';

const token = 'parsur';

const Home = () => {
  const [home, setHome] = useState(null);
   const [isLogin, setIslogin] = useState(false);
   const [name, setName] = useState("");

   const history = useHistory();

   function logout(){
    axios.post('http://sararajabi.com/api/v1/logout', {}, {
          headers: {
              'api_key': `${token}`,
              'Authorization': `Bearer ${localStorage.getItem('token')}`,
          }
        }
      ).then(function (response) {
        console.log(response);
        if(response.data.success === "کاربر با موفقیت از حساب کاربری خود خارج شد"){
          localStorage.removeItem('token');
          history.push('/');
          window.location.reload(false);
        }
      })
      .catch(function (error) {
        console.log(error);
      });
}


  useEffect(() => {
    axios.get('http://sararajabi.com/api/v1/home', {
      headers: {
          'api_key': `${token}`,
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
      }
    }
  ).then(function (response) {
      console.log(response);
      setHome(response.data);
      setIslogin(response.data.authentication);
  })
  .catch(function (error) {
      console.log(error);
  });
    }, []);

    useEffect(() => {
      axios.get('http://sararajabi.com/api/v1/user/show', {
          headers: {
              'api_key': `${token}`,
              'Authorization': `Bearer ${localStorage.getItem('token')}`,
          }
        }
      ).then(function (response) {
          console.log(response);
          setName(response.data.user);
      })
      .catch(function (error) {
          console.log(error);
      });
      // api("api/user/show")
      //     .then(({ user }) => {
      //         setUser(user);
      //     })
  }, []);
  return home ? (
    <div style={{width:"100vw",height:"100vh",background:"#fff"}}>
      <Contianer>
        <Particles params={backStyle} style={gifStyle}/>
        <Top>
          <TLeft>
            <SigninContainer>
              <div style={isLogin ? {display:"none"} : {display:"unset"}}>
                <Login to="/login">ورود</Login>
              </div>
              <div style={isLogin ? {width:"100%", display:"flex"} : {display:"none"}}>
                <Logout onClick={logout}>خروج</Logout>
                <User to="/userpage#/">{name.name}</User>
              </div>
            </SigninContainer>
            <LogoContainer>
              <Logo src={mainlogo} alt="logo"/>
            </LogoContainer>
          </TLeft>
          <TRight>
            <Main>
              <SubHeader>{home.subHeader}</SubHeader>
              <Header>{home.header}</Header>
              <Description>{home.description}</Description>
            </Main>
          </TRight>
        </Top>
        <Bottom>
          <LinkBlock to='/courselist'>
            <LTop><img src={shop} alt="mind improvement" width="100%" height="100%" /></LTop>
            <LBottom>دوره ها</LBottom>
          </LinkBlock>
          <LinkBlock to='/articlelists'>
            <LTop><img src={article} alt="article" width="100%" height="100%" /></LTop>
            <LBottom>مقاله ها</LBottom>
          </LinkBlock>
          <LinkBlock to='/aboutus'>
            <LTop><img src={about} alt="check list" width="100%" height="100%" /></LTop>
            <LBottom>درباره ما</LBottom>
          </LinkBlock>
          <LinkBlock to='/whyme'>
            <LTop><img src={course} alt="counter" width="100%" height="100%" /></LTop>
            <LBottom>چرا من؟</LBottom>
          </LinkBlock>
          <LinkBlock to='/consultante'>
            <LTop><img src={callus} alt="call" width="100%" height="100%" /></LTop>
            <LBottom>مشاوره</LBottom>
          </LinkBlock>
        </Bottom>
      </Contianer>
    </div>
  ) : (
    <div style={{width:"100vw", height:"100vh", display:"flex", background: "#eee"}}>
      <Loader
      type="Oval"
      color="gray"
      height={150}
      width={150}
      timeout={3000} //3 secs
      style={{margin: "auto"}}
      />
    </div>
  )
}

export default Home;
