function openModalConsoles() {
    var modal = document.getElementById('modal-consoles');

    modal.style.display = 'flex';
}

function closeModalConsoles() {
    var modal = document.getElementById('modal-consoles');

    modal.style.display = 'none';
}

function openModalDeleteConsole(id) {
    var modal = document.getElementById('modalDeleteConsole');
    var inputId = document.getElementById('deleteConsoleId');

    inputId.value = id;

    modal.style.display = 'flex';
}

function openModalAlertDeleteConsole(id, listConsolesGames) {
    var listGameNames = listConsolesGames[id];

    var modal = document.getElementById('modalAlertDeleteConsole');
    var gamesNames = document.getElementById('consoleActiveGameNames');
    gamesNames.innerHTML = "";

    listGameNames.forEach(element => {
        var game_name = element.name;

        const newElement = document.createElement("p");
        const elementContent = document.createTextNode(game_name);
        newElement.appendChild(elementContent)
        gamesNames.appendChild(newElement);
    });

    modal.style.display = 'flex';
}

function closeModalAlertDeleteConsole() {
    var modal = document.getElementById('modalAlertDeleteConsole');

    modal.style.display = 'none';
}

function closeModalDeleteConsole() {
    var modal = document.getElementById('modalDeleteConsole');

    modal.style.display = 'none';
}

function openModalUpdateConsole(infoConsole, consoles) {
    var modal = document.getElementById('modalUpdateConsole');

    var id = document.getElementById('consoleId');
    id.value =  infoConsole['id'];
    var name = document.getElementById('consoleName');
    name.value =  infoConsole['name'];
    var maker = document.getElementById('consoleMaker');
    maker.value =  infoConsole['maker'];

    modal.style.display = 'flex';
}

function closeModalUpdateConsole() {
    var modal = document.getElementById('modalUpdateConsole');

    modal.style.display = 'none';
}

function disableButton(id) {
    var formButton = document.querySelector('#'+id);
    formButton.disabled = true;
}
