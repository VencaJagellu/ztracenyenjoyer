<?php include 'header.php'; ?>

<div class="glass-card animate-on-scroll" style="text-align: center; max-width: 800px; margin: 0 auto;">
    <h1>Flappy Marek</h1>
    <p>Klikni nebo stiskni mezerník pro let! Vyhni se sloupům!</p>
    
    <div style="display: flex; justify-content: center; margin-top: 1rem;">
        <canvas id="flappyCanvas" width="320" height="480" style="border: 4px solid var(--primary-red); border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); background-color: #87CEEB;"></canvas>
    </div>
    
    <button id="restartBtn" class="btn" style="margin-top: 1rem; display: none;">Zkusit znovu</button>
</div>

<script>
    const cvs = document.getElementById("flappyCanvas");
    const ctx = cvs.getContext("2d");

    let frames = 0;
    const DEGREE = Math.PI / 180;

    const state = {
        current: 0,
        getReady: 0,
        game: 1,
        over: 2
    }

    const startBtn = {
        x: 120,
        y: 263,
        w: 83,
        h: 29
    }

    cvs.addEventListener("click", function(evt){
        switch(state.current){
            case state.getReady:
                state.current = state.game;
                break;
            case state.game:
                bird.flap();
                break;
            case state.over:
                let rect = cvs.getBoundingClientRect();
                let clickX = evt.clientX - rect.left;
                let clickY = evt.clientY - rect.top;
                
                // if we click, just restart
                pipes.reset();
                bird.speed = 0;
                score.value = 0;
                state.current = state.getReady;
                document.getElementById('restartBtn').style.display = 'none';
                break;
        }
    });

    document.addEventListener("keydown", function(evt){
        if(evt.code === "Space"){
            evt.preventDefault();
            if(state.current == state.getReady) {
                state.current = state.game;
            } else if(state.current == state.game) {
                bird.flap();
            }
        }
    });
    
    document.getElementById('restartBtn').addEventListener('click', () => {
        pipes.reset();
        bird.speed = 0;
        score.value = 0;
        state.current = state.getReady;
        document.getElementById('restartBtn').style.display = 'none';
    });

    // Background
    const bg = {
        draw: function() {
            ctx.fillStyle = "#87CEEB";
            ctx.fillRect(0,0,cvs.width,cvs.height);
            // Draw some clouds
            ctx.fillStyle = "#fff";
            ctx.beginPath();
            ctx.arc(50, 100, 20, 0, Math.PI*2);
            ctx.arc(80, 100, 30, 0, Math.PI*2);
            ctx.arc(110, 100, 20, 0, Math.PI*2);
            ctx.fill();
        }
    }

    // Foreground
    const fg = {
        h: 50,
        draw: function() {
            ctx.fillStyle = "#ffcccc";
            ctx.fillRect(0, cvs.height - this.h, cvs.width, this.h);
            ctx.fillStyle = "#ff4b4b";
            ctx.fillRect(0, cvs.height - this.h, cvs.width, 5);
        }
    }

    // Bird (Emoji)
    const bird = {
        animation: [0, 1, 2, 1],
        x: 50,
        y: 150,
        w: 30,
        h: 30,
        
        radius: 12,
        frame: 0,
        gravity: 0.15,
        jump: 3.5,
        speed: 0,
        rotation: 0,
        
        draw: function() {
            ctx.save();
            ctx.translate(this.x, this.y);
            ctx.rotate(this.rotation);
            
            // Draw a red circle with 'Z' inside
            ctx.beginPath();
            ctx.arc(0, 0, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = "#ff4b4b";
            ctx.fill();
            ctx.lineWidth = 2;
            ctx.strokeStyle = "#fff";
            ctx.stroke();
            
            ctx.fillStyle = "#fff";
            ctx.font = "bold 16px Nunito";
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            ctx.fillText("M", 0, 1);
            
            ctx.restore();
        },
        
        flap: function() {
            this.speed = -this.jump;
        },
        
        update: function() {
            // IF THE GAME STATE IS GET READY STATE, THE BIRD MUST FLAP SLOWLY
            this.period = state.current == state.getReady ? 10 : 5;
            this.frame += frames % this.period == 0 ? 1 : 0;
            this.frame = this.frame % this.animation.length;
            
            if(state.current == state.getReady){
                this.y = 150; // RESET POSITION
                this.rotation = 0 * DEGREE;
            } else {
                this.speed += this.gravity;
                this.y += this.speed;
                
                if(this.y + this.h/2 >= cvs.height - fg.h){
                    this.y = cvs.height - fg.h - this.h/2;
                    if(state.current == state.game){
                        state.current = state.over;
                        document.getElementById('restartBtn').style.display = 'inline-block';
                    }
                }
                
                // IF THE SPEED IS GREATER THAN THE JUMP MEANS THE BIRD IS FALLING DOWN
                if(this.speed >= this.jump){
                    this.rotation = 45 * DEGREE;
                    this.frame = 1;
                } else {
                    this.rotation = -25 * DEGREE;
                }
            }
        }
    }

    // PIPES
    const pipes = {
        position: [],
        w: 40,
        h: 400,
        gap: 150,
        dx: 1.2,
        
        draw: function() {
            for(let i = 0; i < this.position.length; i++){
                let p = this.position[i];
                let topY = p.y;
                let bottomY = p.y + this.h + this.gap;
                
                // Top Pipe
                ctx.fillStyle = "#ff4b4b";
                ctx.fillRect(p.x, topY, this.w, this.h);
                ctx.strokeStyle = "#c62828";
                ctx.lineWidth = 3;
                ctx.strokeRect(p.x, topY, this.w, this.h);
                
                // Bottom Pipe
                ctx.fillRect(p.x, bottomY, this.w, this.h);
                ctx.strokeRect(p.x, bottomY, this.w, this.h);
            }
        },
        
        update: function() {
            if(state.current !== state.game) return;
            
            if(frames % 100 == 0){
                this.position.push({
                    x: cvs.width,
                    y: this.h * (Math.random() + 1) * -0.5 // -200 to -400
                });
            }
            
            for(let i = 0; i < this.position.length; i++){
                let p = this.position[i];
                let bottomPipeYPos = p.y + this.h + this.gap;
                
                // COLLISION DETECTION
                if(bird.x + bird.radius > p.x && bird.x - bird.radius < p.x + this.w && bird.y + bird.radius > p.y && bird.y - bird.radius < p.y + this.h){
                    state.current = state.over;
                    document.getElementById('restartBtn').style.display = 'inline-block';
                }
                if(bird.x + bird.radius > p.x && bird.x - bird.radius < p.x + this.w && bird.y + bird.radius > bottomPipeYPos && bird.y - bird.radius < bottomPipeYPos + this.h){
                    state.current = state.over;
                    document.getElementById('restartBtn').style.display = 'inline-block';
                }
                
                p.x -= this.dx;
                
                if(p.x + this.w <= 0){
                    this.position.shift();
                    score.value += 1;
                    score.best = Math.max(score.value, score.best);
                    localStorage.setItem("bestscore", score.best);
                }
            }
        },
        
        reset: function(){
            this.position = [];
        }
    }

    // SCORE
    const score = {
        best: parseInt(localStorage.getItem("bestscore")) || 0,
        value: 0,
        
        draw: function(){
            ctx.fillStyle = "#FFF";
            ctx.strokeStyle = "#000";
            
            if(state.current == state.game){
                ctx.lineWidth = 2;
                ctx.font = "35px Nunito";
                ctx.fillText(this.value, cvs.width/2, 50);
                ctx.strokeText(this.value, cvs.width/2, 50);
            } else if(state.current == state.over){
                // Score value
                ctx.font = "25px Nunito";
                ctx.fillText("Skóre: " + this.value, cvs.width/2, cvs.height/2 - 20);
                ctx.strokeText("Skóre: " + this.value, cvs.width/2, cvs.height/2 - 20);
                // Best score
                ctx.fillText("Nejlepší: " + this.best, cvs.width/2, cvs.height/2 + 20);
                ctx.strokeText("Nejlepší: " + this.best, cvs.width/2, cvs.height/2 + 20);
            }
        }
    }

    function draw(){
        bg.draw();
        pipes.draw();
        fg.draw();
        bird.draw();
        score.draw();
        
        if(state.current == state.getReady){
            ctx.fillStyle = "#fff";
            ctx.font = "20px Nunito";
            ctx.textAlign = "center";
            ctx.fillText("Klikni pro start", cvs.width/2, cvs.height/2);
        } else if (state.current == state.over) {
            ctx.fillStyle = "rgba(255, 75, 75, 0.5)";
            ctx.fillRect(0,0,cvs.width,cvs.height);
            ctx.fillStyle = "#fff";
            ctx.font = "30px Nunito";
            ctx.textAlign = "center";
            ctx.fillText("Konec hry!", cvs.width/2, cvs.height/2 - 60);
        }
    }

    function update(){
        bird.update();
        pipes.update();
    }

    function loop(){
        update();
        draw();
        frames++;
        requestAnimationFrame(loop);
    }
    loop();
</script>

<?php include 'footer.php'; ?>
