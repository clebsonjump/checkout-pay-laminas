<?php
namespace Produto\Model;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\TableGatewayInterface;
use Laminas\Paginator\Adapter\DbSelect;
use Laminas\Paginator\Paginator;

class ProdutoTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false)
    {
        if ($paginated) {
            return $this->fetchPaginatedResults();
        }

        return $this->tableGateway->select();
    }

    public function getProduto($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    private function fetchPaginatedResults()
    {
        $select = new Select($this->tableGateway->getTable());

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Produto());

        $paginatorAdapter = new DbSelect(
            $select,
            $this->tableGateway->getAdapter(),
            $resultSetPrototype
        );

        return new Paginator($paginatorAdapter);
    }

    public function saveProduto(Produto $produto)
    {
        $data = [
            'nome'          => $produto->nome,
            'descricao'     => $produto->descricao,
            'imagem'        => $produto->imagem,
        ];

        $id = (int) $produto->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getProduto($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update produto with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteProduto($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}