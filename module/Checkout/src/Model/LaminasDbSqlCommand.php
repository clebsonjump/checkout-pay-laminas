<?php
namespace Checkout\Model;

use RuntimeException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Update;
use Checkout\Interface\CheckoutCommandInterface;

use Checkout\Model\Checkout\Checkout;

class LaminasDbSqlCommand implements CheckoutCommandInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @param AdapterInterface $db
     */
    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    /**
     * {@inheritDoc}
     */
    public function insertCheckout(Checkout $checkout)
    {
        $insert = new Insert('checkout');
        $insert->values([
            'id_produto' =>  $checkout->getIdProduto(),
            'titulo'  =>  $checkout->getTitulo(),
            'descricao' =>  $checkout->getDescricao(),
            'imagem'  =>  $checkout->getImagem(),
            'valor' =>  $checkout->getValor(),
            'item_aprendizado' =>  $checkout->getitemAprendizado(),
        ]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during checkout checkout insert operation'
            );
        }

        $id = $result->getGeneratedValue();

        return new Checkout(
            $checkout->getIdProduto(),
            $checkout->getTitulo(),
            $checkout->getDescricao(),
            $checkout->getImagem(),
            $checkout->getValor(),
            $checkout->getitemAprendizado(),
            $id
        );
    }

    /**
     * {@inheritDoc}
     */
    public function updateCheckout(Checkout $checkout)
    {
        if (! $checkout->getId()) {
            throw new RuntimeException('Cannot update checkout; missing identifier');
        }
    
        $update = new Update('checkout');
        $update->set([
                'id_produto' =>  $checkout->getIdProduto(),
                'titulo'  =>  $checkout->getTitulo(),
                'descricao' =>  $checkout->getDescricao(),
                'imagem'  =>  $checkout->getImagem(),
                'valor' =>  $checkout->getValor(),
                'item_aprendizado' =>  $checkout->getitemAprendizado(),
        ]);
        $update->where(['id = ?' => $checkout->getId()]);
    
        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();
    
        if (! $result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during blog checkout update operation'
            );
        }
    
        return $checkout;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteCheckout(Checkout $checkout)
    {
        if (! $checkout->getId()) {
            throw new RuntimeException('Cannot delete checkout; missing identifier');
        }
    
        $delete = new Delete('checkout');
        $delete->where(['id = ?' => $checkout->getId()]);
    
        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($delete);
        $result = $statement->execute();
    
        if (! $result instanceof ResultInterface) {
            return false;
        }
    
        return true;
    }
}