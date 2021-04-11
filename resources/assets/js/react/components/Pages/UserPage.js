import React, { useEffect, useState } from 'react'
import User from '../User';
import { dash, userDash } from '../../Data';
import Nsi from '../User/notsignedin';

const UserPage = () => {
    const [islogin, setIslogin] = useState(false);

    useEffect(() => {
        if(localStorage.getItem('token') == null){
            setIslogin(false);
        } else {
            setIslogin(true);
        }
    }, [])

    return (
        <>
        <div style={islogin ? {display:"unset"} : {display:"none"}}>
            <User {...dash} data={userDash} />
        </div>
        <div style={islogin ? {display:"none"} : {display:"unset"}}>
            <Nsi />
        </div>
        </>
    )
}

export default UserPage;