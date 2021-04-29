import React, { useEffect, useState } from 'react';
import {
    Container,
    MainContainer,
    Display,
    UserNavbar,
    ItemContainer,
    LinkContainer,
    Lp, Span,
    ProfileContainer,
    Profile,
    ProfileImg,
    ProfileTxt,
} from './UserElements';
import Navbar from '../Navbar';
import Footer from '../Footer';
import workinggirl from '../../images/working-girl.png';
import { HashRouter as Router, Route } from 'react-router-dom';
import Details from './details';
import { backStyleTwo, dash, gifStyleTwo } from '../../Data';
import Orders from './orders';
import apiAxios from '../../axios';
import Particles from 'react-particles-js';

const DisplayOne = () => {
    return(
        <Details {...dash} />
    );
}
const DisplayTwo = () => {
    return(
        <Orders {...dash}/>
    );
}

const User = ({
    data
}) => {


    const [user, setUser] = useState();


    useEffect(() => {
        apiAxios('/user/show')
        .then(function (response) {
            setUser(response.data.user);
        })
        .catch(function (error) {
            console.log(error);
        })
      }, []);

    return user ? (
        <Container>
            <Particles params={backStyleTwo} style={gifStyleTwo}/>
            <Navbar />
            <Router>
            <MainContainer>
                <Display>
                    <Route exact path='/' component={DisplayOne} />
                    <Route path='/orders' component={DisplayTwo} />
                </Display>
                <UserNavbar>
                    <ProfileContainer>
                        <Profile>
                            <ProfileImg src={workinggirl} />
                            <ProfileTxt>{user.name}</ProfileTxt>
                        </Profile>
                    </ProfileContainer>
                    <ItemContainer>
                        {data.map(({to, text, icon}, i) => {
                            return(
                                <LinkContainer key={i} to={to}>
                                    <Lp>{text}</Lp><Span>{icon}</Span>
                                </LinkContainer>
                            );
                        })}
                    </ItemContainer>
                </UserNavbar>
            </MainContainer>
            <Footer />
            </Router>
        </Container>
    ) : (
        <Container>
            <Particles params={backStyleTwo} style={gifStyleTwo}/>
            <Navbar />
            <Router>
            <MainContainer>
                <Display>
                    <Route exact path='/' component={DisplayOne} />
                    <Route path='/orders' component={DisplayTwo} />
                </Display>
                <UserNavbar>
                    <ProfileContainer>
                        <Profile>
                            <ProfileImg src={workinggirl} />
                            <ProfileTxt>...درحال بارگذاری</ProfileTxt>
                        </Profile>
                    </ProfileContainer>
                    <ItemContainer>
                        {data.map(({to, text, icon}, i) => {
                            return(
                                <LinkContainer key={i} to={to}>
                                    <Lp>{text}</Lp>{icon}
                                </LinkContainer>
                            );
                        })}
                    </ItemContainer>
                </UserNavbar>
            </MainContainer>
            <Footer />
            </Router>
        </Container>
    );
}

export default User;