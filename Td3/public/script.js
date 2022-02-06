// "MAIN"

const lattitude = 48.692114
const longitude = 6.184279
document.addEventListener("DOMContentLoaded", async function () {
    displayMap(lattitude ,longitude);
    addYouAreHere()
    getParkings()
});

let map;

//Affichage de la carte sur Nancy
function displayMap(lat, lon) {
    mapboxgl.accessToken = 'pk.eyJ1IjoiY2xlbWVudDYwYiIsImEiOiJja3o3MXF1OWswaG82Mm9zOHUzcHB6NXVyIn0.WjCEW4HXjvKhqBk72cBPmw';
    map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [lon, lat],
        zoom: 15
    });
}

//Ajout du marker rouge "vous êtes ici"
async function addYouAreHere() {
    const lat = 48.69211422805919;
    const lon = 6.184279819931009;
    //createPoint(lat, lon, 'Vous êtes ici', 'Géolocalisation du client', 'url(./assets/images/1072465.png)')
    const el = document.createElement('div');
    el.style.width = `15px`;
    el.style.height = `20px`;
    const popup = new mapboxgl.Popup({ offset: 25 }).setText(
        `Vous êtes ici !`
    );
    new mapboxgl.Marker({ color: 'red' })
        .setLngLat([lon, lat])
        .setPopup(popup)
        .addTo(map)
}

// Récupération des parkings
async function getParkings() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', "./getParkings.php", true);
    xhr.responseType = 'json';
    xhr.send();
    // les données arrivent correctement
    xhr.addEventListener("load", function (response) {
        addParkings(response.target.response);
    });
    // on a un code d'erreur
    xhr.addEventListener("error", function (response) {
        console.log('erreur: ' + response);
    });
}

// Ajout des parkings à la carte
async function addParkings(parkings) {
    parkings.forEach(parking => {
        addParkingMarker(parking)
    });
}

//Fonction d'ajout d'un marker
function addParkingMarker(parking) {
    const popup_logo = document.createElement('div');
        popup_logo.style.width = `40px`;
        popup_logo.style.height = `60px`;
        popup_logo.style.backgroundSize = '100%';
        popup_logo.style.backgroundRepeat = 'no-repeat'
        popup_logo.style.backgroundImage = 'url(./assets/images/1072465.png)';
    

    const popup_title = document.createElement("h1");
        popup_title.innerText = parking.attributes.NOM

    const popup_description = document.createElement("p");
        popup_description.innerHTML = `capacité : ${parking.attributes.CAPACITE}
            <br/> places: ${parking.attributes.PLACES}`
        
    const popup_button = document.createElement("button");
        popup_button.setAttribute("id","test")
        popup_button.innerText="voir les commentaires";
        popup_button.addEventListener("click", function(){
            displayComments(parking)
            addInputForComment(parking)
        })

    const popup_div = document.createElement("div");
        popup_div.appendChild(popup_title);
        popup_div.appendChild(popup_description);
        popup_div.appendChild(popup_button);

    const popup = new mapboxgl.Popup({ offset: 25 }).setDOMContent(
        popup_div
    );
    
    new mapboxgl.Marker(popup_logo).setLngLat([parking.geometry.x, parking.geometry.y]).setPopup(popup).addTo(map);
}

// Ajout des eventListener sur les markers
async function addEventClicks(parkings) {
    parkings.forEach(parking => {
        const button = document.getElementById(`btn-${parking._id.$oid}`)
        button.addEventListener("click", function(){
        })
    })
}

// Ajout de l'input pour les commentaires
function addInputForComment(parking){
    const formComment = document.createElement('form');
        formComment.method='post'
        formComment.name="form_comment"
        formComment.action="/postComment.php"
    const inputComment = document.createElement('input')
        inputComment.name="input_comment"
        inputComment.setAttribute("id", "input_comments")
        inputComment.setAttribute("type", "text")
        inputComment.setAttribute("required", "required")
    const inputID = document.createElement('input')
        inputID.name="input_id"
        inputID.setAttribute('id', "input_id")
        inputID.setAttribute("type", "hidden")
        inputID.value=parking._id.$oid
    const buttonSubmit = document.createElement('button')
        buttonSubmit.innerText="Envoyer"
        buttonSubmit.setAttribute("type", "submit")
    const div_comments = document.getElementById('div_input_comments')
    div_comments.innerHTML=""
    div_comments.appendChild(formComment)
    formComment.appendChild(inputComment)
    formComment.appendChild(inputID)
    formComment.appendChild(buttonSubmit)
}

// Affichage des commentaires
function displayComments(parking){
    const divComments = document.getElementById('div_comments')
        divComments.innerHTML=""
    if (parking.comments){
        parking.comments.forEach(comment => {
            const p_comment = document.createElement("p");
            p_comment.innerText = comment
            divComments.appendChild(p_comment)
        });
    }
}