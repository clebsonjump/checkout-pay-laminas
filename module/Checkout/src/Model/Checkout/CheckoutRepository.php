<?php
namespace Checkout\Model\Checkout;

use DomainException;
use Checkout\Interface\CheckoutRepositoryInterface;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    private $data = [
        1 => [
            'id'    => 1,
            'title' => 'Hello World #1',
            'text'  => 'This is our first blog checkout!',
        ],
        2 => [
            'id'    => 2,
            'title' => 'Hello World #2',
            'text'  => 'This is our second blog checkout!',
        ],
        3 => [
            'id'    => 3,
            'title' => 'Hello World #3',
            'text'  => 'This is our third blog checkout!',
        ],
        4 => [
            'id'    => 4,
            'title' => 'Hello World #4',
            'text'  => 'This is our fourth blog checkout!',
        ],
        5 => [
            'id'    => 5,
            'title' => 'Hello World #5',
            'text'  => 'This is our fifth blog checkout!',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    public function findAllCheckouts($paginated = false)
    {
        if ($paginated) {
            return $this->fetchPaginatedResults();
        }

        return array_map(function ($checkout) {
            return new Checkout(
                $checkout['title'],
                $checkout['text'],
                $checkout['id']
            );
        }, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function findCheckout($id)
    {
        if (! isset($this->data[$id])) {
            throw new DomainException(sprintf('checkout by id "%s" not found', $id));
        }

        return new Checkout(
            $this->data[$id]['title'],
            $this->data[$id]['text'],
            $this->data[$id]['id']
        );
    }
}