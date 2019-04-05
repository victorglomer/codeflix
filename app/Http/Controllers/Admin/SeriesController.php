<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Models\Serie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

use CodeFlix\Forms\SerieForm;
use CodeFlix\Repositories\SerieRepository;

class SeriesController extends Controller
{

    private $repository;

    public function __construct(SerieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $series = $this->repository->paginate();
        return view('admin.series.index', compact('series'));
    }


    public function create()
    {
        $form = \FormBuilder::create(SerieForm::class, [
            'url' => route('admin.series.store'),
            'method' => 'POST',
        ]);
        return view('admin.series.create', compact('form'));
    }


    public function store(Request $request)
    {
        $form = \FormBuilder::create(SerieForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();

        $data['thumb'] = env('SERIE_NO_THUMB');
        Model::unguard();

        $this->repository->create(($data));

        $request->session()->flash('message', 'Série adicionada com sucesso');
        return redirect()->route('admin.series.index');
    }

    public function show(Serie $series)
    {
        return view('admin.series.show', compact('series'));
    }

    public function edit(Serie $series)
    {
        $form = \FormBuilder::create(SerieForm::class, [
            'url' => route('admin.series.update', ['serie' => $series->id]),
            'method' => 'PUT',
            'model' => $series,
            'data' => ['id' => $series->id],
        ]);
        return view('admin.series.edit', compact('form'));


    }

    public function update(Request $request, $id)
    {
        $form = \FormBuilder::create(SerieForm::class, [
            'data' => ['id' => $id]
        ]);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();


        $data = array_except($data, 'thumb');
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Série successfully updated');
        return redirect()->route('admin.series.index');
    }


    public function destroy(Request $request, Serie $series)
    {
        $this->repository->delete($series->id);
        $request->session()->flash('message', 'Série successfully deleted');
        return redirect()->route('admin.series.index');
    }

    public function thumbAsset(Serie $serie)
    {
        return response()->download($serie->thumb_path);
    }
    public function thumbSmallAsset(Serie $serie)
    {
        return response()->download($serie->thumb_small_path);
    }

}
