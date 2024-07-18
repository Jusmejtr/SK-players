var firebaseConfig = {
    "your firebase config": "insert here"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();
const db = firebase.firestore();
///////////////////////////////////////////////
function reset() {
    window.location.reload();
}
function gologo() {
    return window.location.href = '../logged_in/'
}
//////////////////////////////////////////////////
function loadCookies(name) {

    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) {
        document.getElementById('hla_textik').innerText = match[2];
    } else {
        return window.location.href = '../prihlasenie/';
    }
}
/////////
function auto_refresh_coinov(kedy, id) {
    setInterval(function() {
        db.collection('economy').doc(id).get().then((s) => {
            let peniazky = s.data().money;
            document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
        });
    }, kedy);
}
///////////////
function log_start(name, id, rola) {
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) {

    } else {
        return window.location.href = '../prihlasenie/';
    }
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    if (zhoda) {
        let idcko = zhoda[2];
        auto_refresh_coinov(2500, idcko);

    }
    var zhoda2 = document.cookie.match(new RegExp('(^| )' + rola + '=([^;]+)'));
    if (zhoda2) {
        let rola = zhoda2[2];
        if (rola == "Owner") return document.getElementById('log-uvod').innerText = "Vitaj, [Owner] " + match[2];
        else if (rola == "Helper") return document.getElementById('log-uvod').innerText = "Vitaj, [Helper] " + match[2];
        else if (rola == "Developer") return document.getElementById('log-uvod').innerText = "Vitaj, [Developer] " + match[2];
        else if (rola == "SBS") return document.getElementById('log-uvod').innerText = "Vitaj, [SBS] " + match[2];
        else if (rola == "VIP") return document.getElementById('log-uvod').innerText = "Vitaj, [VIP] " + match[2];
        else return document.getElementById('log-uvod').innerText = "Vitaj, " + match[2];
    }

}

function odhlasenie() {
    document.cookie = "meno=" + "; Path=/";
    document.cookie = "id=" + "; Path=/";
    document.cookie = "rola=" + "; Path=/";
    return window.location.href = '/';
}