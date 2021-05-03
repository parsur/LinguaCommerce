import React from 'react';
import Navbar from '../../Navbar';
import Footer from '../../Footer';
import {
    Container,
    MainContainer,
    NotSignIn,
    H1,
    Hr,
    Button
} from './NsiElements';

const Nsi = () => {
    return (
        <Container>
            <Navbar />
                <MainContainer>
                    <NotSignIn>
                        <H1>شما وارد نشده اید</H1>
                        <Hr />
                        <Button to="/login">وارد شوید</Button>
                    </NotSignIn>
                </MainContainer>
            <Footer />
        </Container>
    )
}

export default Nsi;
