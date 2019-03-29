<?php

namespace CodeFlix\Http\Controllers\Admin;

use Bootstrapper\Form;
use CodeFlix\Forms\UserForm;
use CodeFlix\Forms\TrocaSenhaForm;
use Illuminate\Http\Request;
use CodeFlix\Models\User;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\UserRepository;

class UsersController extends Controller {

    private $repository;

    function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $users = $this->repository->paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $form = \FormBuilder::create(UserForm::class, [
                    'url' => route('admin.users.store'),
                    'method' => 'POST'
        ]);

        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $form = \FormBuilder::create(UserForm::class);
        if (!$form->isValid()) {
            //redirecionar para pagina de criação de usuários
            return redirect()
                            ->back()
                            ->withErrors($form->getErrors())
                            ->withInput();
        }
        $data = $form->getFieldValues();
//        $data['role'] = User::ROLE_ADMIN;
//        $data['password'] = User::generatePassword();
//        $request->session()->flash('message', 'Deu bão');
//        User::create($data);
        $this->repository->create($data);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {

        $form = \FormBuilder::create(UserForm::class, [
                    'url' => route('admin.users.update', ['user' => $user->id]),
                    'method' => 'PUT',
                    'model' => $user
        ]);

        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $form = \FormBuilder::create(UserForm::class, [
                    'data' => ['id' => $id]
        ]);
        if (!$form->isValid()) {
            //redirecionar para pagina de criação de usuários
            return redirect()
                            ->back()
                            ->withErrors($form->getErrors())
                            ->withInput();
        }
        $data = array_except($form->getFieldValues(), ['password', 'role']);
//        $user->fill($data);
//        $user->save();

        $this->repository->update($data, $id);

        $request->session()->flash('message', 'Deu bão a alteração');
        return redirect()->route('admin.users.index');
    }

    public function trocaSenha(Request $request) {

        $form = \FormBuilder::create(TrocaSenhaForm::class, [
                    'url' => route('admin.users.updatesenha'),
                    'method' => 'POST',
        ]);
        return view('admin.users.trocasenha', compact('form'));
    }

    public function updatesenha(Request $request) {
//        if ($request->password == $request->password_confirmation) {
//            $data = array(
//                'password' => bcrypt($request->password),
//                'troca_senha' => 1
//            );
//            $this->repository->update($data, \Auth::id());
//            
//            $request->session()->flash('message', 'Senha alterada com sucesso');
//            return redirect()->route('admin.users.index');
//        } else {
//            $request->session()->flash('danger', 'Senhas não conferem');
//            return redirect('/admin/troca-senha');
//        }

        $form = \FormBuilder::create(TrocaSenhaForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $dados['troca_senha'] = 1;
        $dados['password'] = bcrypt($data['password']);
        $this->repository->update($dados, \Auth::id());

        $request->session()->flash('message', 'Senha alterada com sucesso');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request) {
        $this->repository->delete($id);
        $request->session()->flash('message', 'Excluído. Foi tarde');
        return redirect()->route('admin.users.index');
    }

}
