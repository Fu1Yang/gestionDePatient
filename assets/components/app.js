import React, { useState } from 'react';
import '../styles/app.css';
import centre from '../../assets/images/centre.JPG';
import profile from '../../assets/images/profile.PNG';
import Form from "./form";

const App = () => {
    const [errorMessage, setErrorMessage] = useState('');
    const [secretaryName, setSecretaryName] = useState('');
    
    const handleSubmit = async (e) => {
        e.preventDefault(); // Empêche le rechargement de la page
    
        const formData = new FormData(e.target);
        const data = {
            idUser: formData.get('identifiant'),
            passworduser: formData.get('password')
        };
    
        try {
            const response = await fetch("http://localhost:8000/verification", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
    
            const result = await response.json();
    
            if (!response.ok) {
                setErrorMessage(result.message || 'Une erreur est survenue');
            } else {
                console.log('Connexion réussie :', result);
                setErrorMessage(''); // Réinitialise le message d'erreur
                if (result.userInfo) {
                    // Met à jour l'état avec toutes les informations de l'utilisateur
                    setSecretaryName(result.userInfo.secretaryName); // Récupère le nom de la secrétaire
                    // Enregistre les autres informations dans l'état ou dans le localStorage si nécessaire
                    localStorage.setItem('userInfo', JSON.stringify(result.userInfo));
                }
                window.location.href = result.redirectUrl; // Redirige vers l'URL fournie dans la réponse
            }
        } catch (error) {
            console.error('Erreur lors de la requête :', error);
            setErrorMessage('Une erreur de connexion est survenue.');
        }
    };
    

    return (
        <>
            <div id='header'>
                <div id="logoAdresse">
                    <img src={centre} alt='logo du cabinet' />
                    <ul>
                        <li>Docteur M.Maurice OLIVIER</li>
                        <li>26 BOULEVARD JEAN LYON 67000 Mars</li>
                        <li>02.47.67.64.87</li>
                    </ul>
                </div>
                <img id='head' src={profile} alt='photo de profile' />
            </div>

            <div id='para'>
                <p>
                    Pour les nouveaux patients, il est nécessaire de prendre le premier rendez-vous en personne lors des heures 
                    d’ouverture du secrétariat. Cela permet de vérifier les informations nécessaires et de répondre à toutes vos 
                    questions que vous pourriez avoir.
                </p>
            </div>

            {errorMessage && <div className="error-message">{errorMessage}</div>}

            <Form handleSubmit={handleSubmit} />

            <footer>
                <h4>copyright Maurice Olivier</h4>
                <a href='#'>Condition général</a>
                <div></div>
            </footer>
        </>
    );
};

export default App;
