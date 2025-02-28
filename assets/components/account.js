import '../styles/account.css';
import React, { useEffect, useState } from 'react';
import patient from '../../assets/images/patient.JPG';
import centre from '../../assets/images/centre.JPG';
import Historic from "./historic";
import Button from 'react-bootstrap/Button';

const patients = '/patient/account/rdv';
const informations = '/patient/account/rdv';

const Account = () => {
    const [patientInfo, setPatientInfo] = useState(null);
    const [error, setError] = useState(null);
    const userId = localStorage.getItem('userId');
    const idUser = userId - 1;
    console.log(userId);
    
    useEffect(() => {
        // Remplace l'ID par le bon ID du patient à récupérer
      // Exemple d'ID
        fetch(`https://localhost:8000/patient/account/api_patient/${idUser}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    setError(data.error);
                } else {
                    setPatientInfo(data);
                    console.log(data);
                }
            })
            .catch(err => {
                setError('Erreur lors de la récupération des données');
                window.location.href = `https://localhost:8000/secretary/account/new`
            });
    }, []);

    return (
        <>
            <div id="colum">
                <div id='accountPatient'>
                    <img id='head' src={centre} />
                    <div id='profile'>
                        <h1>Mon profile</h1>
                        <Button>Déconnexion</Button>
                    </div>

                    {/* Affichage de l'erreur, si elle existe */}
                    {error && <div className="error-message">{error}</div>}

                    <div id='information'>
                        {/* Vérification si patientInfo existe avant d'afficher les données */}
                        {patientInfo ? (
                            <ul>
                                <li>Bonjour !!! {patientInfo.data['genre']} {patientInfo.data['firstname']}</li>
                                <li>Adresse: {patientInfo.data['adresse']}</li>
                                <li>Tel: {patientInfo.data['phone']}</li>
                                <li>Email: {patientInfo.data['email']}</li>
                            </ul>
                        ) : (
                            <p>Chargement des informations...</p>
                        )}
                        <Button><a href={`/patient/account/${patientInfo?.data?.id}/edit`}>Modifier mes informations</a></Button>
                        <Button><a href={patients}>Prendre un rendez-vous</a></Button>
                    </div>

                    <div id='photo'>
                        <img src={patient} />
                    </div>
                </div>

                <div id='table'>
                    <Historic />
                </div>
                <footer>
                    <h4>copyright Maurice Olivier</h4>
                    <a href='#'>Condition générale</a>
                    <div></div>
                </footer>
            </div>
        </>
    );
};

export default Account;
