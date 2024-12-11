import React, { useState } from 'react';
import '../styles/app.css';
import centre from '../../assets/images/centre.JPG';
import profile from '../../assets/images/profile.PNG';
import Form from "./form";

const App = () => {
    const [errorMessage, setErrorMessage] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault(); // Empêche le rechargement de la page

        const formData = new FormData(e.target);
        const data = {
            idUser: formData.get('identifiant'), // Correspond à `name="identifiant"`
            passworduser: formData.get('password') // Correspond à `name="password"`
        };

        try {
            const response = await fetch("http://localhost:8000/verification", { // Remplacez par l'URL appropriée
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data) // Convertit l'objet en JSON
            });

            const result = await response.json();

            if (!response.ok) {
                // Affiche l'erreur si la réponse HTTP indique une erreur
                setErrorMessage(result.message || 'Une erreur est survenue');
            } else {
                console.log('Connexion réussie :', result);
                setErrorMessage(''); // Réinitialise le message d'erreur
                if (result.redirectUrl) {
                    window.location.href = result.redirectUrl; // Redirige vers l'URL fournie dans la réponse
                }

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
