<?php
namespace Checkout\Model;

use InvalidArgumentException;
use RuntimeException;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;

use Laminas\Db\Adapter\Adapter;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\ArrayAdapter;
use Checkout\Interface\CheckoutRepositoryInterface;

use Checkout\Model\Checkout\Checkout;

class LaminasDbSqlRepository implements CheckoutRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @var Checkout
     */
    private $checkoutPrototype;

    public function __construct(
        AdapterInterface $db,
        HydratorInterface $hydrator,
        Checkout $checkoutPrototype
    ) {
        $this->db            = $db;
        $this->hydrator      = $hydrator;
        $this->checkoutPrototype = $checkoutPrototype;
    }

    /**
     * Return a set of all blog checkouts that we can iterate over.
     *
     * Each entry should be a checkout instance.
     *
     * @return Checkout[]
     */

    public function findAllCheckouts()
    {
        
        $sql       = new Sql($this->db);
        $select    = $sql->select('checkout');
        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->checkoutPrototype);
        $resultSet->initialize($result);
        $arrayData = $resultSet->toArray();

        return $arrayData;         
    }

    /**
     * Return a single checkout checkout.
     *
     * @param  int $id Identifier of the checkout to return.
     * @return Checkout
     */
    public function findCheckout($id)
    {
        $sql       = new Sql($this->db);
        $select    = $sql->select('checkout');
        $select->where(['id = ?' => $id]);
    
        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();
    
        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving checkout with identifier "%s"; unknown database error.',
                $id
            ));
        }
    
        $resultSet = new HydratingResultSet($this->hydrator, $this->checkoutPrototype);
        $resultSet->initialize($result);
        $checkout = $resultSet->current();
    
        if (! $checkout) {
            throw new InvalidArgumentException(sprintf(
                'Checkout with identifier "%s" not found.',
                $id
            ));
        }
    
        return $checkout;
    }
}