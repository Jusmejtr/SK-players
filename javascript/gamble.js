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
///////////////////////////////////////////////////////
var afk = 0;
var last_clicked = 0;
///////////////////////////////////////////////////////
function refresh_coinov(id) {
    db.collection('economy').doc(id).get().then((s) => {
        let peniazky = s.data().money;
        document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
    });
}
function auto_refresh_coinov(kedy, id) {
    setInterval(function() {
		if(afk == 1){
            document.getElementById('stav_coinov').innerText = 'AFK';
            return;
        }
        db.collection('economy').doc(id).get().then((s) => {
            let peniazky = s.data().money;
            document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
        });
    }, kedy);
}
///////////////////////////////////////////////////////
function gam_start(name, id, rola) {

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
        db.collection('statistiky').doc(idcko).get().then((s) => {
            let gamble_count = s.data().gamble_count;
            document.getElementById('max_gamble').innerText = `Denný gamble limit: ${gamble_count}`;
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
function gamble(name, id){
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    let idcko = zhoda[2];//moje id
    let meno = match[2];//moj tag

    if (Date.now() - last_clicked < 500) return alert("Hamuj sie, klikáš fess rýchlo");
    last_clicked = Date.now();

    db.collection('economy').doc(idcko).get().then((q) => {
        if(q.exists){
            var hodnota = q.data().money;
            document.getElementById('suma').max = hodnota;
            let bet = parseInt(document.getElementById('suma').value);
            if(bet < 5 || isNaN(bet)) return alert("Musíš staviť minimálne 5 coinov");
            if(bet > hodnota) return alert("Nemáš toľko coinov");
            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }   
            db.collection('statistiky').doc(idcko).get().then((ia) => {
                var lose = ia.data().gamble_lose;
                var win = ia.data().gamble_win;
                var pregamble = ia.data().pregamblene;
                var suma_win = ia.data().suma_vyhra;
                var suma_lose = ia.data().suma_prehra;
                var gamble_count = ia.data().gamble_count;
                if(gamble_count <=0){
                    return alert("Minul si svoj denný gamble limit");
                }
                let moznosti = ["l", "w", "l", "w", "l", "w", "l", "w", "l", "w", "l", "w", "l", "w", "l", "w", "l", "w", "l", "l"];
                var vyber = moznosti[Math.floor(Math.random() * moznosti.length)];
                if(vyber == 'w'){
                    hodnota += bet;
                    db.collection('economy').doc(idcko).update({
                        'money': hodnota
                    });
                    pregamble+=bet;
                    win+=1;
                    suma_win+=bet;
                    gamble_count -= 1;
                    db.collection('statistiky').doc(idcko).update({
                        'pregamblene': pregamble,
                        'gamble_win': win,
                        'suma_vyhra': suma_win,
                        'gamble_count': gamble_count,
                    });
                    var table = document.getElementById("tabulka");
                    var row = table.insertRow(1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    //cell1.innerHTML = ;
                    cell2.innerHTML = bet;
                    cell3.innerHTML = "WIN";
                    row.style.backgroundColor = "lime";
                }
                else{
                    hodnota -= bet;
                    db.collection('economy').doc(idcko).update({
                        'money': hodnota
                    });
                    pregamble+=bet;
                    lose+=1;
                    suma_lose+=bet;
                    gamble_count -= 1;
                    db.collection('statistiky').doc(idcko).update({
                        'pregamblene': pregamble,
                        'gamble_lose': lose,
                        'suma_prehra': suma_lose,
                        'gamble_count': gamble_count,
                    });
                    var table = document.getElementById("tabulka");
                    var row = table.insertRow(1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    //cell1.innerHTML = ;
                    cell2.innerHTML = bet;
                    cell3.innerHTML = "LOSE";
                    row.style.backgroundColor = "red";
                }
                document.getElementById('max_gamble').innerText = `Denný gamble limit: ${gamble_count}`;
            });
        }
    });
}
///////////////////////////////////////////////////////
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
///////////////////////////////////////////////////////
function odhlasenie() {
    document.cookie = "meno=" + "; Path=/";
    document.cookie = "id=" + "; Path=/";
    document.cookie = "rola=" + "; Path=/";
    return window.location.href = '/';
}