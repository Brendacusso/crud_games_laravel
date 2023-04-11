function openModalNewGame() {
    var modal = document.getElementById('modal-new-game');

    modal.style.display = 'flex';
}

function closeModalNewGame() {
    var modal = document.getElementById('modal-new-game');

    modal.style.display = 'none';
}

function openModalDeleteGame(id) {
    var modal = document.getElementById('modalDeleteGame');
    var inputId = document.getElementById('deleteGameId');

    inputId.value = id;

    modal.style.display = 'flex';
}

function closeModalDeleteGame() {
    var modal = document.getElementById('modalDeleteGame');

    modal.style.display = 'none';
}

function openModalSeeGame(infoGame, consoles) {

    var listConsoles = consoles[infoGame['id']];

    var modal = document.getElementById('modalSeeGame');

    var img = document.getElementById('viewGameImg');
    img.src =  infoGame['image'];
    var name = document.getElementById('viewGameName');
    name.innerHTML =  infoGame['name'];
    var description = document.getElementById('viewGameDescription');
    description.innerHTML =  infoGame['description'];
    var maker = document.getElementById('viewGameMaker');
    maker.innerHTML =  infoGame['maker'];
    var yearRelease = document.getElementById('viewGameYearRelease');
    yearRelease.innerHTML =  infoGame['release_year'];
    var income = document.getElementById('viewGameIncome');
    income.innerHTML =  infoGame['income'].toLocaleString('pt-BR', {style: 'currency', currency: 'BRL', minimumFractionDigits: 2});

    var consolesDiv = document.getElementById('modal-form-view-consoles');
    consolesDiv.innerHTML = "";

    listConsoles.forEach(element => {
        var console_name = element.name;
        const newElement = document.createElement("p");
        const elementContent = document.createTextNode(console_name);
        newElement.appendChild(elementContent)
        consolesDiv.appendChild(newElement);
    });

    modal.style.display = 'flex';

}

function closeModalSeeGame() {
    var modal = document.getElementById('modalSeeGame');

    modal.style.display = 'none';
}

function openModalUpdateGame(infoGame, consoles) {

    var inputsCheck = document.getElementsByClassName('consolesUpdateInput');

    for(var i = 0; i < inputsCheck.length; i++) {
        inputsCheck[i].checked = false;
    }

    var modal = document.getElementById('modalUpdateGame');
    var modalSee = document.getElementById('modalSeeGame');
    var listConsoles = consoles[infoGame['id']];

    var oldImg = document.getElementById('oldImg');
    oldImg.value = infoGame['image'];
    var conditionalImg = document.getElementById('updateGameHiddenContionalImg');
    conditionalImg.value = "NO";
    var id = document.getElementById('updateGameHiddenId');
    id.value = infoGame['id'];
    var img = document.getElementById('gameImg');
    img.src = infoGame['image'];
    var name = document.getElementById('gameName');
    name.value = infoGame['name'];
    var description = document.getElementById('gameDescription');
    description.value = infoGame['description'];
    var maker = document.getElementById('gameMaker');
    maker.value = infoGame['maker'];
    var yearRelease = document.getElementById('gameYearRelease');
    yearRelease.value = infoGame['release_year'];
    var income = document.getElementById('gameIncome');
    income.value = infoGame['income'];

    var alertFormUpdate = document.querySelector('.alertFormUpdate');
    alertFormUpdate.style.display = 'none';

    listConsoles.forEach(element => {
        document.getElementById('consoleUpdate'+(element.id)).checked = true;
    });

    var getInputIncome = document.getElementById('gameIncome');
    getInputIncome.toLocaleString('pt-br', {minimumFractionDigits: 2});

    modalSee.style.display = 'none';
    modal.style.display = 'flex';
}

function closeModalUpdateGame() {
    var modal = document.getElementById('modalUpdateGame');

    modal.style.display = 'none';
}

const updateGameImg = document.getElementById('gameImg');
const updateGameNewImg = document.querySelector('#gameUpdateImg');
const updateGameConditionalImg = document.querySelector('#updateGameHiddenContionalImg');

function setValueToCondicional() {
    updateGameConditionalImg.value = "YES";
}

updateGameNewImg.addEventListener('change', function(e) {

    var r = new FileReader();
    r.onload = function() {
        updateGameImg.src = r.result;
    }

    r.readAsDataURL(e.target.files[0]);
});

const submitFormAddGame = document.querySelector('#submitFormAddGame');
const formAddGame = document.querySelector('#addGameForm');
const checkboxes = formAddGame.querySelectorAll('input[type=checkbox]');
const alertFormAdd = document.querySelector('.alertFormAdd');

formAddGame.addEventListener('change', function() {
    var checked = false;
    for(var i = 0; i < checkboxes.length; i++) {
        if(checkboxes[i].checked) {
            checked = true;
        }
    }

    if(!checked) {
        submitFormAddGame.disabled = true;
        alertFormAdd.style.display = 'flex';
    } else {
        submitFormAddGame.disabled = false;
        alertFormAdd.style.display = 'none';
    }
});

const submitFormUpdateGame = document.querySelector('#submitFormUpdateGame');
const formUpdateGame = document.querySelector('#updateGameForm');
const checkboxesUpdate = formUpdateGame.querySelectorAll('input[type=checkbox]');
const alertFormUpdate = document.querySelector('.alertFormUpdate');

formUpdateGame.addEventListener('change', function() {
    var checkedUpdate = false;
    for(var i = 0; i < checkboxesUpdate.length; i++) {
        if(checkboxesUpdate[i].checked) {
            checkedUpdate = true;
        }
    }

    if(!checkedUpdate) {
        submitFormUpdateGame.disabled = true;
        alertFormUpdate.style.display = 'flex';

    } else {
        submitFormUpdateGame.disabled = false;
        alertFormUpdate.style.display = 'none';
    }
});

function disableButton(id) {
    var formButton = document.querySelector('#'+id);
    formButton.disabled = true;
}
