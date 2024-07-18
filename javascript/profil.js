var firebaseConfig = {
    "your firebase config": "insert here"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();
const db = firebase.firestore();

function msToTime(duration) {
    var milliseconds = parseInt((duration % 1000) / 100),
    seconds = Math.floor((duration / 1000) % 60),
    minutes = Math.floor((duration / (1000 * 60)) % 60),
    hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;
    return hours + "h " + minutes + "m " + seconds + "s";
}

function auto_refresh_coinov(kedy, id) {
    setInterval(function () {
        db.collection('economy').doc(id).get().then((s) => {
            let peniazky = s.data().money;
            document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
        });
    }, kedy);
}

function pro_start(name, id, rola) {
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    let meno;
    if (match) {
        meno = match[2];
    } else {
        return window.location.href = '/prihlasenie/';
    }
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    if (zhoda) {
        let idcko = zhoda[2];
        auto_refresh_coinov(2000, idcko);

        //vip
        db.collection('nakupy2').doc(idcko).get().then((f) => {
            if (f.exists) {
                let do_kedy = f.data().platnostnakupu;
                setInterval(() => {                    
                    let trvanie = do_kedy - Date.now();
                    if (trvanie < 0) {
                        document.getElementById("VIP_result").innerText = "VIP ending soon";
                    } else {
                        document.getElementById("VIP_result").innerText = msToTime(trvanie);
                    }
                }, 1000);
            } else {
                document.getElementById("VIP_result").innerText = "None";
            }
        });
        //farebne meno
        db.collection('nakupy').doc(idcko).get().then((f) => {
            if (f.exists) {
                let do_kedy = f.data().platnostnakupu;
                setInterval(function () {
                    let trvanie = do_kedy - Date.now();
                    if (trvanie < 0) {
                        document.getElementById("meno_result").innerText = "Color name ending soon";
                    } else {
                        document.getElementById("meno_result").innerText = msToTime(trvanie);
                    }
                }, 1000);
            } else {
                document.getElementById("meno_result").innerText = "None";
            }
        });

        db.collection('web').doc(meno).get().then((b) => {
            document.getElementById("username").value = b.data().meno;
            document.getElementById("password").value = b.data().heslo;
            document.getElementById("userid").innerText = `ID: ${b.data().idcko}`;
            document.getElementById("name").innerText = document.getElementById("username").value.slice(0,-5);
            if(b.data().trade_link){
                document.getElementById("trade_url").value = b.data().trade_link;
            }
        });

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

function edit(element, button) {
    let condition = document.getElementById(element).disabled;
    if (condition) {
        document.getElementById(element).disabled = false;
        button.innerText = "SAVE";
    } else {
        document.getElementById(element).disabled = true;
        button.innerText = "EDIT";
    }
    db.collection('web').doc(document.getElementById("username").value).update({
        heslo: document.getElementById("password").value,
        trade_link : document.getElementById("trade_url").value
    });
}
