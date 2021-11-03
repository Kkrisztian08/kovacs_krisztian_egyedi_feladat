function validacio() {
    let cim = document.getElementById('ciminput');
    let eloado = document.getElementById('eloadoinput');
    let stilus = document.getElementById('stilusinput');
    let hossz = document.getElementById('hosszinput');
    let megjelenes = document.getElementById('datuminput');

    let logikai = true;

    if (cim.value === "") {
        document.getElementById('hibaCim').innerHTML = "Cím megadása kötelező";
        logikai = false;
    } else if (nev.value !== "") {
        document.getElementById('hibaCim').innerHTML = "";
    }

    if (eloado.value === "") {
        document.getElementById('hibaEloado').innerHTML = "Az előadó megadása kötelező";
        logikai = false;
    } else if (nev.value !== "") {
        document.getElementById('hibaEloado').innerHTML = "";
    }

    if (stilus.value === "") {
        document.getElementById('hibaStilus').innerHTML = "A stílus megadása kötelező";
        logikai = false;
    } else if (nev.value !== "") {
        document.getElementById('hibaStilus').innerHTML = "";
    }

    if (hossz.value.length == 0) {
        document.getElementById('hibaHossz').innerHTML = "A hossz megadása kötelező";
        logikai = false;
    } else if (isNaN(magassag.value)) {
        document.getElementById('hibaHossz').innerHTML = "A hossznak számnak kell lennie";
        logikai = false;
    } else if (magassag.value.length != 0) {
        document.getElementById('hibaHossz').innerHTML = "";
    } else if (!isNaN(magassag.value)) {
        document.getElementById('hibaHossz').innerHTML = "";
    }

    if (megjelenes.value === "") {
        document.getElementById('hibaDatum').innerHTML = "A megjelenés dátuma megadása kötelező";
        logikai = false;
    } else if (szulDatum.value !== "") {
        document.getElementById('hibaDatum').innerHTML = "";
    }


    return logikai;
}
