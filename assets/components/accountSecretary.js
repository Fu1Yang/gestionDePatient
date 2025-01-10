import '../styles/account.css';
import React, { useEffect, useState } from 'react';
import secretaire from '../../assets/images/secretaire.PNG';
import centre from '../../assets/images/centre.JPG';
import Planning from "./calendrier";




const AccountSecret = ()=> {
    const [genres, setGenres] = useState([]);

    useEffect(() => {
      fetch('/api_secretary') // L'API Symfony que tu as définie
        .then((response) => response.json())
        .then((data) => setGenres(data)) // Les genres sont directement renvoyés en JSON
        .catch((error) => console.error('Error fetching genres:', error));
    }, []);
  

    
    return (
        <>
    <div id="colum" >
        <div id='accountPatient'>
            <img id='head' src={centre} />
            <div id='profile'>
                <h1>compte: secrétaire</h1>
                <button>Déconnexion</button>
            </div>
            <div id='information'>
                <ul>
                    <li>Bienvenue, {genres.name}!</li>
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