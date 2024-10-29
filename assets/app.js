import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './components/app';


// Vérifiez que les éléments DOM existent avant de créer les roots
const rootElement = document.getElementById('root');

if (rootElement) {
  const root = ReactDOM.createRoot(rootElement);
  root.render(
    <React.StrictMode>
      <App />
    </React.StrictMode>
  );
}