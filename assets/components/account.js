import '../styles/account.css';
import React from 'react';
import patient from '../../assets/images/patient.JPG';
import centre from '../../assets/images/centre.JPG';
import Historic from "./historic";

const Account = ()=> {
    const patients = '/patient/account/rdv';
    const informations = '/patient/account/rdv';
    return (
        <>
    <div id="colum">
        <div id='accountPatient'>
            <img id='head' src={centre} />
            <div id='profile'>
                <h1>Mon profile</h1>
                <button>Déconnexion</button>
            </div>
            <div id='information'>
                <ul>
                    <li>Bonjour Mr Yang Fu</li>
                    <li>Adresse: 28 bis Avenue aristide Briand 28200 Marboué</li>
                    <li>Tel: 06.60.75.23.22</li>
                    <li>Email: yang.fu@live.fr</li>
                </ul>
                <button><a href={patients}>Modifier mes informations</a></button>
                <button><a href={patients}>Prendre un rendez-vous</a></button>
            </div>
            <div id='photo'>
                <img src={patient} />
            </div>
        </div>

        <div id='table'>
         <Historic></Historic>
         </div>
            <footer>
                <h4>copyright Maurice Olivier</h4>
                <a href='#'>Condition général</a>
                <div></div>
            </footer>
        
    </div>
        </>
    )
};

export default Account;