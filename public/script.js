const quizDiv = document.getElementById('quiz');
const questions = JSON.parse(quizDiv.dataset.questions);
let current = 0;

function showQuestion(index) {
    if (index >= questions.length) {
        quizDiv.innerHTML = `<h2> Quiz terminé !</h2>`;
        return;
    }

    const q = questions[index];
    quizDiv.innerHTML = `
        <div class="question">
            <p><strong>${q.question}</strong></p>
            ${['A','B','C','D'].map(opt => `
                <label>
                    <input type="radio" name="answer" value="${opt}">
                    ${opt}. ${q['option_' + opt.toLowerCase()]}
                </label><br>
            `).join('')}
            <button id="submit">Valider</button>
            <div id="feedback" class="feedback"></div>
        </div>
    `;

    document.getElementById('submit').addEventListener('click', () => {
        const selected = document.querySelector('input[name="answer"]:checked');
        if (!selected) return alert("Choisis une réponse !");

        fetch('check.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: q.id, answer: selected.value })
        })
        .then(res => res.json())
        .then(res => {
            const feedback = document.getElementById('feedback');
            if (res.is_correct) {
                feedback.textContent = " Bonne réponse !";
                feedback.style.color = "green";
            } else {
                feedback.textContent = `Mauvaise réponse. La bonne réponse était ${res.correct}`;
                feedback.style.color = "red";
            }

            setTimeout(() => showQuestion(current + 1), 1500);
            current++;
        });
    });
}

showQuestion(current);
