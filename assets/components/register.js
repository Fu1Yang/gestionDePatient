import React from "react";
import '../styles/register.css';
import centre from '../../assets/images/centre.JPG';
import profile from '../../assets/images/profile.PNG';

const Register = ()=>{
    return(
        <>
    <div id="regi">
        <img src={centre} alt="logo du cabinet"/>
        <div id="titleRegister">
            <h1>Inscrire un nouveau patient</h1>
        </div>
        <img id="doc" src={profile} alt="photo"/>
    </div>
        
      
     
        </>
    )
}

export default Register;