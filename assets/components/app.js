import '../styles/app.css';
import React from 'react';
import Form from "./form";
import centre from '../../assets/images/centre.JPG';
import profile from '../../assets/images/profile.PNG';

const App = () => {
    return (
        <>
        <div id='header'>
            <div id="logoAdresse">
                <img src={centre} alt='logo du cabinet' />
                <ul>
                    <li>Docteur M.Maurice OLIVIER</li>
                    <li>26 BOULEVARD JEAN LYON 67000 Mars</li>
                    <li>02.47.67.64.87 </li>
                </ul>
            </div>
            <img id='head' src={profile}  alt='photo de profile'  />
        </div>
 
        <div id='para'>
            <p>Pour les nouveaux patients, il est nécessaire de prendre le premier rendez-vous en personne lors des heures 
            d’ouverture du secrétariat.
            Cela permet de vérifier les informations nécessaires et de répondre à toutes vos  questions 
            que vous pourriez avoir.</p>
        </div>
  
    
    <Form></Form>
    <footer>
        <h2>copyright Maurice Olivier</h2>
          <a href='#'>Condition général</a>
          <div></div>
          </footer>
    </>
);

};

export default App; // Assure-toi d'avoir cette ligne