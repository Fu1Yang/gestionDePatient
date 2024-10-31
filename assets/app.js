import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './components/app';
import Account from './components/account';
import Rdv from './components/appointment';


// Vérifiez que les éléments DOM existent avant de créer les roots
const rootElement = document.getElementById('root');
const accountElement = document.getElementById('account');
const rdv = document.getElementById('appointment');

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
