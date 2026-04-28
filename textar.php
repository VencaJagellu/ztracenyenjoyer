<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="max-width: 800px; margin: 0 auto; text-align: center;">
    <h1>AI Textař: Napiš si hit</h1>
    <p>Zadej pár údajů a my ti vygenerujeme osobní text písně přesně ve stylu Marka Ztraceného!</p>
    
    <div style="background: var(--white); padding: 2rem; border-radius: 15px; margin-top: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: left;">
        <div style="margin-bottom: 1rem;">
            <label style="font-weight: bold; color: var(--dark-red);">Tvoje jméno:</label>
            <input type="text" id="userName" placeholder="Např. Tomáš" style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid var(--primary-red); outline: none; margin-top: 5px; font-family: inherit;">
        </div>
        <div style="margin-bottom: 1rem;">
            <label style="font-weight: bold; color: var(--dark-red);">Co rád piješ?</label>
            <input type="text" id="drink" placeholder="Např. pivo, víno, kofolu..." style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid var(--primary-red); outline: none; margin-top: 5px; font-family: inherit;">
        </div>
        <div style="margin-bottom: 1.5rem;">
            <label style="font-weight: bold; color: var(--dark-red);">S čím se teď trápíš?</label>
            <input type="text" id="problem" placeholder="Např. nemám peníze, nestíhám do práce..." style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid var(--primary-red); outline: none; margin-top: 5px; font-family: inherit;">
        </div>
        
        <button onclick="generateHit()" class="btn" style="width: 100%;">Vygenerovat můj hit!</button>
    </div>
    
    <div id="lyric-result" style="display: none; background: var(--light-pink); padding: 2rem; border-radius: 15px; margin-top: 2rem; border: 2px dashed var(--primary-red);">
        <h2 style="color: var(--dark-red); margin-bottom: 1rem;">Tvoje nová pecka:</h2>
        <div id="lyric-content" style="font-size: 1.3rem; font-style: italic; line-height: 1.8; color: var(--text-main); white-space: pre-wrap;"></div>
    </div>
    
    <div style="margin-top: 2rem;">
        <a href="hry.php" class="btn btn-outline">Zpět na hry</a>
    </div>
</div>

<script>
function generateHit() {
    const name = document.getElementById('userName').value || "Kámo";
    const drink = document.getElementById('drink').value || "vodu";
    const problem = document.getElementById('problem').value || "prostě smůlu";
    
    const lyrics = `
Slunce už zapadá a já tu sedím sám,
v ruce držím ${drink} a na tebe vzpomínám.
Říkám si, ${name}, kam se ten čas poděl,
že ${problem}, to jsem vážně nechtěl.

Ale cesty jsou klikatý a my nejsme ztracení,
i když se to někdy zdá, jako blbý znamení.
Zítra ráno vstanem a zkusíme to zas,
${name} a já, nezastaví nás ani čas!
`;

    document.getElementById('lyric-result').style.display = "block";
    document.getElementById('lyric-content').innerText = lyrics.trim();
    
    setTimeout(() => {
        document.getElementById('lyric-result').scrollIntoView({behavior: "smooth"});
    }, 100);
}
</script>

<?php include 'footer.php'; ?>
