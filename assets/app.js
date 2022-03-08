/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../public/styles/app.css';
import React from "react";
import ReactDOM from "react-dom";
import {RechercheActivites, Map} from "./components";


function App(){
    return(
        <div  style={{ width: "30rem" }}>
        <RechercheActivites/> 
        </div>
    )
}

if(document.getElementById("root")){
    ReactDOM.render(<App />, document.getElementById("root"));

}

if(document.getElementById("rootMap")){
    console.log("TESTO");
    ReactDOM.render(<Map />, document.getElementById("rootMap"));
    // ReactDOM.render(<MapWithDriveRoute/>, document.getElementById("rootMap"));
}


