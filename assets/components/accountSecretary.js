import '../styles/account.css';
import React, { useEffect, useState } from 'react';
import secretaire from '../../assets/images/secretaire.PNG';
import centre from '../../assets/images/centre.JPG';
import Planning from "./calendrier";

const AccountSecret = () => {
    const [secretary, setSecretary] = useState(null);
    const [error, setError] = useState(null);

    useEffect(() => {
        // Remplace l'ID par le bon ID du secrétaire à récupérer
        const secretaryId = 1; // Exemple d'ID
        fetch(`https://localhost:8000/secretary/account/api_secretary/${secretaryId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    setError(data.error);
                } else {
                    setSecretary(data);               
                }
            })
            .catch(err => {
                setError('Erreur lors de la récupération des données');
            });
    }, []);



    if (error) {
        return <div>{error}</div>;
    }

    if (!secretary) {

        return <div>Loading...</div>;
    }
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
                <h2>Bienvenue</h2>
                <p>{secretary.data['genre']} {secretary.data['firstname']} {secretary.data['name']}!</p>
                <p>Adresse: {secretary.data['adresse']}</p>
                <p>Email: {secretary.data['email']}</p>
                <p>Telephone: {secretary.data['phone']}</p>
                <button><a href='/registration'>Inscrire un nouveau patient</a></button>
                <button><a href='/new'>Identifiant et mot de passe temporaire</a></button>
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