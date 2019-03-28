@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Lista de usuários</h3>
            {!! Button::primary('Novo usuário')->asLinkTo(route('admin.users.create')) !!}
        </div>
        <div class="row">
            {!! 
                Table::withContents($users->items())->striped()
                ->callback('Ações', function($field, $user) {
                    $linkedit = route('admin.users.edit', ['user' => $user->id]);
                    $linkshow = route('admin.users.show', ['user' => $user->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkedit). " | " .
                    Button::link(Icon::create('remove'))->asLinkTo($linkshow);
                })
            
            !!}
        </div>
        {!! $users->links() !!}
    </div>
@endsection
