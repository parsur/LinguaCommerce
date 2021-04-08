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
    Button
} from './DetailsElements';
import Edit from './edit detail';
import api from '../../../api';
import Loader from "react-loader-spinner";

const Details = ({
    dashboardName,
    mobileNumber,
    emailAddress,
    created,
    edited,
}) => {
    const [edit, setEdit] = useState(false);
    const changeEdit = () => {
        setEdit(!edit);
    }
    
    const [user, setUser] = useState();

    useEffect(() => {
        api("api/user/show")
            .then(({ user }) => {
                setUser(user);
            })
    }, []);

    // const list = user(({ phone_number, email, i }) => {
    //     return  <D1 key={i}>
    //                 <Number>شماره تلفن شما :<span style={{color:"grey"}}>{phone_number}</span></Number>
    //                 <Email>نشانی ایمیل شما :<span style={{color:"grey"}}>{email}</span></Email>
    //             </D1>
    // })

    /* const [user, setUser] = useState([]);

    useEffect(() => {
        // here is fetch id. change it if you want
        fetch("http://sararajabi.com/user/show")
        .then(res => res.json())
        .then((data) => {
          setUser(data.user);
        })
      }, []);

    const list = user.map(({ name, email, phone_number, i }) => {
        return  <D1 key={i}>
                    <Number>شماره تلفن شما :<span style={{color:"grey"}}>{phone_number}</span></Number>
                    <Email>نشانی ایمیل شما :<span style={{color:"grey"}}>{email}</span></Email>
                </D1>

    }); */

    return user ? (
        <>
        <div style={(edit) ? {display:"none"} : {display:"unset"}}>
        <Container>
            <NameContainer>
                <H1>{user.name}</H1>
            </NameContainer>
            <DetailContainer>
                <Detail>
                <D1>
                    <Number>شماره تلفن شما :<span style={{color:"grey"}}>{user.phone_number}</span></Number>
                    <Email>نشانی ایمیل شما :<span style={{color:"grey"}}>{user.email}</span></Email>
                </D1>
                    <D2>
                        <Created>تاریخ ساخت اکانت: <span style={{color:"grey"}}>{user.created_at}</span></Created>
                        <Edited>تاریخ آخرین ویرایش: <span style={{color:"grey"}}>{user.updated_at}</span></Edited>
                    </D2>
                    <D3>
                        <Button onClick={changeEdit}>
                            ویرایش داده ها
                        </Button>
                    </D3>
                </Detail>
            </DetailContainer>
        </Container>
        </div>
        <div style={(edit) ? {display:"unset"} : {display:"none"}}>
            <Edit 
                dashboardName={dashboardName}
                mobileNumber={mobileNumber}
                emailAddress={emailAddress}
                created={created}
                edited={edited}
                notEdit={() => setEdit(!edit)} />
        </div>
        </>
    ) : (
        <div style={{width:"100%", height:"100%", display:"flex"}}>
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
