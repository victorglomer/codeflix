@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Categorias</h3>
            {!! Button::primary('Nova Categoria')->asLinkTo(route('admin.categorias.create')) !!}
        </div>
        <div class="row">
            {!! 
                Table::withContents($categorias->items())->striped()
                ->callback('Ações', function($field, $c) {
                    $linkedit = route('admin.categorias.edit', ['categorias' => $c]);
                    $linkshow = route('admin.categorias.show', ['categorias' => $c]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkedit). " | " .
                    Button::link(Icon::create('remove'))->asLinkTo($linkshow);
                })
            
            !!}            
        </div>
        {!! $categorias->links() !!}
    </div>
@endsection
