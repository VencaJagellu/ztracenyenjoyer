<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="max-width: 800px; margin: 0 auto;">
    <h1 style="text-align: center;">Znalostní Kvíz</h1>
    <p style="text-align: center;">Otestuj své znalosti o Markovi! Vyber vždy jednu správnou odpověď.</p>
    
    <div id="quiz-container" style="background: var(--white); padding: 2rem; border-radius: 15px; margin-top: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div id="question" style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; color: var(--dark-red);">Otázka se načítá...</div>
        <div id="options" style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Možnosti se generují z JS -->
        </div>
        <div id="result" style="margin-top: 1.5rem; font-size: 1.2rem; font-weight: bold; display: none;"></div>
        <button id="next-btn" class="btn" style="margin-top: 1.5rem; display: none;">Další otázka</button>
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="hry.php" class="btn btn-outline">Zpět na hry</a>
    </div>
</div>

<script>
const quizData = [
    {
        question: "Jaké je vlastní jméno Marka Ztraceného?",
        a: "Marek Ztracený",
        b: "Miroslav Slodičák",
        c: "Martin Železný",
        d: "Milan Ztracený",
        correct: "b"
    },
    {
        question: "V jakém roce vyšlo jeho první album Ztrácíš?",
        a: "2006",
        b: "2008",
        c: "2010",
        d: "2012",
        correct: "b"
    },
    {
        question: "Ze kterého města Marek pochází?",
        a: "Praha",
        b: "Plzeň",
        c: "Železná Ruda",
        d: "Karlovy Vary",
        correct: "c"
    },
    {
        question: "Která z těchto písní NENÍ od Marka Ztraceného?",
        a: "Naše cesty",
        b: "Tak se nezlob",
        c: "Moje milá",
        d: "Cesta",
        correct: "d"
    }
];

let currentQuiz = 0;
let score = 0;

const questionEl = document.getElementById("question");
const optionsEl = document.getElementById("options");
const nextBtn = document.getElementById("next-btn");
const resultEl = document.getElementById("result");

function loadQuiz() {
    resultEl.style.display = "none";
    nextBtn.style.display = "none";
    optionsEl.innerHTML = "";
    
    const currentQuizData = quizData[currentQuiz];
    questionEl.innerText = currentQuizData.question;
    
    const letters = ['a', 'b', 'c', 'd'];
    letters.forEach(letter => {
        const btn = document.createElement("button");
        btn.innerText = currentQuizData[letter];
        btn.style.padding = "10px 20px";
        btn.style.fontSize = "1.1rem";
        btn.style.border = "2px solid var(--primary-red)";
        btn.style.borderRadius = "10px";
        btn.style.background = "transparent";
        btn.style.cursor = "pointer";
        btn.style.transition = "all 0.3s ease";
        btn.onmouseover = () => { btn.style.background = "var(--primary-red)"; btn.style.color = "white"; };
        btn.onmouseout = () => { btn.style.background = "transparent"; btn.style.color = "black"; };
        
        btn.onclick = () => selectAnswer(letter, currentQuizData.correct, btn);
        optionsEl.appendChild(btn);
    });
}

function selectAnswer(answer, correct, btnElement) {
    const allButtons = optionsEl.querySelectorAll('button');
    allButtons.forEach(btn => {
        btn.disabled = true;
        btn.onmouseover = null;
        btn.onmouseout = null;
    });

    resultEl.style.display = "block";
    
    if(answer === correct) {
        btnElement.style.background = "#28a745"; // green
        btnElement.style.color = "white";
        btnElement.style.borderColor = "#28a745";
        resultEl.innerText = "Správně! 🎉";
        resultEl.style.color = "#28a745";
        score++;
    } else {
        btnElement.style.background = "#dc3545"; // red
        btnElement.style.color = "white";
        btnElement.style.borderColor = "#dc3545";
        resultEl.innerText = "Špatně! Správná odpověď byla: " + quizData[currentQuiz][correct];
        resultEl.style.color = "#dc3545";
    }
    
    nextBtn.style.display = "inline-block";
}

nextBtn.addEventListener("click", () => {
    currentQuiz++;
    if(currentQuiz < quizData.length) {
        loadQuiz();
    } else {
        questionEl.innerText = "Kvíz dokončen!";
        optionsEl.innerHTML = `<p style="font-size: 1.5rem; text-align: center;">Tvoje skóre: <strong style="color: var(--primary-red);">${score}/${quizData.length}</strong></p>`;
        resultEl.style.display = "none";
        nextBtn.innerText = "Hrát znovu";
        nextBtn.onclick = () => location.reload();
    }
});

loadQuiz();
</script>

<?php include 'footer.php'; ?>
