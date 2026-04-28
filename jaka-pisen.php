<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="max-width: 800px; margin: 0 auto; text-align: center;">
    <h1>Která jsi píseň?</h1>
    <p>Odpověz na 5 jednoduchých otázek a zjisti, která hitovka od Marka Ztraceného přesně vystihuje tvoji osobnost!</p>
    
    <div id="quiz-container" style="background: var(--white); padding: 2rem; border-radius: 15px; margin-top: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div id="question-text" style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; color: var(--dark-red);">Otázka se načítá...</div>
        <div id="answers-container" style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Buttons go here -->
        </div>
    </div>
    
    <div id="result-container" style="display: none; background: var(--white); padding: 2rem; border-radius: 15px; margin-top: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h2 style="color: var(--text-main); margin-bottom: 1rem;">Tvoje píseň je:</h2>
        <h1 id="result-title" style="color: var(--primary-red); font-size: 3rem; margin-bottom: 1rem;"></h1>
        <p id="result-desc" style="font-size: 1.2rem; color: var(--text-muted);"></p>
        <button onclick="location.reload()" class="btn" style="margin-top: 2rem;">Zkusit znovu</button>
    </div>
    
    <div style="margin-top: 2rem;">
        <a href="hry.php" class="btn btn-outline">Zpět na hry</a>
    </div>
</div>

<script>
const questions = [
    {
        question: "1. Jak nejraději trávíš páteční večer?",
        answers: [
            { text: "Na pořádné párty s přáteli!", score: "A" },
            { text: "Doma s vínem a dobrým filmem.", score: "B" },
            { text: "Někde na výletě nebo cestách.", score: "C" },
            { text: "Přemýšlím o životě a nostalgicky vzpomínám.", score: "D" }
        ]
    },
    {
        question: "2. Co je pro tebe ve vztahu nejdůležitější?",
        answers: [
            { text: "Zábava a upřímnost.", score: "A" },
            { text: "Abychom to spolu zvládli i ve stáří.", score: "B" },
            { text: "Společné zážitky a objevování.", score: "C" },
            { text: "I když to nevyjde, uchovat si hezké vzpomínky.", score: "D" }
        ]
    },
    {
        question: "3. Jaký je tvůj nejoblíbenější nápoj?",
        answers: [
            { text: "Pivo nebo panáky!", score: "A" },
            { text: "Dvě láhve vína.", score: "B" },
            { text: "Káva na cestu.", score: "C" },
            { text: "Něco silnějšího na žal...", score: "D" }
        ]
    },
    {
        question: "4. Když se něco nedaří, tak...",
        answers: [
            { text: "Mávnu nad tím rukou a jdu dál.", score: "A" },
            { text: "Opřu se o svou polovičku.", score: "B" },
            { text: "Hledám novou cestu.", score: "C" },
            { text: "Chvíli se tím trápím.", score: "D" }
        ]
    },
    {
        question: "5. Jaká je tvoje oblíbená roční doba?",
        answers: [
            { text: "Léto! Dlouhé večery a festivaly.", score: "A" },
            { text: "Zima u krbu.", score: "B" },
            { text: "Jaro, když všechno začíná.", score: "C" },
            { text: "Podzim, trochu melancholie.", score: "D" }
        ]
    }
];

const results = {
    "A": {
        title: "Tak se nezlob",
        desc: "Jsi párty zvíře, miluješ život, zábavu a neděláš si z ničeho těžkou hlavu! Jsi středem pozornosti a s tebou se nikdo nenudí."
    },
    "B": {
        title: "Moje milá",
        desc: "Jsi romantik tělem i duší. Ceníš si trvalých vztahů, pohody domova a věříš, že pravá láska vydrží úplně všechno."
    },
    "C": {
        title: "Naše cesty",
        desc: "Jsi dobrodruh. Miluješ objevování, sdílení zážitků a jít si svou vlastní, klidně i klikatou, cestou."
    },
    "D": {
        title: "Ztrácíš",
        desc: "Máš hlubokou a přemýšlivou duši. Občas se ponoříš do nostalgie, prožíváš emoce velmi naplno a nic nebereš na lehkou váhu."
    }
};

let currentQ = 0;
let userScores = { "A": 0, "B": 0, "C": 0, "D": 0 };

function loadQuestion() {
    const q = questions[currentQ];
    document.getElementById("question-text").innerText = q.question;
    const container = document.getElementById("answers-container");
    container.innerHTML = "";
    
    q.answers.forEach(ans => {
        const btn = document.createElement("button");
        btn.innerText = ans.text;
        btn.classList.add("btn", "btn-outline");
        btn.style.width = "100%";
        btn.style.textAlign = "left";
        btn.style.boxSizing = "border-box";
        btn.onclick = () => selectAnswer(ans.score);
        container.appendChild(btn);
    });
}

function selectAnswer(scoreLetter) {
    userScores[scoreLetter]++;
    currentQ++;
    
    if (currentQ < questions.length) {
        loadQuestion();
    } else {
        showResult();
    }
}

function showResult() {
    document.getElementById("quiz-container").style.display = "none";
    document.getElementById("result-container").style.display = "block";
    
    let highestScore = 0;
    let finalLetter = "A";
    
    for (const [letter, score] of Object.entries(userScores)) {
        if (score > highestScore) {
            highestScore = score;
            finalLetter = letter;
        }
    }
    
    const finalResult = results[finalLetter];
    document.getElementById("result-title").innerText = finalResult.title;
    document.getElementById("result-desc").innerText = finalResult.desc;
}

loadQuestion();
</script>

<?php include 'footer.php'; ?>
