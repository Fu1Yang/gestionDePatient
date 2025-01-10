import React from 'react';

const Planning = ()=> {
    return(
        <>
        <div id='title'>
            <h1>Historique des rdv</h1>
        </div>
        <div id='array'>
            <table>
                <thead>
                    <tr>
                        <th scope='col'>Date des rdv</th>
                        <th scope='col'>Les horaires</th>
                        <th scope='col'>Le motif du rdv</th>
                        <th scope='col'>Nom des patients</th>
                        <th scope='col'>Annuler un rdv</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope='row'>Le 26/10/2024</th>
                        <td>09h00</td>
                        <td>Controle de routine</td>
                        <td>Tom</td>
                        <td><button>Annuler le rdv</button></td>
                    </tr>
                    <tr>
                        <th scope='row'>Le 20/11/2024</th>
                        <td>09h30</td>
                        <td>Resultat des prises de sang</td>
                        <td>Yang Fu</td>
                        <td><button>Annuler le rdv</button></td>
                    </tr>
                    <tr>
                        <th scope='row'>Le 03/03/2025</th>
                        <td>13h00</td>
                        <td>resultat colocospie</td>
                        <td>Xiong laura</td>
                        <td><button>Annuler le rdv</button></td>
                    </tr>
                    <tr>
                        <th scope='row'>Le 15/04/2025</th>
                        <td>13h30</td>
                        <td>Controle de routine</td>
                        <td>Norbet</td>
                        <td><button>Annuler le rdv</button></td>
                    </tr>
                    <tr>
                        <th scope='row'>Le 30/10/2025</th>
                        <td>14h20</td>
                        <td>Controle vaginal</td>
                        <td>Lana coxx</td>
                        <td><button>Annuler le rdv</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </>
    )
};

export default Planning;