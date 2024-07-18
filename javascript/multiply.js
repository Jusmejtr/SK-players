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
//////////////////////////////////////
var afk = 0;
var last_clicked = 0;
////////////////////////////////////
function refresh_coinov(id) {
    db.collection('economy').doc(id).get().then((s) => {
        let peniazky = s.data().money;
        document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
    });
}
function auto_refresh_coinov(kedy, id) {
    setInterval(function() {
		if(afk == 1) return;
        db.collection('economy').doc(id).get().then((s) => {
            let peniazky = s.data().money;
            document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
        });
    }, kedy);
}
///////////////
function mul_start(name, id, rola) {
    function activityWatcher(){
		var secondsSinceLastActivity = 0;
		var maxInactivity = 20;
		setInterval(function(){
			secondsSinceLastActivity++;
			if(secondsSinceLastActivity > maxInactivity){
				afk = 1;
			}
		}, 1000);
		function activity(){
			secondsSinceLastActivity = 0;
			afk = 0;
		}
		var activityEvents = [
			'mousedown', 'mousemove', 'keydown',
			'scroll', 'touchstart'
		];
		activityEvents.forEach(function(eventName) {
			document.addEventListener(eventName, activity, true);
		});
	}
	activityWatcher();
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
function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
//////////////////////////////////
function multiply3(name, id){
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    let idcko = zhoda[2];//moje id
    let meno = match[2];//moj tag

    if (Date.now() - last_clicked < 500) return alert("No tak tu ťa zastavím");
    last_clicked = Date.now();

    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }   
    db.collection('economy').doc(idcko).get().then((a) => {
        if(!a.exists) return message.reply("Nemáš vytvorený účet");
        let hodnota = a.data().money;
        var peniazky = a.data().money;
        document.getElementById('suma').max = hodnota;
        let bet = parseInt(document.getElementById('suma').value);
        if(bet < 5 || isNaN(bet)) return alert("Musíš staviť minimálne 5 coinov");
        if(bet > hodnota) return alert("Nemáš toľko coinov");
        let rcislo = getRandomInt(1,100);
        db.collection('statistiky').doc(idcko).get().then((ia) => {
            var pregamble = ia.data().pregamblene;
            var suma_win = ia.data().suma_vyhra;
            var suma_lose = ia.data().suma_prehra;
            if(rcislo <= 26){
                peniazky += bet*3;
                db.collection('economy').doc(idcko).update({
                    'money': peniazky
                });
                pregamble+=bet;
                suma_win+=bet*3;
                db.collection('statistiky').doc(idcko).update({
                    'pregamblene': pregamble,
                    'suma_vyhra': suma_win
                });
                var table = document.getElementById("tabulka");
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                //cell1.innerHTML = ;
                cell2.innerHTML = `${bet} (+${bet*3})`;
                cell3.innerHTML = "X3";
                cell4.innerHTML = "WIN";
                row.style.backgroundColor = "lime";
            }
            else{
                peniazky -= bet;
                db.collection('economy').doc(idcko).update({
                    'money': peniazky
                });
                pregamble+=bet;
                suma_lose+=bet;
                db.collection('statistiky').doc(idcko).update({
                    'pregamblene': pregamble,
                    'suma_prehra': suma_lose
                });
                var table = document.getElementById("tabulka");
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                //cell1.innerHTML = ;
                cell2.innerHTML = bet;
                cell3.innerHTML = "X3";
                cell4.innerHTML = "LOSE";
                row.style.backgroundColor = "red";
            }
        });
    });
}
//////////////////////////////////
function multiply4(name, id){
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    let idcko = zhoda[2];//moje id
    let meno = match[2];//moj tag

    if (Date.now() - last_clicked < 500) return alert("No tak tu ťa zastavím");
    last_clicked = Date.now();

    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }    
    db.collection('economy').doc(idcko).get().then((a) => {
        if(!a.exists) return message.reply("Nemáš vytvorený účet");
        let hodnota = a.data().money;
        var peniazky = a.data().money;
        document.getElementById('suma').max = hodnota;
        let bet = parseInt(document.getElementById('suma').value);
        if(bet < 5 || isNaN(bet)) return alert("Musíš staviť minimálne 5 coinov");
        if(bet > hodnota) return alert("Nemáš toľko coinov");
        let rcislo = getRandomInt(1,100);
        db.collection('statistiky').doc(idcko).get().then((ia) => {
            var pregamble = ia.data().pregamblene;
            var suma_win = ia.data().suma_vyhra;
            var suma_lose = ia.data().suma_prehra;
            if(rcislo <= 21){
                peniazky += bet*4;
                db.collection('economy').doc(idcko).update({
                    'money': peniazky
                });
                pregamble+=bet;
                suma_win+=bet*4;
                db.collection('statistiky').doc(idcko).update({
                    'pregamblene': pregamble,
                    'suma_vyhra': suma_win
                });
                var table = document.getElementById("tabulka");
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                //cell1.innerHTML = ;
                cell2.innerHTML = `${bet} (+${bet*4})`;
                cell3.innerHTML = "X4";
                cell4.innerHTML = "WIN";
                row.style.backgroundColor = "lime";
            }
            else{
                peniazky -= bet;
                db.collection('economy').doc(idcko).update({
                    'money': peniazky
                });
                pregamble+=bet;
                suma_lose+=bet;
                db.collection('statistiky').doc(idcko).update({
                    'pregamblene': pregamble,
                    'suma_prehra': suma_lose
                });
                var table = document.getElementById("tabulka");
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                //cell1.innerHTML = ;
                cell2.innerHTML = bet;
                cell3.innerHTML = "X4";
                cell4.innerHTML = "LOSE";
                row.style.backgroundColor = "red";
            }
        });
    });
}
//////////////////////////////////
function multiply5(name, id){
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    let idcko = zhoda[2];//moje id
    let meno = match[2];//moj tag

    if (Date.now() - last_clicked < 500) return alert("No tak tu ťa zastavím");
    last_clicked = Date.now();

    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }    
    db.collection('economy').doc(idcko).get().then((a) => {
        if(!a.exists) return message.reply("Nemáš vytvorený účet");
        let hodnota = a.data().money;
        var peniazky = a.data().money;
        document.getElementById('suma').max = hodnota;
        let bet = parseInt(document.getElementById('suma').value);
        if(bet < 5 || isNaN(bet)) return alert("Musíš staviť minimálne 5 coinov");
        if(bet > hodnota) return alert("Nemáš toľko coinov");
        let rcislo = getRandomInt(1,100);
        db.collection('statistiky').doc(idcko).get().then((ia) => {
            var pregamble = ia.data().pregamblene;
            var suma_win = ia.data().suma_vyhra;
            var suma_lose = ia.data().suma_prehra;
            if(rcislo <= 17){
                peniazky += bet*5;
                db.collection('economy').doc(idcko).update({
                    'money': peniazky
                });
                pregamble+=bet;
                suma_win+=bet*5;
                db.collection('statistiky').doc(idcko).update({
                    'pregamblene': pregamble,
                    'suma_vyhra': suma_win
                });
                var table = document.getElementById("tabulka");
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                //cell1.innerHTML = ;
                cell2.innerHTML = `${bet} (+${bet*5})`;
                cell3.innerHTML = "X5";
                cell4.innerHTML = "WIN";
                row.style.backgroundColor = "lime";
            }
            else{
                peniazky -= bet;
                db.collection('economy').doc(idcko).update({
                    'money': peniazky
                });
                pregamble+=bet;
                suma_lose+=bet;
                db.collection('statistiky').doc(idcko).update({
                    'pregamblene': pregamble,
                    'suma_prehra': suma_lose
                });
                var table = document.getElementById("tabulka");
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                //cell1.innerHTML = ;
                cell2.innerHTML = bet;
                cell3.innerHTML = "X5";
                cell4.innerHTML = "LOSE";
                row.style.backgroundColor = "red";
            }
        });
    });
}
function skry_footer(){
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        return document.getElementById('futrik').style.display = "none";
    }else{
        return;
    }
}
function ukaz_footer(){
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        return document.getElementById('futrik').style.display = "block";
    }else{
        return;
    }
}
function odhlasenie() {
    document.cookie = "meno=" + "; Path=/";
    document.cookie = "id=" + "; Path=/";
    document.cookie = "rola=" + "; Path=/";
    return window.location.href = '/';
}