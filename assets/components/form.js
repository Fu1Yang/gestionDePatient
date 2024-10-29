import React from "react";

function Form(){

    return (
        <>
        <form>
        <fieldset>
            <label>Identifiant</label>
            <input type="text" name="identifiant" id="identifiant" placeholder="Name" required/>
    
            <label>mot de passe</label>
            <input type="password" name="password" id="password" placeholder="mot de passe" required/>
            <button>Se Connecter</button>
        </fieldset>
        <a href="#">Récupérer son mot de passe</a>
        </form>
       
        </>
    )  
}

export default Form;