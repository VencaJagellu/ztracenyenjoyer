<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="max-width: 800px; margin: 0 auto;">
    <h1 style="text-align: center;">Tvůj fanouškovský certifikát</h1>
    <p style="text-align: center;">Vygeneruj si svůj oficiální certifikát nejvěrnějšího fanouška Marka Ztraceného!</p>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["jmeno"])): ?>
        <?php $jmeno = htmlspecialchars($_POST["jmeno"]); ?>
        <div id="cert-container" style="background: linear-gradient(135deg, #ffebee, #ffcccc); border: 5px solid var(--primary-red); border-radius: 15px; padding: 3rem; margin: 2rem auto; max-width: 600px; box-shadow: 0 10px 30px rgba(255, 75, 75, 0.2); position: relative; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid fa-trophy"></i></div>
            <h2 style="color: var(--dark-red); font-size: 2rem; margin-bottom: 1rem;">Oficiální Certifikát</h2>
            <p style="font-size: 1.2rem; margin-bottom: 1rem;">Tímto se potvrzuje, že</p>
            <h3 style="font-size: 2.5rem; color: var(--primary-red); font-family: 'Comic Sans MS', 'Nunito', sans-serif; margin-bottom: 1rem; border-bottom: 2px dashed var(--primary-red); padding-bottom: 0.5rem; display: inline-block;"><?php echo $jmeno; ?></h3>
            <p style="font-size: 1.2rem; margin-bottom: 2rem;">je právoplatným a nejvěrnějším fanouškem Marka Ztraceného!</p>
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 2rem;">
                <div style="text-align: left;">
                    <p style="border-top: 1px solid black; padding-top: 5px;">Datum: <?php echo date("d. m. Y"); ?></p>
                </div>
                <div style="text-align: center; position: relative; z-index: 2;">
                    <div style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.1rem; color: var(--dark-red); background: rgba(255, 51, 102, 0.1); padding: 5px 15px; border-radius: 20px; transform: rotate(-3deg); display: inline-block; margin-bottom: 5px; border: 2px solid var(--primary-red);">@marekztraceny_enjoyer</div>
                    <p style="border-top: 1px solid black; padding-top: 5px; margin-top: 5px;">Ověřeno komunitou</p>
                </div>
            </div>
            <!-- Zlatá pečeť přesunuta doprostřed -->
            <div style="position: absolute; bottom: 25px; left: 50%; transform: translateX(-50%); background: gold; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; box-shadow: 0 4px 10px rgba(0,0,0,0.2); border: 2px dashed #b8860b;">
                <i class="fa-solid fa-star" style="color: #fff; font-size: 1.5rem;"></i>
            </div>
        </div> <!-- End of cert-container -->
        <div style="text-align: center; margin-top: 2rem;">
            <button onclick="downloadCertifikat()" class="btn"><i class="fa-solid fa-download"></i> Stáhnout jako obrázek</button>
            <a href="certifikat.php" class="btn btn-outline" style="margin-left: 1rem;"><i class="fa-solid fa-rotate-right"></i> Vytvořit nový</a>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script>
            function downloadCertifikat() {
                const element = document.getElementById('cert-container');
                html2canvas(element, { scale: 2 }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'certifikat_fanouska.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                });
            }
        </script>
    <?php else: ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="margin-top: 2rem; display: flex; flex-direction: column; align-items: center; gap: 1rem;">
            <label for="jmeno" style="font-size: 1.2rem; font-weight: bold;">Tvé jméno (nebo přezdívka):</label>
            <input type="text" id="jmeno" name="jmeno" required style="padding: 10px; font-size: 1.2rem; border-radius: 25px; border: 2px solid var(--primary-red); outline: none; width: 100%; max-width: 400px; text-align: center;">
            <button type="submit" class="btn" style="font-size: 1.2rem; padding: 12px 30px;"><i class="fa-solid fa-wand-magic-sparkles"></i> Generovat</button>
        </form>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
