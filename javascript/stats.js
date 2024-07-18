var firebaseConfig = {
    "your firebase config": "insert here"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();
const db = firebase.firestore();
function reset() {
    window.location.reload();
}
function gologo() {
    return window.location.href = '../logged_in/'
}
//////////////////////////////////
function refresh_coinov(id) {
    db.collection('economy').doc(id).get().then((s) => {
        let peniazky = s.data().money;
        document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
    });
}
function auto_refresh_coinov(kedy, id) {
    setInterval(function() {
        db.collection('economy').doc(id).get().then((s) => {
            let peniazky = s.data().money;
            document.getElementById('stav_coinov').innerText = `${peniazky} coinov`;
        });
    }, kedy);
}
////////////////////////////////////////
function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}
async function prve_miesta(){
	const aa = db.collection('statistiky');
            const zorad = await aa.orderBy('pregamblene', "desc").limit(3).get();
			if(zorad.empty) return;
			zoznam=[];
			coiny=[];
            zorad.forEach(opa => {
				let f = opa.data().pregamblene;
				let mienko = opa.data().meno;
				zoznam.push(mienko);
				coiny.push(f);
            });
			document.getElementById('percento').innerHTML = `1. miesto ${zoznam[0]}, pregamblených: ${numberWithSpaces(coiny[0])}<br>2. miesto ${zoznam[1]}, pregamblených: ${numberWithSpaces(coiny[1])}<br>3. miesto ${zoznam[2]}, pregamblených: ${numberWithSpaces(coiny[2])}<br>`;
}
function stats_start(name, id, rola) {
	prve_miesta();
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) {
        let meno = match[2];
        document.getElementById('t-meno').innerText = meno;
    } else {
        return window.location.href = '/';
    }
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    if (zhoda) {
        let idcko = zhoda[2];
        auto_refresh_coinov(2000, idcko);
        db.collection('statistiky').doc(idcko).get().then((k) => {
            let pregamblene = k.data().pregamblene;
            let gamble_l = k.data().gamble_lose;
            let gamble_w = k.data().gamble_win;
            let suma_l = k.data().suma_prehra;
            let suma_v = k.data().suma_vyhra;
            let givnutych = k.data().givnute;
            let meno = k.data().meno;
            document.getElementById('t-pregamblene').innerText = numberWithSpaces(pregamblene);
            document.getElementById('t-gamblewin').innerText = numberWithSpaces(gamble_w);
            document.getElementById('t-gamblelose').innerText = numberWithSpaces(gamble_l);
            document.getElementById('t-sumawin').innerText = numberWithSpaces(suma_v);
            document.getElementById('t-sumalose').innerText = numberWithSpaces(suma_l);
            document.getElementById('t-givnute').innerText = numberWithSpaces(givnutych);
            let suma = pregamblene / 100;
            suma = parseInt(suma);
            //document.getElementById('percento').innerText = `Na konci mesiaca dostaneĹˇ 1% z pregamblenĂ˝ch coinov v hodnote: ${numberWithSpaces(suma)}`;
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
    zobraz_hracov();
}
async function zobraz_hracov(){//ked klikne na select menu
    const asi = db.collection('statistiky');
    const opa = await asi.where('pregamblene', '>', 0).get();
    if(opa.empty) return;
    opa.forEach((zeby) => {
        let dd = zeby.data().meno;
        let bb = zeby.id
        db.collection('economy').doc(bb).get().then((s) =>{
            let ide = s.data().ID;
            var vyber = document.getElementById('vyber');
            var moznost = document.createElement('option');
            moznost.text = dd;
            moznost.value = ide;
            vyber.add(moznost);
        });
    });
}
function refresh_hracov(){//ked si vyberie nejakeho hraca
    let a = document.getElementById('vyber');
    let idcko = a.value;
    if(idcko == '-')return;
    db.collection('statistiky').doc(idcko).get().then((k) => {
        let pregamblene = k.data().pregamblene;
        let gamble_l = k.data().gamble_lose;
        let gamble_w = k.data().gamble_win;
        let suma_l = k.data().suma_prehra;
        let suma_v = k.data().suma_vyhra;
        let givnutych = k.data().givnute;
        let meno = k.data().meno;
        document.getElementById('t-pregamblene').innerText = numberWithSpaces(pregamblene);
        document.getElementById('t-gamblewin').innerText = numberWithSpaces(gamble_w);
        document.getElementById('t-gamblelose').innerText = numberWithSpaces(gamble_l);
        document.getElementById('t-sumawin').innerText = numberWithSpaces(suma_v);
        document.getElementById('t-sumalose').innerText = numberWithSpaces(suma_l);
        document.getElementById('t-givnute').innerText = numberWithSpaces(givnutych);
        document.getElementById('t-meno').innerText = meno;
        let suma = pregamblene / 100;
        suma = parseInt(suma);
        //document.getElementById('percento').innerText = `HrĂˇÄŤ ${meno} dostane na konci mesiaca 1% z pregamblenĂ˝ch coinov v hodnote: ${numberWithSpaces(suma)}`;
    });
}
function odhlasenie() {
    document.cookie = "meno=" + "; Path=/";
    document.cookie = "id=" + "; Path=/";
    document.cookie = "rola=" + "; Path=/";
    return window.location.href = '/';
}