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

    <div id="formRe">
        <form action="/patient/account/new" method="POST">

            <label for="civilite">Civilité :</label>
            <select id="civilite" name="civilite">
                <option value="monsieur">Monsieur</option>
                <option value="madame">Madame</option>
                <option value="autre">Autre</option>
            </select>

            <label>Nom</label>
            <input type="text" name="name" id="name" required/>

            <label>Prénom</label>
            <input type="text" name="firstname" id="firstname" required/>

            <label>Adresse</label>
            <input type='text' name="adresse" id="adresse" required/>

            <label>Tel</label>
            <input type='text' name="tel" id="tel" required/>

            <label>Email</label>
            <input type="email" name="email" id="email" required />

            <button>Inscrire</button>
        </form>
        <a href="#">Retour</a>
    </div>
    <footer>
        <h4>copyright Maurice Olivier</h4>
          <a href='#'>Condition général</a>
          <div></div>
    </footer>
        
      
     
        </>
    )
}

export default Register;