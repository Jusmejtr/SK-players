function show_image(src) {
  var img = document.createElement("img");
  img.src = src;
  img.id = 'adblock_img';

   document.body.style.overflow = 'hidden';
   document.body.style.height = '100%';

  document.body.appendChild(img);

  img.style.width = '100%';
  img.style.zIndex = 2;

  img.style.position = 'fixed';
  img.style.top = '50%';
  img.style.left = '50%';
  img.style.transform = 'translate(-50%, -50%)';
}

async function detectAdBlock() {
    let adBlockEnabled = false
    const googleAdUrl = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'
    try {
      await fetch(new Request(googleAdUrl)).catch(_ => adBlockEnabled = true)
    } catch (e) {
      adBlockEnabled = true
    } finally {
      console.log(`AdBlock Enabled: ${adBlockEnabled}`)
    }
    if(adBlockEnabled == true){
        show_image('/adblock/adblock.png');
    }
}
