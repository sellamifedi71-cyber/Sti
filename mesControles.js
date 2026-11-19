'use strict';

function verif1() {
    const id = document.getElementById('i').value.trim().toUpperCase();
    const name = document.getElementById('np').value.trim();
    if (!/^U[0-9]{3}$/.test(id)) {
        alert('Identifiant incorrect : utilisez U suivi de 3 chiffres.');
        return false;
    }
    if (name.length < 2 || name.length > 50) {
        alert('Le nom et prénom doivent contenir entre 2 et 50 caractères.');
        return false;
    }
    document.getElementById('i').value = id;
    return true;
}

function syncRights() {
    const write = document.getElementById('ecriture');
    const read = document.getElementById('lecture');
    const print = document.getElementById('impression');
    if (write.checked || print.checked) read.checked = true;
    if (!read.checked) {
        write.checked = false;
        print.checked = false;
    }
}

function verif2() {
    const doc = document.getElementById('n').value;
    const id = document.getElementById('i').value.trim().toUpperCase();
    const anyRight = ['ecriture', 'lecture', 'impression'].some((name) => document.getElementById(name).checked);
    if (!/^U[0-9]{3}$/.test(id)) {
        alert('Identifiant utilisateur incorrect : utilisez U suivi de 3 chiffres.');
        return false;
    }
    if (!/^D[0-9]{4}$/.test(doc)) {
        alert('Veuillez sélectionner un document.');
        return false;
    }
    if (!anyRight) {
        alert('Veuillez sélectionner au moins un droit.');
        return false;
    }
    syncRights();
    document.getElementById('i').value = id;
    return true;
}
