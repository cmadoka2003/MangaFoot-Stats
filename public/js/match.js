document.querySelector("#match").addEventListener('click', function () {
    const stats = document.getElementById("match-plus");
    stats.classList.toggle('hidden');
    stats.classList.toggle('show');
    if (stats.classList.contains('hidden')) {
        document.querySelector("#match").innerHTML = 'En voir plus +';
    } else {
        document.querySelector("#match").innerHTML = 'Réduire -';
    }
});