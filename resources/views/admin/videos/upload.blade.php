@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @component('admin.videos.tabs-component', ['video' => $form->getModel()])
                <h3>
                    Vídeo e arquivo de vídeo
                </h3>
                <?php $icon = Icon::create('pencil'); ?>
                {!!
                    form($form->add('salvar', 'submit', [
                        'attr' => ['class' => 'btn btn-primary btn-block'],
                        'label' => $icon,
                    ]))
                !!}
            @endcomponent

        </div>
    </div>
@endsection
