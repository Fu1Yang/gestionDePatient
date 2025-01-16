import React from "react";

const Form = ({handleSubmit})=>{

    return (
        <>
        <form onSubmit={handleSubmit}>
        <fieldset>
            <label>Identifiant</label>
            <input type="text" name="identifiant" id="identifiant" placeholder="Name" required autoComplete="id"/>
    
            <label>mot de passe</label>
            <input type="password" name="password" id="password" placeholder="mot de passe" required autoComplete="new-password"/>
            
            <button type="submit">Se Connecter</button>
        </fieldset>
        <a href="#">Récupérer son mot de passe</a>
        </form>
       
        </>
    )  
}

export default Form;