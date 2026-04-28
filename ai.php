<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="max-width: 600px; margin: 0 auto; height: 80vh; display: flex; flex-direction: column; padding: 1.5rem;">
    <div style="text-align: center; margin-bottom: 1rem; border-bottom: 1px solid var(--glass-border); padding-bottom: 1rem;">
        <h1 style="font-size: 1.8rem; margin: 0;">Marek AI</h1>
        <p style="font-size: 0.9rem; color: var(--text-muted); margin: 0.2rem 0 0;">Chatuj s virtuálním Markem v reálném čase</p>
    </div>

    <div id="chat-messages" style="flex: 1; overflow-y: auto; padding: 1rem; display: flex; flex-direction: column; gap: 1rem; scroll-behavior: smooth;">
        <div class="message-marek" style="align-self: flex-start; background: var(--white); padding: 0.8rem 1.2rem; border-radius: 15px 15px 15px 0; max-width: 80%; box-shadow: 0 4px 10px rgba(0,0,0,0.05); color: var(--text-main);">
            Ahoj! Tady virtuální Marek. Jsem rád, že jsi mi napsal. O čem si dneska budeme povídat? O hudbě, o životě nebo o mém koncertu v Edenu?
        </div>
    </div>

    <div id="typing-indicator" style="display: none; font-size: 0.8rem; color: var(--text-muted); margin-left: 0.5rem; margin-bottom: 0.5rem;">
        Marek AI píše...
    </div>

    <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
        <input type="text" id="user-input" placeholder="Napiš Markovi něco..." style="flex: 1; padding: 12px 20px; border-radius: 30px; border: 2px solid var(--primary-red); outline: none; background: var(--white); font-family: inherit;">
        <button id="send-btn" class="btn" style="padding: 12px 20px; border-radius: 50%; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</div>

<div style="text-align: center; margin-top: 1.5rem;">
    <a href="index.php" class="btn btn-outline">Zpět domů</a>
</div>

<style>
    #chat-messages::-webkit-scrollbar {
        width: 6px;
    }
    #chat-messages::-webkit-scrollbar-thumb {
        background: var(--primary-red);
        border-radius: 10px;
    }
    .message-user {
        align-self: flex-end;
        background: var(--primary-red);
        color: white;
        padding: 0.8rem 1.2rem;
        border-radius: 15px 15px 0 15px;
        max-width: 80%;
        box-shadow: 0 4px 10px rgba(255, 51, 102, 0.2);
    }
    .message-marek {
        animation: messagePop 0.3s ease-out;
    }
    @keyframes messagePop {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>

<script>
    const chatMessages = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-input');
    const sendBtn = document.getElementById('send-btn');
    const typingIndicator = document.getElementById('typing-indicator');

    function addMessage(text, isUser) {
        const messageDiv = document.createElement('div');
        messageDiv.className = isUser ? 'message-user' : 'message-marek';
        if (!isUser) {
            messageDiv.style.alignSelf = 'flex-start';
            messageDiv.style.background = 'var(--white)';
            messageDiv.style.padding = '0.8rem 1.2rem';
            messageDiv.style.borderRadius = '15px 15px 15px 0';
            messageDiv.style.maxWidth = '80%';
            messageDiv.style.boxShadow = '0 4px 10px rgba(0,0,0,0.05)';
            messageDiv.style.color = 'var(--text-main)';
        }
        messageDiv.innerText = text;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Local fallback data
    const marekResponses = [
        { keywords: ['ahoj', 'čau', 'zdravím', 'nazdar', 'ahojky'], response: 'Ahoj! Jsem moc rád, že jsi tady. Naše cesty se konečně střetly! Jak se dneska máš?' },
        { keywords: ['píseň', 'pisnicka', 'zpívej', 'text', 'skladba'], response: '„Ztrácíš, když se ti něco nedaří...“ Tahle věta pro mě hodně znamená. Která moje písnička tě nejvíc baví?' },
        { keywords: ['koncert', 'eden', 'tour', 'lístky'], response: 'Eden bude naprostá pecka! Připravujeme show, kterou Česko ještě nevidělo. Doufám, že tě uvidím v první řadě!' },
        { keywords: ['láska', 'miluju', 'vztah'], response: 'Moje milá, to je přesně to, o čem moje hudba je. Bez lásky by nebyly žádné písničky, jen ticho.' },
        { keywords: ['jak se máš', 'jak je', 'u tebe'], response: 'Mám se skvěle, tvořím novou hudbu a užívám si každou chvíli. A co ty, jaký máš den?' },
        { keywords: ['jméno', 'jmenuješ', 'kdo jsi'], response: 'Já jsem Marek Ztracený, ale pro kamarády prostě Marek. Jsem rád, že si píšeme!' },
        { keywords: ['děkuju', 'diky'], response: 'Já děkuju tobě! Bez vás, fanoušků, by to nemělo smysl. Jsi nejlepší!' }
    ];
    const fallbackResponses = [
        'To je zajímavý! Ale víš co? Hlavní je, že jsme v tom spolu a hudba hraje dál.',
        'Možná o tom napíšu písničku! Co myslíš, byl by to hit?',
        'Když tváří v tvář tu stojíme, slova někdy nestačí. Ale i tak tě rád poslouchám.',
        'Víš, život je jako koncert – někdy je to pořádnej nářez a jindy je potřeba zvolnit.'
    ];

    function getLocalResponse(text) {
        const lowerText = text.toLowerCase();
        const match = marekResponses.find(r => r.keywords.some(k => lowerText.includes(k)));
        return match ? match.response : fallbackResponses[Math.floor(Math.random() * fallbackResponses.length)];
    }

    async function handleSend() {
        const text = userInput.value.trim();
        if (!text) return;

        addMessage(text, true);
        userInput.value = '';
        
        typingIndicator.style.display = 'block';
        chatMessages.scrollTop = chatMessages.scrollHeight;

        try {
            const response = await fetch('proxy.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: text })
            });
            
            let data;
            try {
                data = await response.json();
            } catch (e) {
                data = { error: 'Invalid JSON' };
            }

            typingIndicator.style.display = 'none';
            
            if (data && data.response) {
                addMessage(data.response, false);
            } else {
                console.warn('API error or empty response, falling back to local logic:', data ? data.error : 'No data');
                addMessage(getLocalResponse(text), false);
            }
        } catch (error) {
            typingIndicator.style.display = 'none';
            console.error('Fetch error, using local fallback:', error);
            addMessage(getLocalResponse(text), false);
        }
    }

    sendBtn.addEventListener('click', handleSend);
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleSend();
    });
</script>

<?php include 'footer.php'; ?>
