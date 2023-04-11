<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;
use App\Models\GameConsole;

class ConsolesController extends Controller
{

    public function listConsoles() {

        $listConsoles = Console::orderby('id', 'ASC')->get();
        $game_consoles = [];

        foreach($listConsoles as $item) {
            $console_id = $item->id;

            $consoles = GameConsole::where('console', $console_id)->get('id');
            $listGamesAttachedToConsole = \DB::select('select games.name from games left join game_consoles on games.id=game_consoles.game
            where game_consoles.console = :console_id', ['console_id' => $console_id]);

            if(!empty($listGamesAttachedToConsole)) {
                $game_consoles[$console_id] = $listGamesAttachedToConsole;
            }

        }

        return view('consoles', ['listConsoles' => $listConsoles, 'listGamesAttachedToConsole' => $game_consoles]);
    }

    public function addConsole(Request $request) {

        $console = new Console();

        $validated = $request->validate([
            'name' => 'required',
            'maker' => 'required',
        ],
        [
            'name.required'=>'Nome do console não informado.',
            'maker.required'=>'Fabricante do console não informada.',
        ]);

        $console->name = $request->input('name');
        $console->maker = $request->input('maker');

        $console->save();

        return redirect()->route('listConsoles');
    }

    public function updateConsole(Request $request) {

        $console = Console::find($request->id);

        $validated = $request->validate([
            'name' => 'required',
            'maker' => 'required',
        ],
        [
            'name.required'=>'Nome do console não informado.',
            'maker.required'=>'Fabricante do console não informada.',
        ]);

        $console->name=$request->input('name');
        $console->maker=$request->input('maker');

        $input = $request->all();

        $console->update($input);

        return redirect()->route('listConsoles');

    }

    public function deleteConsole(Request $request) {

        $delete = Console::destroy($request-> input('consoleId'));

        return redirect()->route('listConsoles');
    }
}
