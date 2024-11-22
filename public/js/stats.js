function stats(name){
    document.querySelector(`#stats-${name}-plus`).addEventListener('click', function () {
        const stats = document.getElementById(`stats-${name}`);
        stats.classList.toggle('hidden');
        stats.classList.toggle('show');
        if (stats.classList.contains('hidden')) {
            document.querySelector(`#stats-${name}-plus`).innerHTML = '+';
        } else {
            document.querySelector(`#stats-${name}-plus`).innerHTML = '-';
        }
    });
}

stats('cles');
stats('attaque');
stats('distribution');
stats('defense');
stats('discipline');

if(document.querySelector('#stats-gardien-plus')){
    stats("gardien");
}
