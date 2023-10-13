<?php
namespace Checkout\Form\Checkout;

use Laminas\Form\Form;

class CheckoutForm extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'checkout',
            'type' => CheckoutFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true,
            ],
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Insert new Checkout',
            ],
        ]);
    }
}