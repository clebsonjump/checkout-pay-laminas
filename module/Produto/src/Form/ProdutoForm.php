<?php
namespace Produto\Form;

use Laminas\Form\Form;

class ProdutoForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('produto');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'nome',
            'type' => 'text',
            'options' => [
                'label' => 'Nome',
            ],
        ]);
        $this->add([
            'name' => 'descricao',
            'type' => 'text',
            'options' => [
                'label' => 'Descrição',
            ],
        ]);
        $this->add([
            'name' => 'imagem',
            'type' => 'text',
            'options' => [
                'label' => 'Imagem',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}