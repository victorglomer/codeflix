@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Séries</h3>
            {!! Button::primary('Nova Série')->asLinkTo(route('admin.series.create')) !!}
        </div>
        

        
        <div class="row">
            {!! 
                Table::withContents($series->items())->striped()
                ->callback('Ações', function($field, $c) {
                    $linkedit = route('admin.series.edit', ['serie' => $c]);
                    
                    $buttonDelete = Button::link(Icon::create('remove'))
                    ->asLinkTo(route('admin.series.show', ['serie' => $c]));

                    
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkedit). " | " . $buttonDelete;
                })
            
            !!}            
        </div>
        {!! $series->links() !!}
    </div>
@endsection
