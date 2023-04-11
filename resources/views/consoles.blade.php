<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <title>Consoles</title>

        <link href="https://fonts.googleapis.com/css2?family=Monofett&family=Roboto+Mono:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}" />

    </head>
    <body>
        <header>GAMES</header>
        <div class="consoles-header">
            <a href="{{route('listGames')}}">&#8592 Voltar para página inicial</a>
            <p>Consoles</p>
            <form onsubmit="disableButton('submitButtonAddConsole')" class="console-add-new" action="{{route('addConsole')}}" method="POST">
                @csrf
                <input name="name" type="text" placeholder="Nome do Console" required>
                <input name="maker" type="text" placeholder="Fabricante" required>
                <button id="submitButtonAddConsole" type="submit">Cadastrar Console</button>
            </form>
        </div>
        <div class="consoles-list">
            @if (count($listConsoles) > 0)
            <span class="consoles-list-header">
                <p>Console</p>
                <p>Fabricante</p>
                <p></p>
            </span>
                @foreach($listConsoles as $item)
                    <div class="consoles-list-item">
                    <p>{{ $item->name }}</p>
                    <p>{{$item->maker}}</p>
                    <span>
                    <button onclick="openModalUpdateConsole({{$item}})" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    @isset($listGamesAttachedToConsole[$item->id])
                    <button title="Excluir" class="excluir" onclick="openModalAlertDeleteConsole({{$item->id}}, {{json_encode($listGamesAttachedToConsole)}})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    @else
                     <button title="Excluir" class="excluir" onclick="openModalDeleteConsole({{$item->id}})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    @endisset

                    </span>
                </div>
            @endforeach
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="#F2F2F2">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                </svg>
                <p>Você ainda não tem consoles cadastrados.</p>
            @endif
        </div>

        <div class="modal-overlay" id="modalDeleteConsole">
            <div class="modal">
                <div class="modal-header">
                    <p>Deletar</p>
                    <button  onclick="closeModalDeleteConsole()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-content-delete">
                    <p>Deseja excluir o console?</p>
                    <form action="{{route('deleteConsole')}}" method="POST">
                        @csrf
                        <input name="consoleId" id="deleteConsoleId" hidden>
                        <button type="button" onclick="closeModalDeleteConsole()">Cancelar</button>
                        <button class="excluir" type="submit">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-overlay" id="modalAlertDeleteConsole">
            <div class="modal">
                <div class="modal-header">
                    <p>Atenção!</p>
                    <button  onclick="closeModalAlertDeleteConsole()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-content-delete">
                    <p>Este console está ativo nos seguintes jogos: <span id="consoleActiveGameNames"></span></p>
                    <p id="modalConsoleInfo">* Para excluir este console vá em editar jogo e retire a seleção do console.</p>
                    <form>
                        <button type="button" onclick="closeModalAlertDeleteConsole()">Ok</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-overlay" id="modalUpdateConsole">
            <div class="modal">
                <div class="modal-header">
                    <p>Editar Informações</p>
                    <button  onclick="closeModalUpdateConsole()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-content">
                    <form onsubmit="disableButton('submitButtonUpdateConsole')" action="{{route('updateConsole')}}" method="POST">
                        @csrf
                        <input name="id" id="consoleId" type="number" hidden required/>
                        <label>
                            Nome
                            <input id="consoleName" name="name" type="text" required/>
                        </label>
                        <label>
                            Fabricante
                            <input id="consoleMaker" name="maker" type="text" required/>
                        </label>
                        <button id="submitButtonUpdateConsole" type="submit">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{asset('js/consoles.js')}}"></script>
    </body>
</html>
