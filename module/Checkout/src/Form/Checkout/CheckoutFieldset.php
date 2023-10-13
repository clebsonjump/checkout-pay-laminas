<?php
namespace Checkout\Form\Checkout;

use Checkout\Model\Checkout\Checkout;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\Form\Fieldset;
use Laminas\Form\Element;

class CheckoutFieldset extends Fieldset
{
    public function init()
    {
        $this->setHydrator(new ReflectionHydrator());
        $this->setObject(new Checkout('', '','','','','',''));

        $this->add([
            'type' => 'hidden',
            'name' => 'id',
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'id_produto',
            'options' => [
                'label' => 'Produto',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'titulo',
            'options' => [
                'label' => 'Titulo do Checkout',
            ],
        ]);

        $this->add([
            'type' => 'textarea',
            'name' => 'descricao',
            'options' => [
                'label' => 'Descrição',
            ],
        ]);

        $this->add([
            'type' => 'file',
            'name' => 'imagem',
            'options' => [
                'label' => 'Imagem',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'valor',
            'options' => [
                'label' => 'Valor',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'item_aprendizado',
            'options' => [
                'label' => 'Item Resumo',
            ],
        ]);
    }
}