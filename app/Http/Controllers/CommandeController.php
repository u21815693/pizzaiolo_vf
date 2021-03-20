<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Commande_Pizza;
use App\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->type == 'pizzaiolo') {
            $commande = Commande::orderBy('created_at', 'desc')->with('user')
                ->where('status', '!=', 'traitées')->paginate(10);
            return view('pages.command.index', compact('commande'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
        if ($user->type == 'user') {
            $commande = Commande::orderBy('created_at', 'desc')
                ->with('user')
                //->whereIn('status', ['envoyé', 'en traitement', 'prête'])
                ->where('user_id', Auth::user()->id)
                ->paginate(10);
            return view('pages.command.index', compact('commande'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            $searchData = [
                'date' => \Carbon\Carbon::now()->format('20y-m-d'),
                'status' => ''
            ];
            $commande = Commande::orderBy('created_at', 'desc')->with('user')->paginate(10);
            return view('pages.command.index', compact('commande', 'searchData'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    public function search(Request $request)
    {
        $searchData = [
            'date' => $request->input('date'),
            'status' => $request->input('status')
        ];
        $dateFormat = 'Y-m-d';
        $date = $dateTime = \DateTime::createFromFormat($dateFormat, $request->input('date'));
        // Search in the title and body columns from the posts table
        $commande = Commande::orderBy('created_at', 'desc');
        if ($date != null) $commande = $commande->where('created_at', '<=', $date);
        if ($searchData['status'] != null) $commande = $commande->where('status', '=', $searchData['status']);
        // Return the search view with the resluts compacted
        $commande = $commande->paginate(10);
        return view('pages.command.index', compact('commande', 'searchData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function recipe()
    {
        $searchData = [
            'date' => \Carbon\Carbon::now()->format('20y-m-d')
        ];
        $dateFormat = 'Y-m-d';
        $date = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date']);

        $commande = Commande::with('user')->with('pizzas')
            ->where('created_at', '<=', $date)->get();
        $sum = 0;
        foreach ($commande as $key => $command) {
            foreach ($command->pizzas as $keyPizza => $pizza) {
                $sum = $sum + ($pizza->price * $pizza->qte);
            }
        }
        return view('pages.command.recipe', compact('sum', 'searchData'));
    }

    public function recipe_search(Request $request)
    {
        $searchData = [
            'date' => $request->input('date'),
        ];
        $dateFormat = 'Y-m-d';
        $date = $dateTime = \DateTime::createFromFormat($dateFormat, $searchData['date']);
        $commande = Commande::with('user')->with('pizzas')
            ->where('created_at', '<=', $date)->get();
        $sum = 0;
        foreach ($commande as $key => $command) {
            foreach ($command->pizzas as $keyPizza => $pizza) {
                $sum = $sum + ($pizza->price * $pizza->qte);
            }
        }
        return view('pages.command.recipe', compact('sum', 'searchData'));
    }

    public function panier()
    {
        $pizzas = Pizza::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.panier.index', compact('pizzas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function save_panier(Request $request)
    {
        $pizza = $request['id_pizza'];
        $add_command = array();
        if (count($pizza)) {
            $command = new Commande;
            $command->user_id = Auth::user()->id;
            $command->status = "envoyé";
            $command->save();
            foreach ($pizza as $key => $value) {
                if ($request['qte'][$key] > 0) {
                    $add_command[$key]['commande_id'] = $command->id;
                    $add_command[$key]['pizza_id'] = $value;
                    $add_command[$key]['qte'] = $request['qte'][$key];
                }
            }
            DB::table('commande_pizza')->insert($add_command);
        }

        return redirect('/commande');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.command.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);
        $pizza = new Commande;
        $pizza->user_id = Auth::user()->id;
        $pizza->status = $request->input('status');
        $pizza->save();
        return redirect('/commande');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = Commande::with('user')->with('pizzas')->find($id);
        // dd($commande);
        return view('pages.command.show', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commande = Commande::with('user')->find($id);
        return view('pages.command.edit', compact('commande'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);

        $commande->update($request->all());

        return redirect()->route('commande.index')
            ->with('success', 'Commande updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commande.index')
            ->with('success', 'Commande deleted successfully');
    }

    public function delete_panier($panier_id)
    {
        $user = DB::table('commande_pizza')->where('id', $panier_id);
        if (($user->delete())) {
            return back()
                ->with('success', 'Pizza deleted');
        }
        return back()->withInput()
            ->with('errors', 'Pizza not deleted');
    }
}
