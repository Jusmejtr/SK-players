function toMinutes(cas){
    let args = cas.split(":");
    return parseInt(args[0]*60)+parseInt(args[1]);
}
function toTime(cas){
    let hodina = Math.floor(cas / 60);
    let minuta = cas % 60;
    return `${hodina}:${minuta.toString().padStart(2,'0')}`;
}



setInterval(function() {
    var today = new Date();
    var dd = String(today.getDate());
    var mm = String(today.getMonth() + 1); //January is 0!
    var yyyy = today.getFullYear();

    var hour = String(today.getHours()).padStart(2, '0');
    var minutes = String(today.getMinutes()).padStart(2, '0');
    var seconds = String(today.getSeconds()).padStart(2, '0');

    let zaciatok_semestra = new Date(2022, 1, 14);

    let tyzden = Math.floor((today - zaciatok_semestra) / (7*24*60*60*1000));

    document.getElementById("datum").innerText = `${dd}.${mm}.${yyyy}`;
    document.getElementById("cas").innerText = `${hour}:${minutes}:${seconds}`;
    document.getElementById("tyzden").innerText = `${tyzden+1}/13 týždeň`;


    var hodina = today.getHours();
    var minuta = today.getMinutes();

    var teraz = (hodina * 60) + minuta;

    var hodiny = document.getElementsByClassName('posun');
    let mnozstvo = hodiny.length;

    for(let i=0; i< mnozstvo; i++){
        let casik = hodiny[i].getAttribute("cas");
        let rozptyl = casik - teraz;
        var percento = ((rozptyl * 50)/180)+50;
        document.getElementsByClassName('posun')[i].style.left = `${percento}%`;
    }

}, 1000);



function vytvorDiv(meno, cas, nazov_hodiny, link){
    let divko = document.createElement("div");
    divko.className = "posun";
    switch (meno) {
        case 'A3':
            divko.id = "A3";
            divko.setAttribute("nazov_predmetu", nazov_hodiny);
            divko.setAttribute("link", link);
            break;
        case 'A7':
            divko.id = "A7";
            divko.setAttribute("nazov_predmetu", nazov_hodiny);
            divko.setAttribute("link", link);
            break;
        default:
            break;
    }
    let aktual = toMinutes(cas);
    aktual += 90;

    divko.innerHTML = `<a href="${link}" target="_blank">${nazov_hodiny}</a> ${cas} - ${toTime(aktual)}`;
    divko.setAttribute("cas", toMinutes(cas));
    document.body.appendChild(divko);
    
}