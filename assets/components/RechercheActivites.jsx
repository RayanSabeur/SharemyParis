import "react-loader-spinner/dist/loader/css/react-spinner-loader.css";

import React, { useRef, useState } from "react";

import Highlighter from "react-highlight-words"; //composant pour mettre en avant les lettres matchant avec la recherche
import { IoCloseCircleSharp } from "react-icons/io5"; // un icone venant de react-icons

import Loader from "react-loader-spinner"; // le loader d'attente
import axios from "axios"; //pour la requête

export function RechercheActivites() {
  const timerRef = useRef(null); // je stockerai plus tard le setTimeout qui determinera si on a arrêter de taper dans le champs
  const [results, setResults] = useState([]); //le tableau, initialement vide, dans lequel je vais stocker les résultats de ma requête
  const [query, setQuery] = useState(""); // la variable contenant mon text de recherche 
  const [searching, setSearching] = useState(false); // l'état définissant si la recherche est cours (initialement false)
  const [showList, setShowList] = useState(false); // l'état définissant si la div affichant les résultats est visible ou non (initialement false)

  const [publicAccess, setPublicAccess] = useState("");
  const handleRequest = async (search) => {

    if (search) {
      const response = await axios.get(
        `/activites/api/${encodeURIComponent(search)}`
      );
      console.log("🚀 ~ file: RechercheActivites.jsx", response.data);
      setResults(response.data);
      setSearching(false);
    }
  };

  const handleRequest2 = async (filtre) => { //filtre est un objet ici filtre.searchText et filtre.price
    if (filtre.searchText) {
      const response = await axios.get(
        `/activites/api/searchquery`, { //l'url ne change jamais
          params: {
            query: encodeURIComponent(filtre.searchText), //on peut mettre autant de paramètres qu'on le souhaite  ==>    q: encodeURIComponent(search), maData2: "test2", maData3: "test3"
            publicAccess: filtre.publicAccess
          }
        }
      );
      setResults(response.data);
      setSearching(false);
    }
  };

  const handleClick = () => {
    !showList && query.length > 0 && setShowList(true);
  };
  const handleChange = (e) => {
    let searchText = e.target.value;
    setSearching(true);
    setShowList(searchText);
    setQuery(searchText);

    timerRef.current && clearTimeout(timerRef.current);
    timerRef.current = setTimeout(() => {
      // handleRequest(searchText);
      handleRequest2({searchText: searchText, publicAccess: publicAccess});
    }, 1000);
  };
  const handleKeyDown = (e) => {
      console.log(e);
    e.keyCode === 27 &&
      (query.length > 0 && !showList ? setQuery("") : setShowList(false));
      timerRef.current && clearTimeout(timerRef.current);

      if (e.keyCode === 13){

       // console.log(`http://localhost:8000/activites/listall/${encodeURIComponent(query)}/${publicAccess}`);
        document.location = `/activites/listall/${encodeURIComponent(query)}/${publicAccess}`
      }
  };
  const clearSearch = () => {
    setSearching(false);
    setShowList(false);
    setQuery("");
  };
  const handleSelect = (id) => {
    console.log(`Vous avez cliqué sur : ${id}`);
    setShowList(false);
  };

  const handlePublicChange = (e) =>  {
    setPublicAccess(e.target.value);
  }
  return (
    <>
      <div className="topbar">
        {query && ( // si query n'est pas vide ==> 
          <IoCloseCircleSharp onClick={clearSearch} className="searchIcon" />
        )}
      <img class="logo" src="/image/LOGO.svg" alt="logo"></img>
      <div class="div-searchbar">
        <label for="searchbar" class="searchbar">  
        <input
          className="searchBar"
          type="text"
          value={query} // l'input doit être contrôlé pour pouvoir le vider quand j'en ai envie 
          placeholder="Chercher une activité / un lieu"
          style={{ width: "100%" }}
          name="searchbar"
          class="champs .input-1-col"
          onChange={handleChange}
          onKeyDown={handleKeyDown}
          onClick={handleClick}
        />
        </label>
        <a href="#"><button class="filtre"></button></a>
        </div>
      </div>
      <div>
        <select
          value={publicAccess}
          name="publicAccess"
          title="Acces public"
          onChange={handlePublicChange}
        >
          <option value="">Aucun filtre</option>
          <option value="famille">Famille</option>
          <option value="groupe"> groupe</option>
        </select>
      </div>

      {showList && (
        <div
          style={{
            width: "37%",
            position: "absolute",
            left:"29%",
            top:"80px",
         
          }}
        >
          <ul
            style={{
              height: "12rem",
              listStyleType: "none",
              backgroundColor: "white",
              color: "darkgray",
              display: "flex",
              padding: "1rem",
              flexDirection: "column",
              textAlign: !searching ? "left" : "center",
            }}
          >
            {results.length > 0 && !searching ? (
              results.map((res, index) => {
                return (
                  <li
                    key={index}
                    className="resultLine"
                    onClick={() => handleSelect(res.id)}
                  >
                    <a href={`/activites/${res.id}`}>
                    <Highlighter
                      highlightClassName="highlistClass"
                      searchWords={query.split(" ")} // on attend un tableau de mot donc on utilise split pour couper notre chaine de caractère à chaque espace
                      autoEscape={true}
                      textToHighlight={res.titre} // je demande à vérifier dans res.nom si un des mots ou des mots venant de query correspond(ent)
                    />
                    </a>
                  </li>
                );
              })
            ) : !searching && query ? (
              <li>Aucun résultat</li>
            ) : (
              <li>
                <Loader
                  type="ThreeDots"
                  color="#8BCAD4"
                  height={40}
                  width={40}
                />
              </li>
            )}
          </ul>
        </div>
      )}
    </>
  );
}
