<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="text-align: center;">
    <h1>Herní zóna</h1>
    <p>Odpočiň si u našich chytlavých miniher s tematikou tvého oblíbeného zpěváka!</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 3rem;">
        <div class="glass-card" style="padding: 2rem; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="window.location.href='flappy.php'">
            <div style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-crow"></i></div>
            <h2 style="color: var(--dark-red);">Flappy Marek</h2>
            <p>Leť s Markem mezi překážkami a nasbírej co nejvíce bodů!</p>
            <a href="flappy.php" class="btn" style="margin-top: 1rem;">Hrát</a>
        </div>
        
        <div class="glass-card" style="padding: 2rem; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="window.location.href='pexeso.php'">
            <div style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-layer-group"></i></div>
            <h2 style="color: var(--dark-red);">Muzikální Pexeso</h2>
            <p>Najdi všechny páry a procvič si paměť s fotkami Marka!</p>
            <a href="pexeso.php" class="btn" style="margin-top: 1rem;">Hrát</a>
        </div>
        
        <div class="glass-card" style="padding: 2rem; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="window.location.href='kviz.php'">
            <div style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-circle-question"></i></div>
            <h2 style="color: var(--dark-red);">Znalostní Kvíz</h2>
            <p>Jak dobře znáš Marka Ztraceného? Otestuj své znalosti v našem kvízu!</p>
            <a href="kviz.php" class="btn" style="margin-top: 1rem;">Hrát</a>
        </div>
        
        <div class="glass-card" style="padding: 2rem; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="window.location.href='slova.php'">
            <div style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-pen-nib"></i></div>
            <h2 style="color: var(--dark-red);">Doplň Text</h2>
            <p>Znáš texty písní nazpaměť? Doplň chybějící slova v Markových hitech.</p>
            <a href="slova.php" class="btn" style="margin-top: 1rem;">Hrát</a>
        </div>
        
        <div class="glass-card" style="padding: 2rem; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="window.location.href='uhadni.php'">
            <div style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-face-smile-wink"></i></div>
            <h2 style="color: var(--dark-red);">Emoji Hádanky</h2>
            <p>Dokážeš uhodnout název písničky pouze podle několika emotikonů?</p>
            <a href="uhadni.php" class="btn" style="margin-top: 1rem;">Hrát</a>
        </div>

        <div class="glass-card" style="padding: 2rem; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="window.location.href='chyt-marka.php'">
            <div style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-hammer"></i></div>
            <h2 style="color: var(--dark-red);">Chyť Marka</h2>
            <p>Marek je rychlý! Dokážeš na něj kliknout dřív, než zase zmizí?</p>
            <a href="chyt-marka.php" class="btn" style="margin-top: 1rem;">Hrát</a>
        </div>

        <div class="glass-card" style="padding: 2rem; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="window.location.href='jaka-pisen.php'">
            <div style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-music"></i></div>
            <h2 style="color: var(--dark-red);">Která jsi píseň?</h2>
            <p>Zábavný osobnostní kvíz. Odpověz na pár otázek a zjisti, který hit jsi ty!</p>
            <a href="jaka-pisen.php" class="btn" style="margin-top: 1rem;">Zjistit</a>
        </div>

        <div class="glass-card" style="padding: 2rem; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="window.location.href='textar.php'">
            <div style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-guitar"></i></div>
            <h2 style="color: var(--dark-red);">AI Textař</h2>
            <p>Nech si vygenerovat vtipný text písně přesně na míru podle tvého života.</p>
            <a href="textar.php" class="btn" style="margin-top: 1rem;">Napsat hit</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
