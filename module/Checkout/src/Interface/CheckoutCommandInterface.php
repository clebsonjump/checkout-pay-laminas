<?php
namespace Checkout\Interface;

use Checkout\Model\Checkout\Checkout;

interface CheckoutCommandInterface
{
    /**
     * Persist a new checkout in the system.
     *
     * @param Checkout $checkout The checkout to insert; may or may not have an identifier.
     * @return Checkout The inserted checkout, with identifier.
     */
    public function insertCheckout(Checkout $checkout);

    /**
     * Update an existing checkout in the system.
     *
     * @param Checkout $checkout The checkout to update; must have an identifier.
     * @return Checkout The updated checkout.
     */
    public function updateCheckout(Checkout $checkout);

    /**
     * Delete a checkout from the system.
     *
     * @param Checkout $checkout The checkout to delete.
     * @return bool
     */
    public function deleteCheckout(Checkout $checkout);
}