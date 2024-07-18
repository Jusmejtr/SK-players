var firebaseConfig = {
    "your firebase config": "insert here"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();
const db = firebase.firestore();
///////////////////////////////////////////////////////
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
///////////////////////////////////////////////////////
function reset() {
    window.location.reload();
}
function gologo() {
    return window.location.href = '../logged_in/'
}
///////////////////////////////////////////////////////
function loadCookies(name) {
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) {
        document.getElementById('hla_textik').innerText = match[2];
    } else {
        return window.location.href = '/';
    }
}
///////////////////////////////////////////////////////
var afk = 0;
///////////////////////////////////////////////////////
function refresh_coinov(id) {
    db.collection('economy').doc(id).get().then((s) => {
        let peniazky = s.data().money;
        document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
    });
}
function auto_refresh_coinov(kedy, id) {
    setInterval(function () {
        if (afk == 1) return;
        db.collection('economy').doc(id).get().then((s) => {
            let peniazky = s.data().money;
            document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
        });
    }, kedy);
}
///////////////////////////////////////////////////////
function dai_start(name, id, rola) {
    function activityWatcher() {

        var secondsSinceLastActivity = 0;

        var maxInactivity = 20;

        setInterval(function () {
            secondsSinceLastActivity++;
            if (secondsSinceLastActivity > maxInactivity) {
                afk = 1;
            }
        }, 1000);

        function activity() {

            secondsSinceLastActivity = 0;
            afk = 0;
        }

        var activityEvents = [
            'mousedown', 'mousemove', 'keydown',
            'scroll', 'touchstart'
        ];

        activityEvents.forEach(function (eventName) {
            document.addEventListener(eventName, activity, true);
        });
    }

    activityWatcher();

    document.getElementById('dailicko').style.display = "none";
    document.getElementById('spin_button').style.display = "none";
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) {
        let meno = match[2];
    } else {
        return window.location.href = '/';
    }
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    if (zhoda) {
        let idcko = zhoda[2];
        auto_refresh_coinov(2000, idcko);
        db.collection('economy').doc(idcko).get().then((a) => {//zober cas z db na discord daily a zisti ci mozes vybrat
            let vcera = a.data().daily;
            let den = 86400000;
            setInterval(function () {
                let teraz = Date.now();
                if (vcera + den < teraz) { //ked mozes brat daily
                    document.getElementById('dailicko').style.display = "block"; //tlacidlo
                    document.getElementById('daily_time').style.display = "none"; //cas kedy mozes zobrat daily
                } else {
                    document.getElementById('daily_time').innerText = msToTime(vcera - (teraz - den)); //cas kedy mozes zobrat daily
                    document.getElementById('dailicko').style.display = "none"; //tlacidlo
                }
            }, 1000);
        });
        var nick = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        let nicky = nick[2];
        db.collection('web').doc(nicky).get().then((b) => {//zober cas z db na web daily a zisti ci mozes vybrat
            var role = document.cookie.match(new RegExp('(^| )' + rola + '=([^;]+)'));
            let rolka = role[2];
            if (rolka) {
                if (rolka == "VIP") {
                    let vcerab = b.data().daily;
                    let denb = 3600000;
                    setInterval(function () {
                        let terazb = Date.now();
                        if (vcerab + denb < terazb) { //ked mozes
                            document.getElementById('web-dailicko-cas').style.display = "none"; //cas
                            document.getElementById('spin_button').style.display = "block"; //tlacidlo
                        } else {
                            document.getElementById('web-dailicko-cas').innerText = msToTime(vcerab - (terazb - denb)); //cas
                            document.getElementById('spin_button').style.display = "none"; //tlacidlo
                        }
                    }, 1000);
                } else {
                    let vceraa = b.data().daily;
                    let dena = 7200000;
                    setInterval(function () {
                        let teraza = Date.now();
                        if (vceraa + dena < teraza) { //ked mozes
                            document.getElementById('web-dailicko-cas').style.display = "none"; //cas
                            document.getElementById('spin_button').style.display = "block"; //tlacidlo
                        } else {
                            document.getElementById('web-dailicko-cas').innerText = msToTime(vceraa - (teraza - dena)); //cas
                            document.getElementById('spin_button').style.display = "none"; //tlacidlo
                        }
                    }, 1000);
                }
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
///////////////////////////////////////////////////////
function vyber_daily(id, rola) {//discord daily
    var match = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    if (match) {
        let idcko = match[2];
        db.collection('economy').doc(idcko).get().then((q) => {
            var hodnota = q.data().daily;
            var peniaze = q.data().money;
            let timeout = 86400000;
            if (hodnota + timeout > Date.now()) {
                reset();
            } else {
                var zhoda2 = document.cookie.match(new RegExp('(^| )' + rola + '=([^;]+)'));
                if (zhoda2) {
                    let rolicka = zhoda2[2];
                    function randomodmena(min, max) {
                        return Math.floor(Math.random() * (max - min + 1)) + min;
                    }
                    function randomodmenaVIP(min, max) {
                        return Math.floor(Math.random() * (max - min + 1)) + min;
                    }
                    let reward = randomodmena(50, 100);
                    let rewardVIP = randomodmenaVIP(100, 150);
                    if (rolicka == "VIP") {
                        peniaze += rewardVIP;
                        db.collection('economy').doc(idcko).update({
                            'money': peniaze
                        });
                        db.collection('economy').doc(idcko).update({
                            'daily': Date.now()
                        });
                        alert(`Získal si svoju dennú odmenu v hodnote ${rewardVIP}. Aktuálne máš ${peniaze}`);
                        //document.getElementById('vysledok').innerText = `Získal si svoju dennú odmenu v hodnote ${reward}. Aktuálne máš ${peniaze}`;
                        document.getElementById('dailicko').style.display = "none";
                        setInterval(function () {
                            reset();
                        }, 800);
                    } else {
                        peniaze += reward;
                        db.collection('economy').doc(idcko).update({
                            'money': peniaze
                        });
                        db.collection('economy').doc(idcko).update({
                            'daily': Date.now()
                        });
                        alert(`Získal si svoju dennú odmenu v hodnote ${reward}. Aktuálne máš ${peniaze}`);
                        //document.getElementById('vysledok').innerText = `Získal si svoju dennú odmenu v hodnote ${reward}. Aktuálne máš ${peniaze}`;
                        document.getElementById('dailicko').style.display = "none";
                        setInterval(function () {
                            reset();
                        }, 800);
                    }
                }
            }
        });
    }
}
///////////////////////////////////////////////////////
function vyber_web_daily(name, id, vyhra, rola) {//web daily
    var match = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    var matchik = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) {
        let idcko = match[2];
        let meno = matchik[2];
        db.collection('web').doc(meno).get().then((w) => {
            var hodnota = w.data().daily;
            db.collection('economy').doc(idcko).get().then((p) => {
                var coinis = p.data().money;
                let timeout = 7200000;
                let timeout2 = 3600000;

                var rolee = document.cookie.match(new RegExp('(^| )' + rola + '=([^;]+)'));
                let rolkaa = rolee[2];

                if (rolkaa) {
                    if (rolkaa == "VIP") {
                        if (hodnota + timeout2 > Date.now()) {
                            reset();
                        } else {
                            coinis += vyhra;
                            db.collection('economy').doc(idcko).update({
                                'money': coinis
                            });
                            db.collection('web').doc(meno).update({
                                'daily': Date.now()
                            });
                            alert(`Získal si svoju dennú web odmenu v hodnote ${vyhra}. Aktuálne máš ${coinis}`);
                            //document.getElementById('vysledok').innerText = `Získal si svoju dennú odmenu v hodnote ${reward}. Aktuálne máš ${peniaze}`;
                            document.getElementById('spin_button').style.display = "none";
                            setInterval(function () {
                                reset();
                            }, 800);
                        }
                    } else {
                        if (hodnota + timeout > Date.now()) {
                            reset();
                        } else {
                            coinis += vyhra;
                            db.collection('economy').doc(idcko).update({
                                'money': coinis
                            });
                            db.collection('web').doc(meno).update({
                                'daily': Date.now()
                            });
                            alert(`Získal si svoju dennú web odmenu v hodnote ${vyhra}. Aktuálne máš ${coinis}`);
                            //document.getElementById('vysledok').innerText = `Získal si svoju dennú odmenu v hodnote ${reward}. Aktuálne máš ${peniaze}`;
                            document.getElementById('spin_button').style.display = "none";
                            setInterval(function () {
                                reset();
                            }, 800);
                        }
                    }
                }
            });
        });
    }
}
///////////////////////////////////////////////////////
function odhlasenie() {
    document.cookie = "meno=" + "; Path=/";
    document.cookie = "id=" + "; Path=/";
    document.cookie = "rola=" + "; Path=/";
    return window.location.href = '/';
}
