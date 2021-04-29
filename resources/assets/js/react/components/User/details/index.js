import React, { useState, useEffect } from 'react';
import {
    Container,
    NameContainer,
    DetailContainer,
    H1,
    Detail,
    D1, D2, D3,
    Number, Email,
    Created, Edited,
} from './DetailsElements';
import Loader from "react-loader-spinner";
import apiAxios from '../../../axios';

const Details = () => {
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
        <>
        <Container>
            <NameContainer>
                <H1>{user.name}</H1>
            </NameContainer>
            <DetailContainer>
                <Detail>
                <D1>
                    <Number>شماره تلفن شما <span style={{color:"grey"}}>{user.phone_number}</span></Number>
                    <Email>نشانی ایمیل شما <span style={{color:"grey"}}>{user.email}</span></Email>
                </D1>
                </Detail>
            </DetailContainer>
        </Container>
        </>
    ) : (
        <div style={{width:"100%", height:"100%", background:"#fff", display:"flex"}}>
            <Loader
            type="Oval"
            color="#F4DD4F"
            height={50}
            width={50}
            timeout={3000} //3 secs
            style={{margin: "auto"}}
            />
        </div>
    );
}

export default Details;