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
////////////////////////////
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
///////////////
function tra_start(name, id, rola) {
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
async function zobraz_hracov(name){
    var vymaz = document.getElementById('vymaz');
    const asi = db.collection('economy');
    const opa = await asi.where('daily', '>', 0).get();
    if(opa.empty) return;
    opa.forEach((zeby) => {
        let bb = zeby.data().meno;
        let cc = zeby.data().ID;
        var vyber = document.getElementById('vyber');
        var moznost = document.createElement('option');
        var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        let meno = match[2];
        if(bb == meno) return;
        moznost.text = bb;
        moznost.value = cc;
        vyber.add(moznost);
    });
}
function transfer(name, id){
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    var zhoda = document.cookie.match(new RegExp('(^| )' + id + '=([^;]+)'));
    let idcko = zhoda[2];//moje id
    if (match) {
        let meno = match[2];
        db.collection('economy').doc(idcko).get().then((q) => {
            if(q.exists){
                var hodnota = q.data().money;
                document.getElementById('suma').max = hodnota;
                let zadana_suma = parseInt(document.getElementById('suma').value);
                if(document.getElementById('vyber').value == '-') return alert("Nezadal si komu chceš previesť coiny");
                if(zadana_suma < 20 || zadana_suma == 0 || isNaN(zadana_suma)) return alert("Musíš previesť minimálne 20 coinov");
                let komu = document.getElementById('vyber').value;
                let selektor = document.getElementById('vyber');
                let komu_meno = selektor.options[selektor.selectedIndex].text;
                db.collection('economy').doc(komu).get().then((g) => {
                    if(!g.exists){
                        return alert("Nastala chyba");
                    } else{
                        if(zadana_suma > hodnota) return alert("Nemáš toľko coinov na prevedenie");
                        db.collection('statistiky').doc(idcko).get().then((uj) => {
                            let suma = uj.data().givnute;
                            suma += zadana_suma;
                            db.collection('statistiky').doc(idcko).update({
                                'givnute': suma
                            });
                            var peniazky = g.data().money;
                            peniazky += zadana_suma;
                            db.collection('economy').doc(komu).update({
                                'money': peniazky
                            });
                            hodnota -= zadana_suma;
                            db.collection('economy').doc(idcko).update({
                                'money': hodnota
                            });
                            return alert(`Úspešne si previedol ${zadana_suma} coinov užívateľovi ${komu_meno}`);
                        });
                    }
                });
            }else{
                console.log("rip v transfer line 117");
            }
        });
    }
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