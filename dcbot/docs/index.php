<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK bot Docs</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="docs.css">

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>

</head>
<body onload="load()">
    <header id="header">
        <div class="logo">
            <img src="../img/skplayers_logo.png" alt="SK players logo" width="180px" onclick="gomain()">
        </div>
        <div class="links">
            <a href="../docs/">Documentation</a>
            <a href="https://github.com/Jusmejtr/SKbot" target="_blank">Github</a>
            <a href="https://discord.com/api/oauth2/authorize?client_id=662288447276580875&permissions=3758484550&scope=bot" target="_blank" class="invite">Invite Bot</a>
        </div>

    </header>

    <div class="main">
        <nav id="nav">
            <div class="setup container">
                <div class="nav-title" data-value="setup">
                    <i class="fa-solid fa-arrow-down" id="setup-arrow"></i>
                    <div class="nazov">SETUP</div>
                </div>
                <ul id="setup">
                    <div class="box"><a href="#permissions">Permissions</a></div>
                </ul>
            </div>
            <div class="utility container">
                <div class="nav-title" data-value="utility">
                    <i class="fa-solid fa-arrow-down" id="utility-arrow"></i>
                    <div class="nazov">UTILITY</div>
                </div>
                <ul id="utility">
                    <div class="box"><a href="#help">Help</a></div>
                    <div class="box"><a href="#ping">Ping</a></div>
                    <div class="box"><a href="#economyy">Economy</a></div>
                    <div class="box"><a href="#anketa">Anketa</a></div>
                    <div class="box"><a href="#nahodne-cislo">Náhodné číslo</a></div>
                    <div class="box"><a href="#generovanie-timov">Generovanie tímov</a></div>
                </ul>
            </div>
            <div class="emotes container">
                <div class="nav-title" data-value="emotes">
                    <i class="fa-solid fa-arrow-down" id="emotes-arrow"></i>
                    <div class="nazov">EMOTES</div>
                </div>
                <ul id="emotes">
                    <div class="box"><a href="#emotes-about">About</a></div>
                    <div class="box"><a href="#emotes-usage">Použitie</a></div>
                    <div class="box"><a href="#emotes-reaction">Reakcie</a></div>
                </ul>
            </div>
            <div class="game-updates container">
                <div class="nav-title" data-value="game-updates">
                    <i class="fa-solid fa-arrow-down" id="game-updates-arrow"></i>
                    <div class="nazov">GAME UPDATES</div>
                </div>
                <ul id="game-updates">
                    <div class="box"><a href="#help-updates">Help</a></div>
                    <div class="box"><a href="#updatelist">Zoznam updatov</a></div>
                    <div class="box"><a href="#setupdate">Nastavenie updatu</a></div>
                    <div class="box"><a href="#removeupdate">Zrušenie updatu</a></div>
                    <div class="box"><a href="#games-code">Kódyhier</a></div>
                </ul>
            </div>
            <div class="economy container">
                <div class="nav-title" data-value="economy">
                    <i class="fa-solid fa-arrow-down" id="economy-arrow"></i>
                    <div class="nazov">ECONOMY</div>
                </div>
                <ul id="economy">
                    <div class="box"><a href="#createaccount">Vytvorenie účtu</a></div>
                    <div class="box"><a href="#balance">Balance</a></div>
                    <div class="box"><a href="#daily">Daily</a></div>
                    <div class="box"><a href="#gamble">Gamble</a></div>
                    <div class="box"><a href="#transfer">Transfer</a></div>
                    <div class="box"><a href="#jackpot">Jackpot</a></div>
                    <div class="box"><a href="#stats">Štatistiky</a></div>
                    <div class="box"><a href="#top">Top</a></div>
                    <div class="box"><a href="#multiply">Multiply</a></div>
                    <div class="box"><a href="#shop">Shop</a></div>
                </ul>
            </div>
            <div class="moderate container">
                <div class="nav-title" data-value="moderate">
                    <i class="fa-solid fa-arrow-down" id="moderate-arrow"></i>
                    <div class="nazov">MODERATE</div>
                </div>
                <ul id="moderate">
                    <div class="box"><a href="#kick">Kick</a></div>
                    <div class="box"><a href="#ban">Ban</a></div>
                    <div class="box"><a href="#prune">Prune</a></div>
                </ul>
            </div>
            <div class="for-fun container">
                <div class="nav-title" data-value="for-fun">
                    <i class="fa-solid fa-arrow-down" id="for-fun-arrow"></i>
                    <div class="nazov">FOR FUN</div>
                </div>
                <ul id="for-fun">
                    <div class="box"><a href="#iq">IQ</a></div>
                    <div class="box"><a href="#cicina">Cicina</a></div>
                    <div class="box"><a href="#csgo-maps">CS:GO random map</a></div>
                </ul>
            </div>
        </nav>

        <div class="context" id="context">
            <div class="context-title">
                <img src="../img/skbot_text.png" alt="" width="25%"><br>
                OFFICIAL DOCUMENTATION
            </div>
            <div class="context-subtitle">
                ABOUT
            </div>
            <div class="context-text">
                Prvý SK players discord bot vyvýjaný od roku 2020 (2.1.2020) nesie so sebou veľa funkcií a možností pre Váš discord server.<br>
                Nižšie nájdete užitočné tagy, ktoré Vám povedia, ktorý príkaz funguje na akom type serveru.
                <div class="tags">
                    TAGS
                </div>
                <div class="tag">
                    <div class="cube" style="background-color: red;">
                        <div class="cube-text">SK players</div>
                    </div>
                    <div class="triangle triangle-red"></div>
                    <div class="tag-text">Príkaz je možné použiť len na serveri SK players</div>
                </div>
                <div class="tag">
                    <div class="cube" style="background-color: rgb(66, 108, 197);">
                        <div class="cube-text">Global</div>
                    </div>
                    <div class="triangle triangle-blue"></div>
                    <div class="tag-text">Príkaz je možné použiť na hociktorom serveri</div>
                </div>
            </div>
            <div class="context-subtitle">
                SETUP
            </div>
            <div class="context-text">
                <div id="permissions" class="context-nav-title">Permissions</div>
                <div class="context-nav-text">
                    <ul>
                        <li><b>Kick members</b></li>
                        <li><b>Ban members</b></li>
                        <li><b>Manage Emojis and Stickers</b> - Spravovanie emotiek pre aktualizovanie zoznamu u bota</li>
                        <li><b>Manage Webhooks</b> - Odosielanie emotiek v textovej miestnosti</li>
                        <li><b>Read Messages/View Channels</b></li>
                        <li><b>Send Messages</b></li>
                        <li><b>Manage Messages</b></li>
                        <li><b>Embed Links</b> - Väčšina odpovedí od bota sú tvorené cez embed linky</li>
                        <li><b>Attach Files</b></li>
                        <li><b>Read Message History</b></li>
                        <li><b>Use External Emojis</b></li>
                        <li><b>Add Reactions</b></li>
                        <li><b>Use Slash Commands</b> - Pre príkazy v budúcnosti vytvárané slash príkazom</li>
                    </ul>
                </div>
            </div>
            <div class="context-subtitle">
                UTILITY
            </div>
            <div class="context-text">
                <div id="help" class="context-nav-title">
                    <div>Help</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*help</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Tento príkaz ti zobrazí základné príkazy, ktoré bot na danom serveri ovláda.
                    Z dôvodu kapacity zoznam všetkých dostupných príkazov nájdete v tejto dokumentácii.
                </div>

                <div id="ping" class="context-nav-title">
                    <div>Ping</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*ping</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Zistíš odozvu bota.
                </div>

                <div id="economyy" class="context-nav-title">
                    <div>Economy</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*economy</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Tento príkaz ti zobrazí možnosti ohľadom economy príkazov na SK players serveri.
                </div>

                <div id="anketa" class="context-nav-title">
                    <div>Anketa</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*question [typ] [otázka]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Pre vytvorenie ankety, na ktorú budú môcť ľudia reagovať emotikonom musíš vedieť aký typ reakcie chceš a samotnú otázku.
                    <br>Typy otázok:
                    <ul>
                        <li><b>thumb</b> - tento typ otázky vytvorí reakcie s 👍 a 👎</li>
                        <li><b>mark</b> - tento typ otázky vytvorí reakcie s ✔️ a ❌</li>
                    </ul>
                    <p>Príklad použitia:   <b>*question thumb Ako sa máš?</b></p>
                    <img src="../img/examples/question-thumb.png" alt="question thumb example">
                    <img src="../img/examples/question-mark.png" alt="question mark example">
                </div>

                <div id="nahodne-cislo" class="context-nav-title">
                    <div>Náhodné číslo</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*nroll [od] [do]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Vygeneruje ti náhodné číslo podľa zadaných parametrov.
                </div>

                <div id="generovanie-timov" class="context-nav-title">
                    <div>Generovanie tímov</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*generate-team [počet hráčov v jednom tíme (2 až 5)] [hráči]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Tento príkaz ti náhodne vygeneruje dva tímy hráčov. Vstup hráčov musí byť oddelený medzero. To znamená, že meno hráča musíš zadať ako jedno slovo,
                    resp. medzera sa považuje za nového hráča.
                    <p>Príklad použitia:   <b>*generate-team 2 Janko Jožko Ferko Miško</b></p>
                    <img src="../img/examples/generate-team.png" alt="generate team example">
                </div>
            </div>
            <div class="context-subtitle">
                EMOTES
            </div>
            <div class="context-text">
                <div id="emotes-about" class="context-nav-title">
                    <div>About</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Táto sekcia je zameraná na vysvetlenie fungovania emotov. SK bot dokáže posielať animované emoty aj bez nutnosti Discord Nitro.
                    Takže tento bot je výbornou možnosťou ako získať nekonečný počet emotov. Nižšie sa dozvieš ako. <br>
                </div>

                <div id="emotes-usage" class="context-nav-title">
                    <div>Použitie</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Používanie emotov je jednoduché. Môžeme to rozdeliť do dvoch častí. Prvá bude používanie neanimovaných emotov a tá druhá používanie animovaných.<br>
                    <h3>Neanimované</h3>
                    Neanimované emotikony môže predvolene používať každý bez nutnosti vlastnenia Discord Nitro. Rozdiel je ale ten, že s SK botom dokážete posielať
                    neanimované emoty aj na <b>iných serveroch</b> (ak sa tam nachádza SK bot). V jednoduchosti to znamená to, že všetky serveri s SK botom majú zdieľané emotikony
                    Takže ak na jednom serveri máte určité emoty, tak tie isté emoty dokážete použiť aj na inom serveri.<br>
                    <b>Príklad:</b>
                    Na <a href="https://discord.gg/6ckpqeGkzb" target="_blank">emote serveri</a> SK players máme emote, ktorý chceme poslať na inom serveri, napr. FeelsOldMan.<br>
                    <img src="../img/examples/emote-list.png" alt="emote list example"><br>
                    Jediné čo stači spraviť je poslať tento emote na iný server. To spravíme nasledovne: pred emote, ktorý chceme poslať napíšeme <b>:</b> a taktiež aj za
                    náš emote napíšeme <b>:</b>. Výsledná správa by vyzerala takto: <b>:FeelsOldMan:</b>
                    <img src="../img/examples/emote-send.png" alt="emote send example"> Discord nám automaticky zmení náš text na emote a nám nezostáva nič iné ako správu odoslať.
                    Samozrejme existuje možnosť textu so zahurnutím emotikonu. Vtedy by to vyzeralo takto: <img src="../img/examples/emote-sendv2.png" alt="emote send example">
                    V správe môžeme zahrnúť ľubovoľný počet emotov a textu.
                    <h3>Animované</h3>
                    Rozdiel medzi animovanými a neanimovanými emotikonmi je ten, že pre poslanie takéhoto emotu potrebuje vlastniť Discord Nitro. Tento problém taktiež rieši SK bot.
                    Posielanie emotov prebieha rovnakým systémom ako neanimované emotikony s jediným rozdielom a to je ten, že pri posielaní takéhoto emotikonu, či už na vlastný
                    alebo iný server potrebuje pred a za emote vložiť znak <b>:</b>.<br>
                    <b>Príklad:</b>
                    Na <a href="https://discord.gg/6ckpqeGkzb" target="_blank">emote serveri</a> SK players máme animovaný emote, ktorý chceme poslať buď na vlastný alebo na iný
                    server, napr. NOPERS.<br>
                    <img src="../img/examples/emote-animated-list.png" alt="emote list example"><br>
                    Princíp posielania emotu pre vlastný alebo iný server je rovnaký a to taký, že pošleme správu, ktorá vyzerá nasledovne <b>:NOPERS:</b>.
                    Discord nám automaticky tak ako aj predtým zmení text na emote a nezostáva nám nič iné než správu poslať.
                </div>

                <div id="emotes-reaction" class="context-nav-title">
                    <div>Reakcie</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*react [emote name]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Tak ako aj posielanie emotikonov, dokážete s SK botom reagovať animovanými emotikonmi na správy. Bežne je táto funkcia dostupná len ak máte zakúpené
                    Discord Nitro. To už nie je potrebné, jediné čo Vám stačí je mať na server SK bota.<br>
                    Reagovanie prebieha nasledovne. Zvolíte si správu, na ktorú chcete zareagovať emotikonom a použijete tento príkaz ako je ukázané nižšie.
                    Pamätajte, správa musí byť typu <b>REPLY</b> aby bot dokázal zareagovať na danú správu.<br>
                    <b>*react :FeelsOldMan:</b><br>
                    <img src="../img/examples/emote-react.png" alt="emote react example"><br> Vtedy bot zareaguje na danú správu a Vy sa musíte pridať k jeho reakcii.<br>
                    <img src="../img/examples/emote-reactv2.png" alt="emote react example"><br> Následne bot svoju reakciu vymaže a vyzerá to tak akoby ste reakciu pridali len Vy.<br>
                    <img src="../img/examples/emote-reactv3.png" alt="emote react example">
                </div>

            </div>
            <div class="context-subtitle">
                GAME UPDATES
            </div>
            <div class="context-text">
                <div id="help-updates" class="context-nav-title">
                    <div>Help</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*help-updates</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Získaš zoznam príkazov k herným updatom. Taktiež všetky tieto príkazy sú tu vypísané v záložke GAME UPDATES.
                </div>

                <div id="updatelist" class="context-nav-title">
                    <div>Zoznam updatov</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*updatelist</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Tento príkaz ti zobrazí zoznam hier a taktiež v prípade ak je daný update zapnutý, zobrazí link na text-channel, v ktorom tieto správy sú odosielané.
                </div>

                <div id="setupdate" class="context-nav-title">
                    <div>Nastavenie updatu</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*setupdate [kód hry]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Pomocou tohto príkazu vytvoríš záznam o novinkách. To znamená, že vždy keď zvolená hra dostane nový update, bot automaticky pošle túto spravú na tvoj server.
                    Pamätaj, bot posiela novinky do toho kanála, v ktorom si tento príkaz napísal.
                    <a href="#games-code">Podporované kódy hier</a>
                    <p>Príklad použitia:   <b>*setupdate ets</b></p>
                    <img src="../img/examples/setupdate.png" alt="set update example">
                </div>

                <div id="removeupdate" class="context-nav-title">
                    <div>Zrušenie updatu</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*removeupdate [kód hry]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom zrušíš odosielanie noviniek z danej hry.
                    <a href="#games-code">Podporované kódy hier</a>
                    <p>Príklad použitia:   <b>*removeupdate ets</b></p>
                    <img src="../img/examples/removeupdate.png" alt="remove update example">
                </div>

                <div id="games-code" class="context-nav-title">
                    <div>Kódy hier</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*game-code</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    <br>Podporované kódy hry:
                    <ul>
                        <li><b>dbd</b> - Dead by Daylight</li>
                        <li><b>ets</b> - Euro Truck Simulator 2</li>
                        <li><b>slapshot</b> - Slapshot: Rebound</li>
                    </ul>
                </div>
            </div>
            <div class="context-subtitle">
                ECONOMY
            </div>
            <div class="context-text">
                <div id="createaccount" class="context-nav-title">
                    <div>Vytvorenie účtu</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*createaccount</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom si vytvoríš economy účet, ktorý môžeš používať na serveri SK players.
                </div>

                <div id="balance" class="context-nav-title">
                    <div>Balance</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*balance</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom si pozrieš svoj zostatok na tvojom economy účte.
                </div>

                <div id="daily" class="context-nav-title">
                    <div>Daily</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*daily</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom získaš svojú dennú odmenu. Pozor túto odmenu môžeš získať raz za 24 hodín. Odmeny pre členov VIP sú vyššie.
                </div>

                <div id="gamble" class="context-nav-title">
                    <div>Gamble</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*gamble [suma]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom stavíš svoje coiny a máš určitú šancu vyhrať dvojnásobok vkladu.
                    <p>Príklad použitia:   <b>*gamble 50</b></p>
                </div>

                <div id="transfer" class="context-nav-title">
                    <div>Transfer</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*transfer [@someone] [suma]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom pošleš určitú sumu niekomu inému kto má economy účet.
                    <p>Príklad použitia:   <b>*transfer @Jožko 30</b></p>
                </div>

                <div id="jackpot" class="context-nav-title">
                    <div>Jackpot</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*jackpot [suma]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom vytvoríš alebo sa pripojíš do prebiehajúceho jackpotu. Jackpot je hra, kde hráči stavia svoje coiny a v závislosti od vkladu je vypočítaná
                    ich šanca na výhru. Víťaz berie všetky coiny vložené do aktuálnej hry. Príkaz je môžné použiť opakovane, kde pri rozohratej hre sa zvolený vklad pripočíta
                    k už aktuálnemu vkladu, ktorý hráč vložil skôr.
                    <p>Príklad použitia:   <b>*jackpot 80</b></p>
                </div>

                <div id="stats" class="context-nav-title">
                    <div>Štatistiky</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*stats &lt@someone&gt</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom si pozrieš svoje štatistiky economy účtú. Taktiež si vieš pozrieť aj štatistiky niekoho iného ak za *stats niekoho označíš.
                    <p>Príklad použitia:   <b>*stats</b> alebo <b>*stats @Jožko</b></p>
                </div>

                <div id="top" class="context-nav-title">
                    <div>Top</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*top</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom si vieš pozrieť hráčov s najväčším počtom coinov. Ak máš VIP zobrazia sa ti piati hráči, inak len traja.
                </div>

                <div id="multiply" class="context-nav-title">
                    <div>Multiply</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*multiply [suma]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Pomocou tohto príkazu vieš svoje coiny buď strojnásobiť, štvornásobiť alebo aj späťnásobiť. Stačí ak vložíš určitú sumu a vyberieš si násobok, potom to
                    už je len na náhode.
                    <p>Príklad použitia:   <b>*multiply 40</b></p>
                </div>

                <div id="shop" class="context-nav-title">
                    <div>Shop</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: red;">
                            <div class="nav-cube-text">SK players</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid red;"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*shop</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom si zobrazíš obchod, v ktorom vieš za svoje coiny nakúpiť rôzne veci ako napr. VIP, farebné meno, ale aj niekoho mutnúť.
                </div>
            </div>
            <div class="context-subtitle">
                MODERATE
            </div>
            <div class="context-text">
                <div id="kick" class="context-nav-title">
                    <div>Kick</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*kick &ltdôvod&gt</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Vyhodíš daného hráča zo servera.
                </div>

                <div id="ban" class="context-nav-title">
                    <div>Ban</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*ban &ltdôvod&gt</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Zabanuješ daného hráča zo servera.
                </div>

                <div id="prune" class="context-nav-title">
                    <div>Prune</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*prune [počet správ]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Týmto príkazom vymažeš určitý počet správ v danom textovom kanáli. Pozor môžeš vymazať len správy nie staršie ako 14 dní.
                    <p>Príklad použitia:   <b>*prune 5</b></p>
                </div>

            </div>
            <div class="context-subtitle">
                GAME UPDATES
            </div>
            <div class="context-text">
                <div id="iq" class="context-nav-title">
                    <div>IQ</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*iq</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Zistíš svoje IQ.
                </div>

                <div id="cicina" class="context-nav-title">
                    <div>Cicina</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*cicina</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Zistíš dĺžku svojej ciciny.
                </div>

                <div id="csgo-maps" class="context-nav-title">
                    <div>CS:GO random map</div>
                    <div class="nav-tag">
                        <div class="nav-cube" style="background-color: rgb(66, 108, 197);">
                            <div class="nav-cube-text">Global</div>
                        </div>
                        <div class="nav-triangle" style="border-left: 20px solid rgb(66, 108, 197);"></div>
                    </div>    
                    <div class="usage">
                        <div class="usage-title">Použitie:</div>
                        <div class="usage-text">*map-a / *map-mm / *map-wm / *map-r [maps]</div>
                    </div>
                </div>
                <div class="context-nav-text">
                    Vyberie náhodnú mapu z daného map-poolu. <br>
                    Možnosti:
                    <ul>
                        <li><b>a</b> - <a href="https://liquipedia.net/counterstrike/Portal:Maps#Active_Duty_Map_Pool" target="_blank">Active map pool</a></li>
                        <li><b>wm</b> - Wingman maps</li>
                        <li><b>mm</b> - Competitive maps</li>
                        <li><b>r</b> - Vlastné mapy</li>
                    </ul>
                    <p>Príklad použitia:   <b>*map-r Mirage Anubis Aztec Inferno</b></p>
                    <img src="../img/examples/random-csgo-map.png" alt="random map example">
                </div>
            </div>


        </div>
    </div>

</body>
<script src="main.js"></script>
</html>  