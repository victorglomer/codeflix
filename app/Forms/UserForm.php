<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form {

    public function buildForm() {
        //id para ignogar na edição com unique do email
        $id = $this->getData('id');
        
        $this
                ->add('name', 'text', [
                    'label' => 'nome',
                    'rules' => 'required|max:10'
                ])
                ->add('email', 'email', [
                    'label' => 'E-mail',
                    'rules' => "required|unique:users,email,$id"
                ]);
    }

}
