import React from 'react';

const Historic = ()=> {
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
                        <th scope='col'>Le motif du rdv</th>
                        <th scope='col'>Conclusion du medecin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope='row'>Le 26/10/2024</th>
                        <td>Controle de routine</td>
                        <td>tout va bien</td>
                    </tr>
                    <tr>
                        <th scope='row'>Le 20/11/2024</th>
                        <td>Resultat des prises de sang</td>
                        <td>tout va bien</td>
                    </tr>
                    <tr>
                        <th scope='row'>Le 03/03/2025</th>
                        <td>Controle de routine</td>
                        <td>tout va bien</td>
                    </tr>
                    <tr>
                        <th scope='row'>Le 15/04/2025</th>
                        <td>Controle de routine</td>
                        <td>tout va bien</td>
                    </tr>
                    <tr>
                        <th scope='row'>Le 30/10/2025</th>
                        <td>Controle de routine</td>
                        <td>tout va bien</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </>
    )
};

export default Historic;