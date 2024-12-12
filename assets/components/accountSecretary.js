import '../styles/account.css';
import React from 'react';
import secretaire from '../../assets/images/secretaire.PNG';
import centre from '../../assets/images/centre.JPG';
import Planning from "./calendrier";

const AccountSecret = ()=> {
    return (
        <>
    <div id="colum">
        <div id='accountPatient'>
            <img id='head' src={centre} />
            <div id='profile'>
                <h1>compte: secrétaire</h1>
                <button>Déconnexion</button>
            </div>
            <div id='information'>
                <ul>
                    <li>Bonjour Mr Céline Grande Dent</li>
                </ul>
                <button>Inscrire un nouveau patient</button>
            </div>
            <div id='photo'>
                <img src={secretaire} />
            </div>
        </div>

        <div id='table'>
         <Planning></Planning>
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

export default AccountSecret;