<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <title>Desafio Técnico Brenda</title>

        <link href="https://fonts.googleapis.com/css2?family=Monofett&family=Roboto+Mono:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}" />

    </head>
    <body>
        <header>GAMES</header>
        <div class="buttons">
            <button data-bs-toggle="modal" onclick="openModalNewGame()">Novo Jogo
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="white">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <form action="{{route('listConsoles')}}" method="GET">
                <button class="button-console" type="submit">Consoles
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="white">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </form>
        </div>
        <div class="games-list">
             @if (count($resultado) > 0)
                @foreach($resultado as $item)
                    <div class="games-list-item">
                        <img src="{{$item->image}}" />
                        <p>{{ $item->name }}</p>
                        <span>
                         <button title="Visualizar" onclick="openModalSeeGame({{$item}}, {{json_encode($game_consoles)}})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                         </button>
                         <button onclick="openModalUpdateGame({{$item}}, {{json_encode($game_consoles)}})" title="Editar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                            </svg>
                         </button>
                         <button title="Excluir" class="excluir" onclick="openModalDeleteGame({{$item->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                         </button>
                        </span>
                    </div>
                @endforeach
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="#F2F2F2">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                </svg>
                <p>Você ainda não tem jogos cadastrados.</p>
            @endif
        </div>

        <div class="modal-overlay" id="modalDeleteGame">
            <div class="modal">
                <div class="modal-header">
                    <p>Deletar</p>
                    <button  onclick="closeModalDeleteGame()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-content-delete">
                    <p>Deseja Excluir o jogo?</p>
                    <form action="{{route('deleteGame')}}" method="POST">
                        @csrf
                        <input name="gameId" id="deleteGameId" hidden>
                        <button type="button" onclick="closeModalDeleteGame()">Cancelar</button>
                        <button class="excluir" type="submit">Excluir</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modal-new-game">
            <div class="modal">
                <div class="modal-header">
                    <p>Novo Jogo</p>
                    <button onclick="closeModalNewGame()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-content">
                    <form onsubmit="disableButton('submitFormAddGame')" id="addGameForm" action="{{route('addNewGame')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(count($listConsoles) > 0)
                        <input name="name" type="text" placeholder="Nome *" required >
                        <input name="description" type="text" placeholder="Descrição *" required>
                        <label for="inputImage"> Fazer Upload da Imagem: * </label>
                        <input id="inputImage" name="image" type="file" required>
                        <input name="maker" type="text" placeholder="Fabricante *" required>
                        <label>Selecione os consoles: * </label>
                        <div class="select-consoles">
                            @foreach($listConsoles as $console)
                                <label>
                                    <input type="checkbox" name="console[]" value="{{$console->id}}" />
                                    {{$console->name}}
                                </label>
                            @endforeach

                        </div>
                        <p class="alertForm alertFormAdd">Selecione pelo menos um console!</p>
                        <input name="release-year" type="number" placeholder="Ano de lançamento *" min="1950" max="{{now()->year}}" required>
                        <input id="currency" name="income" type="number" placeholder="Faturamento" min="0" max="1000000">
                        <button id="submitFormAddGame" type="submit" disabled>Cadastrar</button>
                        <p class="warning">* Campos Obrigatórios</p>
                            @else
                                <span>Não há consoles disponíveis! <a href="{{route('listConsoles')}}">Cadastre agora</a></span>
                            @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modalSeeGame">
            <div class="modal">
                <div class="modal-header">
                    <span></span>
                    <button  onclick="closeModalSeeGame()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-content-see-game">
                    <header>
                        <img src="" alt="" id="viewGameImg">
                        <span>
                            <p id="viewGameName" title="Nome do Jogo"></p>
                            <p id="viewGameDescription" title="Descrição do Jogo"></p>
                        </span>
                    </header>

                    <div class="viewGameinfo">
                        <label>
                            Fabricante
                            <p id="viewGameMaker"></p>
                        </label>
                        <label>
                            Ano de lançamento
                            <p id="viewGameYearRelease"></p>
                        </label>
                        <label>
                            Faturamento
                            <p id="viewGameIncome" class="incomeInput currency"></p>
                        </label>
                    </div>
                    <label>Consoles: </label>
                        <div id="modal-form-view-consoles"></div>
                </div>
            </div>
        </div>
        <div class="modal-overlay" id="modalUpdateGame">
            <div class="modal">
                <div class="modal-header">
                    <p>Editar Informações</p>
                    <button  onclick="closeModalUpdateGame()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-content">
                    <form onsubmit="disableButton('submitFormUpdateGame')" id="updateGameForm" action="{{route('updateGame')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input id="updateGameHiddenId" name="updateGameId" type="hidden">
                        <input id="updateGameHiddenContionalImg" name="updateGameConditionalImg" type="hidden">
                        <input id="oldImg" name="oldImg" type="hidden">
                        <div class="modal-content-header-form">
                            <span>
                                <img id="gameImg" src="" alt="">
                                <label for="gameUpdateImg"> Alterar Imagem: </label>
                                <input id="gameUpdateImg" name="updateImage" type="file" onchange="setValueToCondicional()" />
                            </span>
                            <div>
                                <label>
                                    Nome
                                    <input id="gameName" name="updateName" type="text" title="Nome do Jogo" required/>
                                </label>
                                <label>
                                    Descrição
                                    <input id="gameDescription" name="updateDescription" type="text" title="Descrição do Jogo" required/>
                                </label>
                            </div>
                        </div>
                        <div class="modal-content-update-form">
                            <label>
                                Fabricante
                                <input id="gameMaker" name="updateMaker" type="text" required/>
                            </label>
                            <label>
                                Ano de lançamento
                                <input id="gameYearRelease" name="updateReleaseYear" type="number" min="1950" max="{{now()->year}}" required/>
                            </label>
                            <label>
                                Faturamento
                                <input id="gameIncome" name="updateIncome" class="incomeInput currency" type="number" min="0" max="10000000"/>
                            </label>
                        </div>
                        <label>Consoles:</label>
                        <div id="modal-form-update-consoles" class="select-consoles">
                            @if(count($listConsoles) > 0)
                                @foreach($listConsoles as $console)
                                    <label>
                                        <input class="consolesUpdateInput" id="consoleUpdate{{$console->id}}" type="checkbox" name="consoleUpdate[]" value="{{$console->id}}" />
                                        {{$console->name}}
                                    </label>
                                @endforeach
                            @endif
                        </div>
                        <p class="alertForm alertFormUpdate">Selecione pelo menos um console!</p>
                        <button id="submitFormUpdateGame" type="submit" disabled>Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="{{asset('js/app.js')}}"></script>
</html>
