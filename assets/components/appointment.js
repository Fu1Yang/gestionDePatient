import React from 'react';
import '../styles/appointment.css';
import '../styles/calendrier.css';
import Calendar from './calendier';
import centre from '../../assets/images/centre.JPG';
import patient from '../../assets/images/patient.JPG';


const Rdv = ()=> {
    const returnProfile = '/patient/account/';
    return (
        <>
        <div id='logo'>
            <div id='logoAdresse'>
                <img  src={centre} alt='logo du centre'/>   
            </div>
            <div id='available'>
                <div id='link'>
                    <a href={returnProfile}>retour au profile</a>
                </div>
                <div id='array1'>
                    <div className='col'><p className='array1'></p><p className='pa'>ne travaile pas</p></div>
                    <div className='col'><p className='array2'></p><p className='pa'>complet</p></div>
                    <div className='col'><p className='array3'></p><p className='pa'>disponible</p></div>
                </div>
            
            </div>
            <h2>Bonjour Mr: Yang fu</h2>
            <div id='head'>
                <img  src={patient} alt=' photo de profile du patient'/>
            </div>
           
        </div>
        <div id='take'>
            <Calendar></Calendar>
            <form>
                <label>Motif du rendez-vous*</label>
                 <textarea required/>
                <button id='send'>envoyer</button>
            </form>
        </div>
        <footer>
        <h4>copyright Maurice Olivier</h4>
          <a href='#'>Condition général</a>
          <div></div>
        </footer>
       
        </>
    )
};

export default Rdv;