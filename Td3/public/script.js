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

//Fonction d'ajout d'un marker
function addParkingMarker(lat, long, parking) {

    const el = document.createElement('div');

    el.style.width = `40px`;
    el.style.height = `60px`;
    el.style.backgroundSize = '100%';
    el.style.backgroundRepeat = 'no-repeat'

    el.style.backgroundImage = 'url(./assets/images/1072465.png)';
    let popup_div = document.createElement("div");
    let popup_title = document.createElement("h1");
        popup_title.innerText = parking.attributes.NOM
    let popup_button = document.createElement("button");
        popup_button.setAttribute("id","test")
        popup_button.innerText="test";
        popup_button.addEventListener("click", function(){
            console.log("ah")
        })
        popup_div.appendChild(popup_title);
        popup_div.appendChild(popup_button);
    const popup = new mapboxgl.Popup({ offset: 25 }).setDOMContent(
        popup_div
    );
        /* `<h1>${parking.attributes.NOM}</h1>
        <p>capacité : ${parking.attributes.CAPACITE}
            <br/> places: ${parking.attributes.PLACES}
            <br/> <button id="btn-${parking._id.$oid}">Voir les commentaires</button>
        </p>` */
    new mapboxgl.Marker(el).setLngLat([long, lat]).setPopup(popup).addTo(map);
    
}

//Ajout du marker rouge "vous êtes ici"
async function addYouAreHere() {
    let lat = 48.69211422805919;
    let lon = 6.184279819931009;
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

//Récupération des parkings
async function getParkings() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', "./getParkings.php", true);
    xhr.responseType = 'json';
    xhr.send();
    // les données arrivent correctement
    xhr.addEventListener("load", function (response) {
        addParkings(response.target.response);
        //addEventClicks(response.target.response);
    });
    // on a un code d'erreur
    xhr.addEventListener("error", function (response) {
        console.log('erreur: ' + response);
    });
}

//Ajout des parkings à la carte
async function addParkings(parkings) {

    parkings.forEach(parking => {
        console.log(parking)
        addParkingMarker(parking.geometry.y, parking.geometry.x, parking)
    });
}

//Ajout des eventListener
async function addEventClicks(parkings) {

    parkings.forEach(parking => {
        console.log(parking)
        let button = document.getElementById(`btn-${parking._id.$oid}`)
        console.log(`btn-${parking._id.$oid}`)
        button.addEventListener("click", function(){
            console.log("you clicked")
        })
    })
}

document.addEventListener("DOMContentLoaded", async function () {
    displayMap(48.692114, 6.184279);
    addYouAreHere()
    getParkings()
});