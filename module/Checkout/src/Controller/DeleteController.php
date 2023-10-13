<?php
namespace Checkout\Controller;

use Checkout\Model\Checkout\Checkout;
use Checkout\Interface\CheckoutCommandInterface;
use Checkout\Interface\CheckoutRepositoryInterface;
use InvalidArgumentException;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
    /**
     * @var CheckoutCommandInterface
     */
    private $command;

    /**
     * @var CheckoutRepositoryInterface
     */
    private $repository;

    /**
     * @param CheckoutCommandInterface $command
     * @param CheckoutRepositoryInterface $repository
     */
    public function __construct(
        CheckoutCommandInterface $command,
        CheckoutRepositoryInterface $repository
    ) {
        $this->command = $command;
        $this->repository = $repository;
    }

    public function deleteAction()
    {

        $id = $this->params()->fromRoute('id');
        if (! $id) {
            return $this->redirect()->toRoute('checkout');
        }

        try {
            $checkout = $this->repository->findCheckout($id);

        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('checkout');
        }

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return new ViewModel(['checkout' => $checkout]);
        }

        if ($id != $request->getPost('id')  || 'Delete' !== $request->getPost('confirm', 'no')
        ) {
            return $this->redirect()->toRoute('checkout');
        }

        $checkout = $this->command->deleteCheckout($checkout);
        return $this->redirect()->toRoute('checkout');
    }
}