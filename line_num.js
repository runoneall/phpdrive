function updateLineNumbers() {
    const textarea = document.getElementById('editor');
    const lineNumbersContainer = document.querySelector('.line-numbers');
    const lines = textarea.value.split('\n').length;
    textarea.rows = lines;
    lineNumbersContainer.innerHTML = '';
    for (let i = 1; i <= lines; i++) {
        const span = document.createElement('span');
        span.textContent = i;
        lineNumbersContainer.appendChild(span);
    }
}
updateLineNumbers();
document.getElementById('editor').addEventListener('input', updateLineNumbers);