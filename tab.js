document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.tab-link');
    const contents = document.querySelectorAll('.tab-content');
    function showTab(event) {
        event.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        links.forEach(link => link.classList.remove('active'));
        contents.forEach(content => content.classList.remove('active'));
        this.classList.add('active');
        document.getElementById(targetId).classList.add('active');
    }
    links.forEach(link => link.addEventListener('click', showTab));
});