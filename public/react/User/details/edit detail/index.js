import React from 'react';
import {
    Container,
    NameContainer,
    DetailContainer,
    H1,
    Detail,
    D1, D2, D3,
    Number, Email,
    Created, Edited,
    Button, Input
} from './EditElements';

const Edit = ({
    dashboardName,
    mobileNumber,
    emailAddress,
    created,
    edited,
    notEdit,
}) => {
    return (
        <Container>
            <NameContainer>
                <H1>نام شما : <Input type='text' style={{color:"grey"}} placeholder={dashboardName}/></H1>
            </NameContainer>
            <DetailContainer>
                <Detail>
                    <D1>
                        <Number>شماره تلفن شما :<Input type='text' style={{color:"grey"}} placeholder={mobileNumber}/></Number>
                        <Email>نشانی ایمیل شما :<Input type='text' style={{color:"grey"}} placeholder={emailAddress}/></Email>
                    </D1>
                    <D2>
                        <Created>تاریخ ساخت اکانت: <span style={{color:"grey"}}>{created}</span></Created>
                        <Edited>تاریخ آخرین ویرایش: <span style={{color:"grey"}}>{edited}</span></Edited>
                    </D2>
                    <D3>
                        <Button onClick={notEdit}>
                            ویرایش داده ها
                        </Button>
                    </D3>
                </Detail>
            </DetailContainer>
        </Container>
    )
}

export default Edit;
