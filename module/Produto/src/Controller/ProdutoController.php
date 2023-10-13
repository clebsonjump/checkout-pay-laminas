<?php
namespace Produto\Controller;

use Produto\Model\ProdutoTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

// Add the following import statements at the top of the file:
use Produto\Form\ProdutoForm;
use Produto\Model\Produto;

class ProdutoController extends AbstractActionController
{
    // Add this property:
    private $table;

    // Add this constructor:
    public function __construct(ProdutoTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        $paginator = $this->table->fetchAll(true);
    
        $page = (int) $this->params()->fromQuery('page', 1);
        $page = ($page < 1) ? 1 : $page;
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(10);
    
        return new ViewModel(['paginator' => $paginator]);
    }

    public function addAction()
    {
        $form = new ProdutoForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $produto = new Produto();
        $form->setInputFilter($produto->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $produto->exchangeArray($form->getData());
        $this->table->saveProduto($produto);
        return $this->redirect()->toRoute('produto');
    }


    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('produto', ['action' => 'add']);
        }

        try {
            $produto = $this->table->getProduto($id);

        } catch (\Exception $e) {
            return $this->redirect()->toRoute('produto', ['action' => 'index']);
        }

        $form = new ProdutoForm();
        $form->bind($produto);
        $form->get('submit')->setAttribute('value', 'editar');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData; 
        }

        $form->setInputFilter($produto->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        try {
            $this->table->saveProduto($produto);
        } catch (\Exception $e) {
        }

        return $this->redirect()->toRoute('produto', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('produto');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteProduto($id);
            }

            return $this->redirect()->toRoute('produto');
        }

        return [
            'id'    => $id,
            'produto' => $this->table->getProduto($id),
        ];
    }
}