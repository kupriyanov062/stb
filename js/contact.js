function switchLanguage() {
    const selectElement = document.getElementById('language-select');
    const selectedLanguage = selectElement.value;

    // Добавьте код для перехода по ссылке с выбранным языком
    if (selectedLanguage === 'en') {
        window.location.href = 'contact.html'; // Замените на вашу ссылку для английского языка
    } else if (selectedLanguage === 'ua') {
        window.location.href = 'contact-ua.html'; // Замените на вашу ссылку для русского языка
    }
}