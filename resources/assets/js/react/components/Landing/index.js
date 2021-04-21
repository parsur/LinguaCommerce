import React, { useEffect, useState } from 'react';
import { 
    HeroContainer,
    HeroMainContainer,
    HeroTopContainer,
    HeroIcons,
    HeroLeftSide,
    HeroRightSide,
    HeroLoginContainer,
    LogIn,
    LoginButton,
    LoginIcon,
    LoginCol,
    HeroTextContainer,
    HeroP,
    HeroH1,
    HeroDesc,
    HeroTopButton,
    HeroMainLogo,
    Filler,
    HeroWhiteBg,
    HeroLogo,
    HeroIconContainer,
    Col,
    IconTextContainer,
    IconText,
    HeroIcon,
    WelcomeUser,
    Welcome
 } from './HeroElements';
import Particles from 'react-particles-js';
import about from '../../images/about.png';
import course from '../../images/course.png';
import article from '../../images/article.png';
import callus from '../../images/callus.png';
import shop from '../../images/shop.png';
import mainlogo from '../../images/mainlogo.png';
import { backStyle, gifStyle } from '../../Data';
import { Link } from 'react-router-dom';
import Loader from 'react-loader-spinner';
import axios from 'axios';
import { useHistory } from 'react-router';

const token = 'parsur';

const Hero = () => {

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
        <HeroContainer>
            <HeroMainContainer>
                <HeroTopContainer>
                    <Particles params={backStyle} style={gifStyle}/>
                    <HeroLeftSide>
                      <HeroLoginContainer>
                        
                          <div style={isLogin ? {display:"none"} : {display:"unset"}}>
                          <LogIn>
                          <LoginCol to="/login">
                            <LoginButton>ورود</LoginButton>
                            <LoginIcon></LoginIcon>
                          </LoginCol>
                          </LogIn>
                          </div>

                          <div style={isLogin ? {width:"100%", display:"flex"} : {display:"none"}}>
                          <LogIn>
                          <Welcome style={{borderRadius:"0 20px 5px 0"}} to="/userpage#/">
                            <WelcomeUser>{name.name}</WelcomeUser>
                          </Welcome>
                          </LogIn>
                          <LogIn onClick={logout} style={{background:"red", marginRight:"0", borderRadius:"20px 0 0 5px", width:"10vw"}}>
                          <Welcome>
                            <WelcomeUser>خروج</WelcomeUser>
                          </Welcome>
                          </LogIn>
                          </div>
                        
                      </HeroLoginContainer>
                      <HeroTextContainer>
                        <HeroP>{home.subHeader}</HeroP>
                        <HeroH1>{home.header}</HeroH1>
                        <HeroDesc>{home.description}</HeroDesc>
                      </HeroTextContainer>
                    </HeroLeftSide>
                    <HeroRightSide>
                        <HeroTopButton>
                        </HeroTopButton>
                        <HeroMainLogo>
                            <HeroLogo src={mainlogo} alt="image logo" />
                        </HeroMainLogo>
                        <Filler></Filler>
                    </HeroRightSide>
                </HeroTopContainer>
                <HeroIcons>
                    <HeroWhiteBg>
                    <HeroIconContainer>
                      <Col>
                        <Link to='/courselist' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={shop} width='100%' height='100%' alt="courses"/></HeroIcon>
                          <IconTextContainer><IconText>دوره ها</IconText></IconTextContainer>
                        </Link>
                      </Col>
                      <Col>
                        <Link to='/articlelists' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={article} width='100%' height='100%' alt="articles"/></HeroIcon>
                          <IconTextContainer><IconText>مقاله ها</IconText></IconTextContainer>
                        </Link>
                      </Col>
                      <Col>
                        <Link to='/whyme' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={course} width='100%' height='100%' alt="whyme"/></HeroIcon>
                          <IconTextContainer><IconText>چرا من؟</IconText></IconTextContainer>
                        </Link>
                      </Col>
                      <Col>
                        <Link to='/consultante' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={callus} width='100%' height='100%' alt="consultante"/></HeroIcon>
                          <IconTextContainer><IconText>مشاوره</IconText></IconTextContainer>
                        </Link>
                      </Col>
                      <Col>
                        <Link to='/aboutus' style={{textDecoration:"none"}}>
                          <HeroIcon><img src={about} width='100%' height='100%' alt="aboutus"/></HeroIcon>
                          <IconTextContainer><IconText>درباره ما</IconText></IconTextContainer>
                        </Link>
                      </Col>
                    </HeroIconContainer>
                    </HeroWhiteBg>
                </HeroIcons>
            </HeroMainContainer>
        </HeroContainer>
    ) : (
        <div style={{width:"100vw", height:"100vh", display:"flex", background: "#F4DD4F"}}>
            <Loader
            type="Oval"
            color="#fff"
            height={150}
            width={150}
            timeout={3000} //3 secs
            style={{margin: "auto"}}
            />
        </div>
    );
}

export default Hero;