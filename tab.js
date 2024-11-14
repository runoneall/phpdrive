document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.tab-link');
    const contents = document.querySelectorAll('.tab-content');
    const first_link = links[0];
    const first_content = contents[0];
    first_link.classList.add('active');
    first_content.classList.add('active');
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