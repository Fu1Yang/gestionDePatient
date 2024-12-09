import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './components/app';
import Account from './components/account';
import Rdv from './components/appointment';
import Register from './components/register';
import AccountSecret from './components/accountSecretary';


// Vérifiez que les éléments DOM existent avant de créer les roots
const rootElement = document.getElementById('root');
const accountElement = document.getElementById('account');
const rdv = document.getElementById('appointment');
const regist = document.getElementById('register');
const accountSecretaryElement = document.getElementById('accountSecretary');

if (rootElement) {
  const root = ReactDOM.createRoot(rootElement);
  root.render(
    <React.StrictMode>
      <App />
    </React.StrictMode>
  );
}

if (accountElement) {
  const account = ReactDOM.createRoot(accountElement);
  account.render(
    <React.StrictMode>
      <Account />
    </React.StrictMode>
  );
}

if (rdv) {
  const appointment = ReactDOM.createRoot(rdv);
  appointment.render(
    <React.StrictMode>
      <Rdv/>
    </React.StrictMode>
  )
}

if (regist){
  const register = ReactDOM.createRoot(regist);
  register.render(
    <React.StrictMode>
      <Register/>
    </React.StrictMode>
  )
}


if (accountSecretaryElement){
  const accountSecret = ReactDOM.createRoot(accountSecretaryElement);
  accountSecret.render(
    <React.StrictMode>
      <AccountSecret/>
    </React.StrictMode>
  )
}