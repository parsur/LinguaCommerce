import React, { useState } from 'react';
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

const Details = ({
    dashboardName,
    mobileNumber,
    emailAddress,
    created,
    edited
}) => {
    const [edit, setEdit] = useState(false);
    const changeEdit = () => {
        setEdit(!edit);
    }
    return (
        <>
        <div style={(edit) ? {display:"none"} : {display:"unset"}}>
        <Container>
            <NameContainer>
                <H1>نام شما : {dashboardName}</H1>
            </NameContainer>
            <DetailContainer>
                <Detail>
                    <D1>
                        <Number>شماره تلفن شما :<span style={{color:"grey"}}>{mobileNumber}</span></Number>
                        <Email>نشانی ایمیل شما :<span style={{color:"grey"}}>{emailAddress}</span></Email>
                    </D1>
                    <D2>
                        <Created>تاریخ ساخت اکانت: <span style={{color:"grey"}}>{created}</span></Created>
                        <Edited>تاریخ آخرین ویرایش: <span style={{color:"grey"}}>{edited}</span></Edited>
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
    )
}

export default Details;
