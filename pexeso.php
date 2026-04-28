<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="text-align: center; max-width: 800px; margin: 0 auto;">
    <h1>Muzikální Pexeso</h1>
    <p>Najdi všechny dvojice! Trénuj svou paměť v rytmu Marka Ztraceného.</p>
    
    <div style="margin: 1rem 0;">
        <span style="font-size: 1.2rem; font-weight: bold; color: var(--primary-red);">Tahů: <span id="moves">0</span></span>
    </div>

    <div id="game-board" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; max-width: 400px; margin: 0 auto;">
        <!-- Cards will be generated here by JS -->
    </div>
    
    <button id="restartPexeso" class="btn" style="margin-top: 2rem;">Hrát znovu</button>
</div>

<style>
    .memory-card {
        width: 100%;
        aspect-ratio: 1;
        background-color: var(--primary-red);
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 3rem;
        color: transparent;
        cursor: pointer;
        transition: transform 0.3s, background-color 0.3s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        user-select: none;
    }
    
    .memory-card.flipped {
        background-color: white;
        color: black;
        transform: rotateY(180deg);
        border: 2px solid var(--primary-red);
    }

    .memory-card span {
        opacity: 0;
        transition: opacity 0.1s ease-in-out;
    }
    
    .memory-card.flipped span {
        opacity: 1;
        transition-delay: 0.1s;
    }
    
    .memory-card.matched {
        background-color: #ffcccc;
        color: black;
        cursor: default;
        animation: pulse 0.5s ease;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
</style>

<script>
    const emojis = [
        '<img src="https://is1-ssl.mzstatic.com/image/thumb/Music126/v4/e7/00/e9/e700e9c5-2323-d759-5156-775dd96e9f2b/cover.jpg/400x400bb.jpg" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">', 
        '<img src="https://is1-ssl.mzstatic.com/image/thumb/Music124/v4/33/d1/fe/33d1fe9a-4ea4-354b-d5a9-3e05e972fc00/cover.jpg/400x400bb.jpg" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">', 
        '<img src="https://is1-ssl.mzstatic.com/image/thumb/Music122/v4/d7/54/5f/d7545f0c-6d6d-bd26-4b35-7938374cc0d8/cover.jpg/400x400bb.jpg" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">', 
        '<img src="https://is1-ssl.mzstatic.com/image/thumb/Music124/v4/7a/7d/2a/7a7d2a6f-11e6-17b2-950e-0fea5e386997/cover.jpg/400x400bb.jpg" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">', 
        '<img src="https://is1-ssl.mzstatic.com/image/thumb/Music114/v4/6a/82/71/6a82715e-1a8c-6e8c-6fc6-c981adfe74cc/cover.jpg/400x400bb.jpg" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">', 
        '<img src="https://is1-ssl.mzstatic.com/image/thumb/Music124/v4/60/c9/51/60c9515f-0031-40c8-c18b-8bcf83d42c2c/cover.jpg/400x400bb.jpg" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">', 
        '<img src="https://is1-ssl.mzstatic.com/image/thumb/Music221/v4/8e/b2/53/8eb25342-cc03-0f5c-78ce-e85400ded9cd/cover.jpg/400x400bb.jpg" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">', 
        '<img src="https://is1-ssl.mzstatic.com/image/thumb/Music115/v4/bc/3d/b4/bc3db44a-ee61-bbb5-3f57-c4a575bc2780/cover.jpg/400x400bb.jpg" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">'
    ];
    let cardsArray = [...emojis, ...emojis];
    let board = document.getElementById('game-board');
    let movesDisplay = document.getElementById('moves');
    
    let flippedCards = [];
    let matchedPairs = 0;
    let moves = 0;
    let isLocked = false;

    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function initGame() {
        board.innerHTML = '';
        cardsArray = shuffle(cardsArray);
        flippedCards = [];
        matchedPairs = 0;
        moves = 0;
        movesDisplay.innerText = moves;
        isLocked = false;

        cardsArray.forEach((emoji, index) => {
            let card = document.createElement('div');
            card.classList.add('memory-card');
            card.dataset.emoji = emoji;
            card.innerHTML = `<span style="transform: rotateY(180deg); display: flex; width: 100%; height: 100%; padding: 5px; box-sizing: border-box;">${emoji}</span>`;
            card.addEventListener('click', flipCard);
            board.appendChild(card);
        });
    }

    function flipCard() {
        if (isLocked) return;
        if (this === flippedCards[0]) return;

        this.classList.add('flipped');
        flippedCards.push(this);

        if (flippedCards.length === 2) {
            moves++;
            movesDisplay.innerText = moves;
            checkForMatch();
        }
    }

    function checkForMatch() {
        let isMatch = flippedCards[0].dataset.emoji === flippedCards[1].dataset.emoji;

        if (isMatch) {
            disableCards();
        } else {
            unflipCards();
        }
    }

    function disableCards() {
        flippedCards[0].removeEventListener('click', flipCard);
        flippedCards[1].removeEventListener('click', flipCard);
        
        flippedCards[0].classList.add('matched');
        flippedCards[1].classList.add('matched');

        matchedPairs++;
        if (matchedPairs === emojis.length) {
            setTimeout(() => {
                alert(`Gratulace! Všechny páry nalezeny za ${moves} tahů. Jsi pravý ZtracenýEnjoyer!`);
            }, 500);
        }

        flippedCards = [];
    }

    function unflipCards() {
        isLocked = true;

        setTimeout(() => {
            flippedCards[0].classList.remove('flipped');
            flippedCards[1].classList.remove('flipped');
            flippedCards = [];
            isLocked = false;
        }, 1000);
    }

    document.getElementById('restartPexeso').addEventListener('click', initGame);

    initGame();
</script>

<?php include 'footer.php'; ?>
