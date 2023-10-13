<?php
namespace Checkout\Interface;

use Checkout\Model\Checkout;

interface CheckoutRepositoryInterface
{
    /**
     * Return a set of all blog checkouts that we can iterate over.
     *
     * Each entry should be a checkout instance.
     *
     * @return Checkout[]
     */
    public function findAllCheckouts();

    /**
     * Return a single blog checkout.
     *
     * @param  int $id Identifier of the checkout to return.
     * @return Checkout
     */
    public function findCheckout($id);
}