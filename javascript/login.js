var firebaseConfig = {
    "your firebase config": "insert here"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();
const db = firebase.firestore();
//hlavna stranka
//zistuje ci uz si lognuty
function start(name) {
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) {
        return window.location.href = '/economy/logged_in/';
    }
}
//login
function prihlasenie() {
    let menoo = document.getElementById('hl_meno').value;
    let heslo = document.getElementById('hl_heslo').value;
    const db = firebase.firestore();
    db.collection('web').doc(menoo).get().then((a) => {
        if (a.exists) {
            let d_meno = a.data().meno;
            let d_id = a.data().idcko;
            let d_heslo = a.data().heslo;
            let rolicka = a.data().rola;
            if (!d_id) {
                document.getElementById('hl_textik').style.opacity = "1";
                document.getElementById('hl_textik').innerText = "Tvoja regestrácia ešte nie je dokončená.";
                setTimeout(function() {
                    document.getElementById('hl_textik').style.opacity = "0"
                }, 7000);
                return;
            }
            if (d_meno == menoo && d_heslo == heslo) {//uspesne prihlasenie
                document.cookie = "meno=" + d_meno + ";path=/";
                document.cookie = "id=" + d_id + ";path=/";
                document.cookie = "rola=" + rolicka + ";path=/";
                return window.location.href = "/economy/logged_in/";
            } else {
                document.getElementById('hl_textik').style.opacity = "1";
                document.getElementById('hl_textik').innerText = "Zadal si nesprávne heslo";
                setTimeout(function() {
                    document.getElementById('hl_textik').style.opacity = "0"
                }, 7000);
                return false;
            }
        } else {
            document.getElementById('hl_textik').style.opacity = "1";
            document.getElementById('hl_textik').innerText = "Ľutujeme, ešte u nás nemáš vytvorený web účet";
            setTimeout(function() {
                document.getElementById('hl_textik').style.opacity = "0"
            }, 7000);
            return false;
        }
    });
}

function go_registracia() {
    window.location.href = '/registracia/';
}

function go_prihlasenie() {
    window.location.href = '/prihlasenie/';
} 
//zabudnute_heslo
function makeid(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
} //reset hesla
function potvrdenie() {
    let heslo = document.getElementById('zab_hes').value;
    let heslo2 = document.getElementById('zab_hes2').value;
    let meno = document.getElementById('zab_meno').value;
    if (meno == '') return document.getElementById('resetik').innerText = "Nezadal si Discord meno";
    if (heslo == '' || heslo2 == '') return document.getElementById('resetik').innerText = "Nezadal si heslo";
    if (heslo.length < 6 || heslo2.length < 6) return document.getElementById('resetik').innerText = "Heslo nesmie mať menej ako 6 znakov";
    if (heslo === heslo2) {
        const db = firebase.firestore();
        const textik = document.getElementById('resetik');
        db.collection('web').doc(meno).get().then((a) => {
            if (a.exists) {
                let kod = makeid(4);
                db.collection('web').doc(meno).update({
                    reset: kod,
                    heslo_na_zmenu: heslo,
                });
                document.getElementById('resetik').innerHTML = "Tvoj kód na reset je " + kod + "<br>Na Discorde zadaj *web-reset " + kod;
            } else {
                return document.getElementById('resetik').innerText = "Ľutujeme, tvoj Discord účet ešte nemá vytvorený web účet u nás";
            }
        });
    } else {
        document.getElementById('resetik').innerText = "Tvoje heslá sa nezhodujú";
    }
} //registracia
async function registracia() {
    let heslo = document.getElementById('reg_heslo').value;
    let heslo2 = document.getElementById('reg_heslo2').value;
    let meno = document.getElementById('reg_meno').value;
    if (meno == '') return document.getElementById('reg_textik').innerText = "Nezadal si Discord meno";
    if (heslo == '' || heslo2 == '') return document.getElementById('reg_textik').innerText = "Nezadal si heslo";
    if (heslo.length < 6 || heslo2.length < 6) return document.getElementById('reg_textik').innerText = "Heslo nesmie mať menej ako 6 znakov";
    if (heslo === heslo2) {
        const db = firebase.firestore();
        db.collection('web').doc(meno).get().then(async(k) => {
            if (k.exists) return document.getElementById('reg_textik').innerText = "Už máš vytvorený web účet";

            const kolekcia = db.collection('economy');
            const dokument = await kolekcia.where('meno', '==', meno).get();
            if(dokument.empty){
                return document.getElementById('reg_textik').innerText = "Ľutujeme, ale zadané meno nemá u nás vytvorený discord economy účet";
            }
            let resetkod = makeid(4);
            db.collection('web').doc(meno).set({
                "meno": meno,
                "heslo": heslo,
                "reg_kod": resetkod,
            });
            document.getElementById('reg_textik').innerHTML = "Tvoj kód na registráciu je " + resetkod + "<br>Na Discorde zadaj *web-register " + resetkod;
        });
    } else {
        document.getElementById('reg_textik').innerText = "Tvoje heslá sa nezhodujú";
    }
}