import '../styles/register.css';
import centre from '../../assets/images/centre.JPG';
import profile from '../../assets/images/profile.PNG';
import React, { useState } from "react";

const Register = () => {
    const [errorMessage, setErrorMessage] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const data = {
            genre: formData.get('civilite'),
            nom: formData.get('name'),
            prenom: formData.get('firstname'),
            adresse: formData.get('adresse'),
            tel: formData.get('tel'),
            email: formData.get('email'),
        };

        try {
            const response = await fetch("https://localhost:8000/patient/account/newPatient", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });
            const result = await response.json();
            console.log(result);
        } catch (error) {
            console.error('Erreur lors de la requête :', error);
            setErrorMessage("Une erreur est survenue lors de l'inscription.");
        }
    };

    return (
        <>
            {errorMessage && <p style={{ color: 'red' }}>{errorMessage}</p>}

            <div id="regi">
                <img src={centre} alt="logo du cabinet" />
                <div id="titleRegister">
                    <h1>Inscrire un nouveau patient</h1>
                </div>
                <img id="doc" src={profile} alt="photo" />
            </div>

            <div id="formRe">
                <form onSubmit={handleSubmit} method="POST">
                    <label htmlFor="civilite">Civilité :</label>
                    <select id="civilite" name="civilite">
                        <option value="monsieur">Monsieur</option>
                        <option value="madame">Madame</option>
                        <option value="autre">Autre</option>
                    </select>

                    <label>Nom</label>
                    <input type="text" name="name" id="name" required />

                    <label>Prénom</label>
                    <input type="text" name="firstname" id="firstname" required />

                    <label>Adresse</label>
                    <input type="text" name="adresse" id="adresse" required />

                    <label>Tel</label>
                    <input type="text" name="tel" id="tel" required />

                    <label>Email</label>
                    <input type="email" name="email" id="email" required />

                    <button type="submit">Inscrire</button>
                </form>
                <a href="/secretary/account">Retour</a>
            </div>

            <footer>
                <h4>copyright Maurice Olivier</h4>
                <a href="#">Condition général</a>
                <div></div>
            </footer>
        </>
    );
};

export default Register;
