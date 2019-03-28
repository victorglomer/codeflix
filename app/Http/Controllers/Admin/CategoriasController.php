<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Models\Categorias;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\CategoriasRepository;
use CodeFlix\Forms\CategoriasForm;

class CategoriasController extends Controller {

    private $repository;

    function __construct(CategoriasRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categorias = $this->repository->paginate();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $form = \FormBuilder::create(CategoriasForm::class, [
                    'url' => route('admin.categorias.store'),
                    'method' => 'POST',
        ]);
        return view('admin.categorias.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $form = \FormBuilder::create(CategoriasForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->create(($data));

        $request->session()->flash('message', 'Categoria adicionada com sucesso');
        return redirect()->route('admin.categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function show(Categorias $categorias) {
        dd($categorias);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {

        $categoria = $this->repository->find($request->categoria);
//        dd($categoria);

        $form = \FormBuilder::create(
                        CategoriasForm::class, [
                    'url' => route('admin.categorias.update', ['id' => $categoria->id]),
                    'method' => 'PUT',
                    'model' => $categoria,
        ]);
        return view('admin.categorias.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CodeFlix\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $form = \FormBuilder::create(CategoriasForm::class, [
            'data' => ['id' => $id]
        ]);
        if(! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors());
        }
        
        $this->repository->update($form->getFieldValues(), $id);
        $request->session()->flash('message', 'Categoria editada com sucesso');
        return redirect()->route('admin.categorias.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CodeFlix\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorias $categorias) {
        //
    }

}
