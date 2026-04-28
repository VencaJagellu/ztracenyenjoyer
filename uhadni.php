<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="max-width: 800px; margin: 0 auto; text-align: center;">
    <h1>Emoji Hádanky</h1>
    <p>Uhodni název písně Marka Ztraceného jen podle smajlíků!</p>
    
    <div id="game-container" style="background: var(--white); padding: 2rem; border-radius: 15px; margin-top: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div id="emojis" style="font-size: 4rem; margin-bottom: 2rem; letter-spacing: 15px;">
            ⏳
        </div>
        
        <div id="options" style="display: flex; flex-direction: column; gap: 1rem; max-width: 400px; margin: 0 auto;">
            <!-- Buttons go here -->
        </div>
        
        <div id="feedback" style="margin-top: 1.5rem; font-size: 1.5rem; font-weight: bold; display: none;"></div>
        <button id="next-btn" class="btn btn-outline" style="margin-top: 1.5rem; display: none;">Další hádanka</button>
    </div>
    
    <div style="margin-top: 2rem;">
        <a href="hry.php" class="btn btn-outline">Zpět na hry</a>
    </div>
</div>

<script>
const emojiData = [
    { emojis: "👨‍👩‍👧‍👦🛣️", answer: "Naše cesty", options: ["Naše cesty", "Rodina", "Ztrácíš", "Dvě láhve vína"] },
    { emojis: "💔😢", answer: "Ztrácíš", options: ["Léto 95", "Ztrácíš", "Originál", "Tak se nezlob"] },
    { emojis: "☀️📅9️⃣5️⃣", answer: "Léto 95", options: ["Moje milá", "Naše cesty", "Léto 95", "Planeta jménem stres"] },
    { emojis: "👫❤️🥇", answer: "Moje milá", options: ["Originál", "Moje milá", "Píseň rodičům", "Když tě život kope do zadku"] },
    { emojis: "🍷🍷", answer: "Dvě láhve vína", options: ["Dvě láhve vína", "Pijeme", "Ztrácíš", "V opilosti"] },
    { emojis: "🧑✨", answer: "Originál", options: ["Hvězda", "Originál", "Tak se nezlob", "Moje milá"] }
];

let currentLevel = 0;
let score = 0;

const emojisEl = document.getElementById("emojis");
const optionsEl = document.getElementById("options");
const feedbackEl = document.getElementById("feedback");
const nextBtn = document.getElementById("next-btn");

function loadLevel() {
    feedbackEl.style.display = "none";
    nextBtn.style.display = "none";
    optionsEl.innerHTML = "";
    
    const data = emojiData[currentLevel];
    emojisEl.innerText = data.emojis;
    
    // Shuffle options
    const shuffledOptions = [...data.options].sort(() => Math.random() - 0.5);
    
    shuffledOptions.forEach(opt => {
        const btn = document.createElement("button");
        btn.innerText = opt;
        btn.style.padding = "12px 20px";
        btn.style.fontSize = "1.2rem";
        btn.style.border = "2px solid var(--primary-red)";
        btn.style.borderRadius = "10px";
        btn.style.background = "transparent";
        btn.style.cursor = "pointer";
        btn.style.transition = "all 0.3s ease";
        
        btn.onmouseover = () => { btn.style.background = "var(--primary-red)"; btn.style.color = "white"; };
        btn.onmouseout = () => { btn.style.background = "transparent"; btn.style.color = "black"; };
        
        btn.onclick = () => checkAnswer(opt, data.answer, btn);
        optionsEl.appendChild(btn);
    });
}

function checkAnswer(selected, correct, btnElement) {
    const allButtons = optionsEl.querySelectorAll('button');
    allButtons.forEach(btn => {
        btn.disabled = true;
        btn.onmouseover = null;
        btn.onmouseout = null;
    });

    feedbackEl.style.display = "block";
    
    if(selected === correct) {
        btnElement.style.background = "#28a745";
        btnElement.style.color = "white";
        btnElement.style.borderColor = "#28a745";
        feedbackEl.innerText = "Správně! 🎉";
        feedbackEl.style.color = "#28a745";
        score++;
    } else {
        btnElement.style.background = "#dc3545";
        btnElement.style.color = "white";
        btnElement.style.borderColor = "#dc3545";
        feedbackEl.innerText = "Špatně! Správná odpověď byla: " + correct;
        feedbackEl.style.color = "#dc3545";
    }
    
    nextBtn.style.display = "inline-block";
}

nextBtn.addEventListener("click", () => {
    currentLevel++;
    if(currentLevel < emojiData.length) {
        loadLevel();
    } else {
        emojisEl.innerText = "🏆";
        optionsEl.innerHTML = `<p style="font-size: 1.5rem;">Tvoje skóre: <strong style="color: var(--primary-red);">${score}/${emojiData.length}</strong></p>`;
        feedbackEl.style.display = "none";
        nextBtn.innerText = "Hrát znovu";
        nextBtn.onclick = () => location.reload();
    }
});

loadLevel();
</script>

<?php include 'footer.php'; ?>
