import React from 'react';
import {
    Container,
    MainContainer,
    Display,
    UserNavbar,
    ItemContainer,
    LinkContainer,
    Lp,
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
import { dash } from '../../Data';

// these down here are just test
const DisplayOne = () => {
    return(
        <Details {...dash} />
    );
}
const TestTwo = () => {
    return(
        <h1>Test Two</h1>
    );
}

const User = ({
    dashboardName,
    data
}) => {
    return (
        <Container>
            <Navbar />
            <Router>
            <MainContainer>
                <Display>
                    <Route exact path='/' component={DisplayOne} />
                    <Route path='/testtwo' component={TestTwo} />
                </Display>
                <UserNavbar>
                    <ProfileContainer>
                        <Profile>
                            <ProfileImg src={workinggirl} />
                            <ProfileTxt>{dashboardName}</ProfileTxt>
                        </Profile>
                    </ProfileContainer>
                    <ItemContainer>
                        {data.map(({to, text, icon}) => {
                            return(
                                <LinkContainer to={to}>
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
    )
}

export default User;