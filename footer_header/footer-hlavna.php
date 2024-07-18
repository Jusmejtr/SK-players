<?php include 'sendemail.php'; ?>

<link rel="stylesheet" href="/css/footer/footer-hlavna.css">

<!--alert po odoslaní-->
<?php echo $alert; ?>

<footer class="pc">
      <div class="footer-main">
        <div class="lava">
            <h2 class="hl_nadpis">SK players</h2>
            <div class="siete">
              <p class="dc"><a href="https://discord.gg/6uxHBdYA3v" target="_blank"><i class="fab fa-discord"></i> SK players</a></p> 
              <p class="steam"><a href="https://steamcommunity.com/groups/skkplayers" target="_blank"><i class="fab fa-steam"></i> SK players</a></p>
            </div>
        </div>

        <div class="stred">
          <div>
            <h3 class="nadpis">Kontakt</h3>
          </div>

          <div class="contact-section">     
            <div class="contact-form">
              <form class="contact" action="" method="post">
                <div class="meno-dovod">
                  <div class="meno">
                    <div class="contact-input-nazov">Meno <div class="volitelne">(voliteľné)</div> </div> 
                    <input type="text" name="meno" class="text-box" placeholder="Meno">
                  </div>

                  <div class="dovod">
                    <div class="contact-input-nazov">Dôvod kontaktu</div>
                    <select name="vyber" id="vyber">
                      <option value="Nevybrane">----------</option>
                      <option value="Chyba na stránke">Chyba na stránke</option>
                      <option value="Typ na game stats">Typ na game stats</option>
                      <option value="Typ na game updates">Typ na game updates</option>
                      <option value="Napíšem do správy">Napíšem do správy</option>
                    </select> <br>
                  </div>
                </div>
                <br>
                <div class="contact-input-nazov">Správa</div>
                <textarea name="sprava" rows="4" cols="42" placeholder="Správa" required></textarea> 
                <br>
                <input type="submit" name="odosli" class="send-btn" value="Odoslať">
              </form>
            </div>
          </div>
        </div>       

        <div class="prava">
            <div class="linky">
              <h3 class="nadpis">Linky</h3> <br>
              <h4 class="nadpis">Game stats: </h4>
              <p><a href="/game-stats/csgo/index.php">CS:GO</a></p>
              <p><a href="/game-stats/slapshot-rebound/index.php">Slapshot Rebound</a></p> <br>
              <h4 class="nadpis">Game updates: </h4>
              <p><a href="/game-updates/ets2/index.php">ETS2</a></p>
              <p><a href="/game-updates/slapshot-rebound/index.php">Slapshot Rebound</a></p>
            </div>
            </div>
              
        </div>
      </div>

      <!-- <button id="btnScrollToTop" class="arrow">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
      </button> -->

      <div class="copy">
        <div class="cp">
            &copy SK players 2018 - <?php echo date('Y'); ?>
        </div>
      </div>
    </footer>
  
  <!-- Po odoslani mailu sa vymaze historia -->
  <script type="text/javascript">
      if(window.history.replaceState){
      window.history.replaceState(null, null, window.location.href);
    }

    // const btnScrollToTop = document.querySelector("#btnScrollToTop")
    // btnScrollToTop.addEventListener("click", function() {
    //     window.scrollTo(0, 0);
    // })
  </script>


