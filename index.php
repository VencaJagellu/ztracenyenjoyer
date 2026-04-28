<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="hero animate-on-scroll">
    <div class="glass-card" style="max-width: 900px; padding: 4rem 2rem;">
        <h1>Největší komunita<br>Marka Ztraceného</h1>
        <p>Vítej na moderní fanpage <strong>marekztraceny_enjoyer</strong>. Místo, kde to žije hudbou, kde najdeš ty největší fanoušky a kde získáš svůj exkluzivní certifikát!</p>
        
        <div class="hero-buttons">
            <a href="certifikat.php" class="btn"><i class="fa-solid fa-award"></i> Získat certifikát</a>
            <a href="hry.php" class="btn btn-outline"><i class="fa-solid fa-gamepad"></i> Herní zóna</a>
        </div>
    </div>
</section>

<!-- Stats / Features Section -->
<section class="mt-5">
    <h2 class="section-title animate-on-scroll">Proč jsme nejlepší?</h2>
    <div class="features-grid">
        <div class="glass-card text-center animate-on-scroll" style="transition-delay: 0.1s;">
            <i class="fa-solid fa-users feature-icon"></i>
            <h3>Obrovská rodina</h3>
            <p class="mb-2">Spojujeme tisíce fanoušků z celé republiky. Společně tvoříme neuvěřitelnou atmosféru na koncertech i online.</p>
        </div>
        
        <div class="glass-card text-center animate-on-scroll" style="transition-delay: 0.2s;">
            <i class="fa-solid fa-music feature-icon"></i>
            <h3>Hudba na prvním místě</h3>
            <p class="mb-2">Aktuality, rozbory textů a žebříčky nejoblíbenějších písní. U nás ti žádná novinka z Markova světa neuteče.</p>
        </div>
        
        <div class="glass-card text-center animate-on-scroll" style="transition-delay: 0.3s;">
            <i class="fa-solid fa-face-smile-wink feature-icon"></i>
            <h3>Zábava navíc</h3>
            <p class="mb-2">Zkrať si čekání na další turné našimi exkluzivními minihrami nebo si vygeneruj fanouškovský certifikát.</p>
        </div>
    </div>
</section>

<!-- Interactive Features Section -->
<section class="mt-5 mb-5">
    <h2 class="section-title animate-on-scroll">Vyzkoušej exkluzivní obsah</h2>
    <div class="features-grid">
        <?php
        $features = [
            [
                'icon' => 'fa-guitar',
                'title' => 'AI Textař',
                'desc' => 'Vygeneruj si osobní vtipný text písně přesně v Markově stylu na míru.',
                'btn' => 'Napsat hit',
                'link' => 'textar.php'
            ],
            [
                'icon' => 'fa-music',
                'title' => 'Která jsi píseň?',
                'desc' => 'Udělej si rychlý psychologický kvíz a zjisti, jaký hit tě nejvíce vystihuje.',
                'btn' => 'Spustit kvíz',
                'link' => 'jaka-pisen.php'
            ],
            [
                'icon' => 'fa-award',
                'title' => 'Osobní Certifikát',
                'desc' => 'Stáhni si svůj exkluzivní grafický certifikát pravého fandy Marečka.',
                'btn' => 'Získat certifikát',
                'link' => 'certifikat.php'
            ],
            [
                'icon' => 'fa-crow',
                'title' => 'Flappy Marek',
                'desc' => 'Leť s Markem mezi překážkami a nasbírej co nejvíce bodů!',
                'btn' => 'Hrát',
                'link' => 'flappy.php'
            ],
            [
                'icon' => 'fa-layer-group',
                'title' => 'Muzikální Pexeso',
                'desc' => 'Najdi všechny páry a procvič si paměť s fotkami Marka!',
                'btn' => 'Hrát',
                'link' => 'pexeso.php'
            ],
            [
                'icon' => 'fa-face-smile-wink',
                'title' => 'Emoji Hádanky',
                'desc' => 'Dokážeš uhodnout název písničky pouze podle několika emotikonů?',
                'btn' => 'Hrát',
                'link' => 'uhadni.php'
            ],
            [
                'icon' => 'fa-hammer',
                'title' => 'Chyť Marka',
                'desc' => 'Marek je rychlý! Dokážeš na něj kliknout dřív, než zase zmizí?',
                'btn' => 'Hrát',
                'link' => 'chyt-marka.php'
            ],
            [
                'icon' => 'fa-robot',
                'title' => 'Marek AI',
                'desc' => 'Chatuj s virtuálním Markem. Zeptej se na cokoliv o jeho hudbě nebo životě!',
                'btn' => 'Pokecat',
                'link' => 'ai.php'
            ],
            [
                'icon' => 'fa-circle-question',
                'title' => 'Znalostní Kvíz',
                'desc' => 'Jak dobře znáš Marka Ztraceného? Otestuj své znalosti!',
                'btn' => 'Hrát',
                'link' => 'kviz.php'
            ]
        ];
        
        shuffle($features);
        $randomFeatures = array_slice($features, 0, 3);
        
        foreach ($randomFeatures as $index => $feature) {
            $delay = $index * 0.1;
            echo '<div class="glass-card text-center animate-on-scroll" style="transition-delay: '.$delay.'s; padding: 2rem; cursor: pointer;" onclick="window.location.href=\''.$feature['link'].'\'">';
            echo '    <div style="font-size: 3.5rem; margin-bottom: 1rem; color: var(--primary-red);"><i class="fa-solid '.$feature['icon'].'"></i></div>';
            echo '    <h3 style="color: var(--dark-red);">'.$feature['title'].'</h3>';
            echo '    <p class="mb-2">'.$feature['desc'].'</p>';
            echo '    <a href="'.$feature['link'].'" class="btn" style="margin-top: 0.5rem;">'.$feature['btn'].'</a>';
            echo '</div>';
        }
        ?>
    </div>
</section>

<!-- Instagram CTA Section -->
<section class="mt-5 mb-5 animate-on-scroll">
    <div class="glass-card" style="max-width: 900px; margin: 0 auto; padding: 3rem 2rem; text-align: center; background: linear-gradient(135deg, rgba(255,255,255,0.7) 0%, rgba(255,255,255,0.4) 100%);">
        <div style="width: 80px; height: 80px; border-radius: 20px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; margin: 0 auto 1.5rem; box-shadow: 0 10px 20px rgba(225, 48, 108, 0.3);">
            <i class="fa-brands fa-instagram"></i>
        </div>
        <h2 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: var(--text-main);">Sleduj nás na Instagramu</h2>
        <p style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 2rem;">Přidej se k naší komunitě fanoušků Marka Ztraceného!</p>
        <a href="https://www.instagram.com/marekztraceny_enjoyer" target="_blank" class="btn" style="background: linear-gradient(45deg, #f09433, #dc2743, #bc1888); border: none; padding: 15px 40px; font-size: 1.3rem; border-radius: 50px; display: inline-flex; align-items: center; gap: 10px;">
            <i class="fa-brands fa-instagram"></i> @marekztraceny_enjoyer
        </a>
    </div>
</section>

<!-- Top Hits Section -->
<section class="mt-5">
    <h2 class="section-title animate-on-scroll">Největší pecky</h2>
    <div class="glass-card animate-on-scroll">
        <div class="hits-grid">
            <div class="hit-card">
                <div class="hit-number">01</div>
                <div class="hit-info">
                    <h3>Ztrácíš</h3>
                    <p>Album: Ztrácíš (2008)</p>
                </div>
                <a href="https://open.spotify.com/search/Marek%20Ztracen%C3%BD%20Ztr%C3%A1c%C3%AD%C5%A1" target="_blank" style="margin-left: auto; text-decoration: none;">
                    <i class="fa-brands fa-spotify" style="font-size: 1.5rem; color: #1DB954; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"></i>
                </a>
            </div>
            
            <div class="hit-card">
                <div class="hit-number">02</div>
                <div class="hit-info">
                    <h3>Naše Cesty</h3>
                    <p>Album: Vlastní svět (2018)</p>
                </div>
                <a href="https://open.spotify.com/search/Marek%20Ztracen%C3%BD%20Na%C5%A1e%20Cesty" target="_blank" style="margin-left: auto; text-decoration: none;">
                    <i class="fa-brands fa-spotify" style="font-size: 1.5rem; color: #1DB954; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"></i>
                </a>
            </div>
            
            <div class="hit-card">
                <div class="hit-number">03</div>
                <div class="hit-info">
                    <h3>Moje milá</h3>
                    <p>Album: Planeta jménem stres (2020)</p>
                </div>
                <a href="https://open.spotify.com/search/Marek%20Ztracen%C3%BD%20Moje%20mil%C3%A1" target="_blank" style="margin-left: auto; text-decoration: none;">
                    <i class="fa-brands fa-spotify" style="font-size: 1.5rem; color: #1DB954; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"></i>
                </a>
            </div>
            
            <div class="hit-card">
                <div class="hit-number">04</div>
                <div class="hit-info">
                    <h3>Tak se nezlob</h3>
                    <p>Album: Planeta jménem stres (2020)</p>
                </div>
                <a href="https://open.spotify.com/search/Marek%20Ztracen%C3%BD%20Tak%20se%20nezlob" target="_blank" style="margin-left: auto; text-decoration: none;">
                    <i class="fa-brands fa-spotify" style="font-size: 1.5rem; color: #1DB954; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"></i>
                </a>
            </div>
            
            <div class="hit-card">
                <div class="hit-number">05</div>
                <div class="hit-info">
                    <h3>Stává se to i v lepších rodinách</h3>
                    <p>Miroslav Slodičák (Raritka)</p>
                </div>
                <a href="https://www.youtube.com/results?search_query=Miroslav+Slodi%C4%8D%C3%A1k+St%C3%A1v%C3%A1+se+to+i+v+lep%C5%A1%C3%ADch+rodin%C3%A1ch" target="_blank" style="margin-left: auto; text-decoration: none;" title="Píseň není na Spotify, zkus YouTube!">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Community / Testimonials -->
<section class="mt-5" style="margin-bottom: 4rem;">
    <h2 class="section-title animate-on-scroll">Co říkají fanoušci</h2>
    <div class="features-grid">
        <div class="glass-card animate-on-scroll" style="position: relative;">
            <i class="fa-solid fa-quote-left" style="font-size: 2rem; color: var(--primary-red); opacity: 0.3; position: absolute; top: 1rem; left: 1rem;"></i>
            <p style="margin-top: 1rem; font-style: italic;">"Nejlepší fanpage! Hned jsem si udělala certifikát a sdílela ho na sítě. A pexeso hraju snad každý den v autobuse!"</p>
            <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1.5rem;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary-red); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">A</div>
                <div>
                    <h4 style="margin: 0;">Aneta N.</h4>
                    <span style="font-size: 0.8rem; color: var(--text-muted);">Zarytá fanynka</span>
                </div>
            </div>
        </div>
        
        <div class="glass-card animate-on-scroll" style="transition-delay: 0.2s; position: relative;">
            <i class="fa-solid fa-quote-left" style="font-size: 2rem; color: var(--primary-red); opacity: 0.3; position: absolute; top: 1rem; left: 1rem;"></i>
            <p style="margin-top: 1rem; font-style: italic;">"Flappy Marek je strašně návykovej! Skvělý design a komunita. Už se těším na další koncerty, uvidíme se tam!"</p>
            <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1.5rem;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--dark-red); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">T</div>
                <div>
                    <h4 style="margin: 0;">Tomáš K.</h4>
                    <span style="font-size: 0.8rem; color: var(--text-muted);">Užívá si hudbu</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="mt-5 mb-5">
    <h2 class="section-title animate-on-scroll">Často kladené dotazy (FAQ)</h2>
    <div class="glass-card animate-on-scroll" style="max-width: 900px; margin: 0 auto; text-align: left;">
        <?php
        $faqs = [
            [
                'q' => 'Byl Jeffrey Epstein na Markově koncertě?',
                'a' => 'Marek k tomu vydal jasné prohlášení: „Ztrácíš“ se v tomto případě netýká důkazního materiálu a Epstein se rozhodně nezabil sám.'
            ],
            [
                'q' => 'Kolik litrů olejíčku spotřebuje P. Diddy v backstage?',
                'a' => 'Marek preferuje poctivý rock a čistý zvuk, takže v jeho šatně najdete maximálně minerálku, žádné baby oily.'
            ],
            [
                'q' => 'Jak Marek vnímá situaci v Izraeli?',
                'a' => 'Marek věří, že „Naše cesty“ by měly vést k míru, ale momentálně se soustředí hlavně na vyprodaný Eden.'
            ],
            [
                'q' => 'Co říká Donald Trump na Markovu novou desku?',
                'a' => '„It\'s a tremendous record, maybe the best in the history of music. Marek is a great guy, a very huge talent. We love him!“'
            ],
            [
                'q' => 'Zmenšuje se Charliemu Kirkovi obličej při poslechu Marka?',
                'a' => 'Vědecké studie Turning Point USA naznačují, že při vysokých tónech se Kirkův obličej smrskne o dalších 15 %.'
            ],
            [
                'q' => 'Jsme Petr Fiala?',
                'a' => 'Vysíláme jasný signál, že jsme především fanoušci, a naše hodnoty jsou pevně ukotveny v textech Marka Ztraceného.'
            ]
        ];
        shuffle($faqs);
        $selectedFaqs = array_slice($faqs, 0, 3);
        
        foreach ($selectedFaqs as $faq) {
            echo '<div style="margin-bottom: 2rem; border-bottom: 1px solid var(--glass-border); padding-bottom: 1rem;">';
            echo '    <h3 style="color: var(--primary-red); margin-bottom: 0.5rem; font-size: 1.3rem;">' . $faq['q'] . '</h3>';
            echo '    <p style="font-size: 1.1rem; color: var(--text-main); font-style: italic;">' . $faq['a'] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</section>



<?php include 'footer.php'; ?>
