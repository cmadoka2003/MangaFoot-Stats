document.querySelector('[data-collapse-toggle="navbar-dropdown"]').addEventListener('click', function () {
    const menu = document.getElementById('navbar-dropdown');
    menu.classList.toggle('hidden');
    menu.classList.toggle('show');
});
