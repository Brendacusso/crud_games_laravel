<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Console;
use App\Models\GameConsole;

class GameController extends Controller
{

    public function listGames() {
        $resultado = Game::orderby('id', 'ASC')->get();
        $game_consoles = [];

        foreach($resultado as $item) {
            $game_id = $item->id;

            //$consoles = GameConsole::where('game', $game_id)->get('console');
            $query = \DB::select('select consoles.id, consoles.name from consoles left join game_consoles on consoles.id=game_consoles.console
            where game_consoles.game = :game_id', ['game_id' => $game_id]);

            $game_consoles[$game_id] = $query;
        }

        $listConsoles = Console::orderby('id', 'ASC')->get();

        return view('welcome', ['resultado' => $resultado, 'listConsoles' => $listConsoles, 'game_consoles' => $game_consoles]);
    }

    public function addGame(Request $request) {

        $game = new Game();

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'maker' => 'required',
            'release-year' => 'required',
        ],
        [
            'name.required'=>'Nome do jogo não informado.',
            'description.required'=>'Descrição do jogo não informada.',
            'image.required'=>'Upload de imagem não realizado.',
            'maker.required'=>'Fabricante do jogo não foi informado.',
            'release-year.required' => 'Ano de lançamento não informado.'
        ]);


        if(($request->input('income')) > 0) {
            $income = $request->input('income');
        } else {
            $income = 0;
        }

        $base64 = base64_encode(file_get_contents($request->file('image')));

        $game->name = $request->input('name');
        $game->description = $request->input('description');
        $game->image = "data:image/png;base64,".$base64;
        $game->maker = $request->input('maker');
        $game->release_year = $request->input('release-year');
        $game->income = $income;

        $game->save();

        $game_id = $game->id;

        foreach($request->input('console') as $item) {
            $game_console = new GameConsole();

            $game_console->game = $game_id;
            $game_console->console = $item;

            $game_console->save();
        }

        return redirect()->route('listGames');
    }

    public function updateGame(Request $request) {

        $game = Game::find($request->input('updateGameId'));
        $deletar_consoles = GameConsole::where('game', $request-> input('updateGameId'))->delete();

        if($request->input('updateGameConditionalImg') == "YES") {
             $base64 = base64_encode(file_get_contents($request->file('updateImage')));
            $game->image = "data:image/png;base64,".$base64;
        } else {
            $game->image = $request->input('oldImg');
        }

        if(($request->input('updateIncome')) > 0) {
            $income = $request->input('updateIncome');
        } else {
            $income = 0;
        }

        $game->name = $request->input('updateName');
        $game->description = $request->input('updateDescription');
        $game->maker = $request->input('updateMaker');
        $game->release_year = $request->input('updateReleaseYear');
        $game->income = $income;

        $input = $request->all();

        $game->update($input);

        foreach($request->input('consoleUpdate') as $item) {
            $game_console = new GameConsole();

            $game_console->game = $request->input('updateGameId');
            $game_console->console = $item;

            $game_console->save();
        }

        return redirect()->route('listGames');
    }

    public function deleteGame(Request $request) {

        $deletar_consoles = GameConsole::where('game', $request-> input('gameId'))->delete();
        $delete = Game::destroy($request-> input('gameId'));

        return redirect()->route('listGames');
    }

}
