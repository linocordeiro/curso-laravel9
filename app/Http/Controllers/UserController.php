<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Dompdf\Dompdf;
//use Barryvdh\DomPDF\Facade as PDF1;

/**
 * Class UserController
 * @package App\Http\Controllers
 * @property-read Request $request
 * @property-read Pdf PDF
 */
class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {
        //buscar todos
        // $users = User::get();

        //buscar usando a busca
        // $users = User::where('name', 'like', "%{$request->search}%")->get(); //ficar em outra camada, model ou repository

        //buscar usando a busca mas de outra forma
        $search = $request->search;
        $users = $this->model->getUsers($request->get('search', ''));
        //LOGICA MOVIDA PARA O MODEL
        /*$search = $request->search;
        // $users = User::where(function ($query) use ($search) {
        $users = $this->model
            ->where(function ($query) use ($search) {
                if ($search) {
                    // dd($search);
                    $query->where('email', 'like', "%{$search}%");
                    $query->orWhere('name', 'like', "%{$search}%");
                }
            })
            ->get();*/
        // dd($users);

        return view('users.index', ['users' => $users]);
    }

    public function show($id)
    {
        //        $user = User::where('id', $id)->first();
        if (!($user = User::find($id))) {
            return redirect()->route('users.index');
        }

        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        //        dd($request);
        $dados = $request->all();
        $dados['password'] = bcrypt($request->password);

        //        dd($request->image);
        if ($request->image) {
            //            $dados['image'] = $request->image->store('users');

            //renomeando imagem
            $extension = $request->image->getClientOriginalExtension();
            $dados['image'] = $request->image->storeAs('users', now() . ".{$extension}");
        }

        $this->model->create($dados);
        //        User::create($dados);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        if (!($user = User::find($id))) {
            return redirect()->route('users.index');
        }

        return view('users.edit', compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        //pode mover toda essa logica para o model ou repository
        if (!($user = User::find($id))) {
            return redirect()->route('users.index');
        }

        $dados = $request->only('name', 'email');

        if ($request->password) {
            $dados['password'] = bcrypt($request->password);
        }

        if ($request->image) {
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $dados['image'] = $request->image->store('users');
        }

        $user->update($dados);

        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        if (!($user = User::find($id))) {
            return redirect()->route('users.index');
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    public function getRelatorio()
    {
        $users = User::all();

        return PDF::loadView('users.report', compact('users'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            //            ->download('users-report.pdf');
            ->stream();
    }
}
