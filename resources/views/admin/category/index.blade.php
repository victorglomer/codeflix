@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Categorias</h3>
            {!! Button::primary('Nova Categoria')->asLinkTo(route('admin.category.create')) !!}
        </div>
        

        
        <div class="row">
            {!! 
                Table::withContents($categories->items())->striped()
                ->callback('Ações', function($field, $c) {
                    $linkedit = route('admin.category.edit', ['category' => $c]);
                    
                    $buttonDelete = Button::link(Icon::create('remove'))
                    ->asLinkTo(route('admin.category.show', ['category' => $c]));

                    
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkedit). " | " . $buttonDelete;
                })
            
            !!}            
        </div>
        {!! $categories->links() !!}
    </div>
@endsection
