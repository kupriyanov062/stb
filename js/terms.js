function switchLanguage() {
    const selectElement = document.getElementById('language-select');
    const selectedLanguage = selectElement.value;

    if (selectedLanguage === 'en') {
        window.location.href = 'terms-and-conditions.html';
    } else if (selectedLanguage === 'ua') {
        window.location.href = 'terms-ua.html';
    }
}