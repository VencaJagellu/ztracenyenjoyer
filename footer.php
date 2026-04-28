    </main>
    <footer>
        <p>Vytvořeno s <i class="fa-solid fa-heart" style="color: var(--primary-red);"></i> pro fanoušky Marka Ztraceného &copy; <?php echo date("Y"); ?></p>
    </footer>
    <script src="script.js"></script>
    
    <!-- Vanilla Tilt 3D Effect -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
    <script>
        VanillaTilt.init(document.querySelectorAll(".glass-card"), {
            max: 5,
            speed: 400,
            glare: true,
            "max-glare": 0.15
        });
    </script>
    
    <!-- Floating Notes Background -->
    <style>
        .floating-note {
            position: fixed;
            bottom: -50px;
            color: var(--primary-red);
            opacity: 0.2;
            animation: floatUp linear infinite;
            z-index: -1;
            pointer-events: none;
            font-size: 24px;
        }
        @keyframes floatUp {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
    </style>
    <script>
        function createNote() {
            const note = document.createElement("div");
            note.classList.add("floating-note");
            note.innerHTML = ['🎵', '🎶', '🎤', '🎸'][Math.floor(Math.random() * 4)];
            note.style.left = Math.random() * 100 + "vw";
            note.style.animationDuration = Math.random() * 10 + 10 + "s";
            note.style.fontSize = Math.random() * 20 + 20 + "px";
            document.body.appendChild(note);
            
            setTimeout(() => { note.remove(); }, 12000);
        }
        setInterval(createNote, 3000);

        // Dark Mode Toggle
        const themeToggleBtn = document.getElementById('theme-toggle');
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            document.documentElement.setAttribute('data-theme', currentTheme);
            if (currentTheme === 'dark' && themeToggleBtn) {
                themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i>';
            }
        }
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function() {
                let theme = document.documentElement.getAttribute('data-theme');
                let targetTheme = 'light';
                if (theme === 'light' || !theme) {
                    targetTheme = 'dark';
                    themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i>';
                } else {
                    targetTheme = 'light';
                    themeToggleBtn.innerHTML = '<i class="fa-solid fa-moon"></i>';
                }
                document.documentElement.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
            });
        }

        // Jumpscare Easter Egg
        const marekImages = [
            "https://is1-ssl.mzstatic.com/image/thumb/Music126/v4/e7/00/e9/e700e9c5-2323-d759-5156-775dd96e9f2b/cover.jpg/400x400bb.jpg",
            "https://is1-ssl.mzstatic.com/image/thumb/Music124/v4/33/d1/fe/33d1fe9a-4ea4-354b-d5a9-3e05e972fc00/cover.jpg/400x400bb.jpg",
            "https://is1-ssl.mzstatic.com/image/thumb/Music122/v4/d7/54/5f/d7545f0c-6d6d-bd26-4b35-7938374cc0d8/cover.jpg/400x400bb.jpg",
            "https://is1-ssl.mzstatic.com/image/thumb/Music124/v4/7a/7d/2a/7a7d2a6f-11e6-17b2-950e-0fea5e386997/cover.jpg/400x400bb.jpg",
            "https://is1-ssl.mzstatic.com/image/thumb/Music114/v4/6a/82/71/6a82715e-1a8c-6e8c-6fc6-c981adfe74cc/cover.jpg/400x400bb.jpg"
        ];
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                activateJumpscare();
            }
        });

        function activateJumpscare() {
            if (document.getElementById('marek-jumpscare')) return;
            
            const randomImg = marekImages[Math.floor(Math.random() * marekImages.length)];
            const marek = document.createElement('img');
            marek.id = 'marek-jumpscare';
            marek.src = randomImg;
            marek.style.position = 'fixed';
            marek.style.top = '0';
            marek.style.left = '0';
            marek.style.width = '100vw';
            marek.style.height = '100vh';
            marek.style.objectFit = 'cover';
            marek.style.zIndex = '999999';
            marek.style.pointerEvents = 'none';
            marek.style.animation = 'jumpscareShake 0.1s infinite';
            
            document.body.appendChild(marek);
            
            if (!document.getElementById('jumpscare-style')) {
                const style = document.createElement('style');
                style.id = 'jumpscare-style';
                style.innerHTML = `
                    @keyframes jumpscareShake {
                        0% { transform: translate(10px, 10px) rotate(0deg); }
                        10% { transform: translate(-10px, -20px) rotate(-1deg); }
                        20% { transform: translate(-30px, 0px) rotate(1deg); }
                        30% { transform: translate(30px, 20px) rotate(0deg); }
                        40% { transform: translate(10px, -10px) rotate(1deg); }
                        50% { transform: translate(-10px, 20px) rotate(-1deg); }
                        60% { transform: translate(-30px, 10px) rotate(0deg); }
                        70% { transform: translate(30px, 10px) rotate(-1deg); }
                        80% { transform: translate(-10px, -10px) rotate(1deg); }
                        90% { transform: translate(10px, 20px) rotate(0deg); }
                        100% { transform: translate(10px, -20px) rotate(-1deg); }
                    }
                `;
                document.head.appendChild(style);
            }
            
            setTimeout(() => { marek.remove(); }, 800);
        }
    </script>
</body>
</html>
