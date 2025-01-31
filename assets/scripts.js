document.addEventListener('DOMContentLoaded', function() {
    const clearButton = document.getElementById('clear');
    const form = document.getElementById('converterForm');
    const resultInput = document.getElementById('result');
    const numberInput = document.getElementById('number');

    clearButton.addEventListener('click', function(e) {
        e.preventDefault();

        numberInput.value = '';
        resultInput.value = '';

        document.getElementById('words').checked = true;

        document.getElementById('letter-case').value = 'lower-case';
    });
});