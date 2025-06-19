const quizDiv = document.getElementById('quiz');
const questions = JSON.parse(quizDiv.dataset.questions);
const niveau = quizDiv.dataset.niveau; // ✅ On récupère le niveau ici
let current = 0;

function showQuestion(index) {
    if (index >= questions.length) {
        quizDiv.innerHTML = `<h2 class="message">🎉 Quiz terminé !</h2>`;
        return;
    }

    const q = questions[index]; // ✅ On récupère la question actuelle
    quizDiv.innerHTML = `
        <p>${q.question}</p>
        ${['A', 'B', 'C', 'D'].map(opt => `
            <div>
                <input type="checkbox" id="opt-${opt}" name="answer" value="${opt}">
                <label for="opt-${opt}">${opt}. ${q['option_' + opt.toLowerCase()]}</label>
            </div>
        `).join('')}
        <button class="btn" id="submit">Valider</button>
        <div id="feedback" class="message"></div>
    `;

    document.getElementById('submit').addEventListener('click', () => {
        const selected = document.querySelector('input[name="answer"]:checked');
        if (!selected) return alert("Choisis une réponse !");

        fetch('check.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: q.id,                    // ✅ ID de la question
                answer: selected.value,     // ✅ Réponse choisie
                niveau: niveau              // ✅ Niveau récupéré au début
            })
        })
        .then(res => res.json())
        .then(res => {
            const feedback = document.getElementById('feedback');
            if (res.is_correct) {
                feedback.textContent = "✅ Bonne réponse !";
                feedback.style.color = "lime";
            } else {
                feedback.textContent = `❌ Mauvaise réponse. La bonne réponse était ${res.correct}`;
                feedback.style.color = "red";
            }

            setTimeout(() => {
                current++;
                showQuestion(current);
            }, 1500);
        });
    });
}

showQuestion(current);
