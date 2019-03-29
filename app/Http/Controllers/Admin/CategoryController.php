<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\CategoriasForm;
use CodeFlix\Models\Category;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\CategoryRepository;

class CategoryController extends Controller {

    private $repository;

    public function __construct(CategoryRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = $this->repository->paginate();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $form = \FormBuilder::create(CategoriasForm::class, [
                    'url' => route('admin.category.store'),
                    'method' => 'POST',
        ]);
        return view('admin.category.create', compact('form'));
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
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) {
        $form = \FormBuilder::create(CategoriasForm::class, [
                    'url' => route('admin.category.update', ['category' => $category->id]),
                    'method' => 'PUT',
                    'model' => $category
        ]);
        return view('admin.category.edit', compact('form'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CodeFlix\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $form = \FormBuilder::create(CategoriasForm::class, [
                    'data' => ['id' => $id]
        ]);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Category successfully updated');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CodeFlix\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category) {
        $this->repository->delete($category->id);
        $request->session()->flash('message', 'Category successfully deleted');
        return redirect()->route('admin.category.index');
    }

}
