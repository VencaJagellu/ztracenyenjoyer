<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="max-width: 800px; margin: 0 auto;">
    <h1 style="text-align: center;">Doplň Text</h1>
    <p style="text-align: center;">Znáš texty písní Marka Ztraceného nazpaměť? Doplň chybějící slovo!</p>
    
    <div id="game-container" style="background: var(--white); padding: 2rem; border-radius: 15px; margin-top: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center;">
        <div id="lyric" style="font-size: 1.8rem; font-style: italic; margin-bottom: 2rem; color: var(--text-main);">
            Načítám text...
        </div>
        
        <input type="text" id="answer-input" placeholder="Zadej chybějící slovo" style="padding: 15px 25px; font-size: 1.2rem; border-radius: 30px; border: 2px solid var(--primary-red); outline: none; width: 80%; max-width: 400px; margin-bottom: 1rem; text-align: center;">
        <br>
        <button id="check-btn" class="btn">Zkontrolovat</button>
        
        <div id="feedback" style="margin-top: 1.5rem; font-size: 1.5rem; font-weight: bold; display: none;"></div>
        <button id="next-lyric-btn" class="btn btn-outline" style="margin-top: 1.5rem; display: none;">Další píseň</button>
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="hry.php" class="btn btn-outline">Zpět na hry</a>
    </div>
</div>

<script>
const lyricsData = [
    { text: "Ztrácíš se z mojí ..., a lidi od nepaměti se znovu scházej", answer: "paměti" },
    { text: "Naše cesty rovný, a nebo klikatý, všechno bude ..., jsme jenom já a ty", answer: "dobrý" },
    { text: "Moje milá, pomalu stárnem, však neměj ..., spolu to zvládnem", answer: "strach" },
    { text: "Mám tě rád a i když děláme ..., život s tebou se mi vážně líbí", answer: "chyby" }
];

let currentLevel = 0;

const lyricEl = document.getElementById("lyric");
const answerInput = document.getElementById("answer-input");
const checkBtn = document.getElementById("check-btn");
const feedbackEl = document.getElementById("feedback");
const nextBtn = document.getElementById("next-lyric-btn");

function loadLyric() {
    feedbackEl.style.display = "none";
    nextBtn.style.display = "none";
    answerInput.value = "";
    answerInput.disabled = false;
    checkBtn.style.display = "inline-block";
    
    lyricEl.innerHTML = `„${lyricsData[currentLevel].text.replace('...', '<span style="color: var(--primary-red);">...</span>')}“`;
    answerInput.focus();
}

function checkAnswer() {
    const userAnswer = answerInput.value.trim().toLowerCase();
    const correctAnswer = lyricsData[currentLevel].answer.toLowerCase();
    
    feedbackEl.style.display = "block";
    
    if(userAnswer === correctAnswer) {
        feedbackEl.innerText = "Správně! 👏";
        feedbackEl.style.color = "#28a745";
        answerInput.disabled = true;
        checkBtn.style.display = "none";
        nextBtn.style.display = "inline-block";
    } else {
        feedbackEl.innerText = "Špatně, zkus to znovu! 🤔";
        feedbackEl.style.color = "#dc3545";
        answerInput.value = "";
        answerInput.focus();
    }
}

checkBtn.addEventListener("click", checkAnswer);

answerInput.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        if(!answerInput.disabled) {
            checkAnswer();
        }
    }
});

nextBtn.addEventListener("click", () => {
    currentLevel++;
    if(currentLevel < lyricsData.length) {
        loadLyric();
    } else {
        lyricEl.innerHTML = "Došli jsme na konec! Znáš jeho texty skvěle.";
        answerInput.style.display = "none";
        checkBtn.style.display = "none";
        feedbackEl.style.display = "none";
        nextBtn.innerText = "Hrát znovu";
        nextBtn.onclick = () => location.reload();
    }
});

loadLyric();
</script>

<?php include 'footer.php'; ?>
