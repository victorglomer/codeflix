<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Models\Video;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\VideoRepository;
use CodeFlix\Forms\VideoForm;

class VideosController extends Controller
{

    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->repository->paginate();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(VideoForm::class, [
            'url' => route('admin.videos.store'),
            'method' => 'POST'
        ]);

        return view('admin.videos.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create(VideoForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->create($data);

        $request->session()->flash('message', 'Vídeo adicionado com sucesso');
        return redirect()->route('admin.videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \CodeFlix\Models\Video $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \CodeFlix\Models\Video $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $form = \FormBuilder::create(VideoForm::class, [
            'url' => route('admin.videos.update', ['video' => $video->id]),
            'method' => 'PUT',
            'model' => $video,
        ]);

        return view('admin.videos.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \CodeFlix\Models\Video $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = \FormBuilder::create(VideoForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);

        $request->session()->flash('message', 'Vídeo editado com sucesso');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \CodeFlix\Models\Video $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->repository->withTrashed()->find(1); // busca inclusive excluídos
        // $this->repository->onlyTrashed()->find(1); // busca apenas excluídos
        // $video->restore() // remove deleted_at, torna ativo


        $this->repository->delete($id);

        $request->session()->flash('message', 'Vídeo excluído com sucesso');
        return view('admin.videos.index');
    }

    public function videoFileAsset(Video $video)
    {
        return response()->download($video->video_file_path);
    }

    public function thumbAsset(Video $video)
    {
        return response()->download($video->thumb_path);
    }

    public function thumbSmallAsset(Video $video)
    {
        return response()->download($video->thumb_small_path);
    }

}
