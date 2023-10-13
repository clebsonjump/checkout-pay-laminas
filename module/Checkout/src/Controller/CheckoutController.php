<?php
namespace Checkout\Controller;

use Checkout\Util\Util;
use Checkout\Form\Checkout\CheckoutForm;
use Checkout\Model\Checkout\Checkout;
use Checkout\Interface\CheckoutCommandInterface;
use Checkout\Interface\CheckoutRepositoryInterface;
use InvalidArgumentException;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Http\PhpEnvironment\Request;
use Laminas\File\Transfer\Adapter\Http;
use Laminas\Validator\File\IsImage;
use Laminas\Filter\File\RenameUpload;

class CheckoutController extends AbstractActionController
{
    /**
     * @var CheckoutCommandInterface
     */
    private $command;

    /**
     * @var CheckoutForm
     */
    private $form;

    /**
     * @var CheckoutRepositoryInterface
     */
    private $repository;

    /**
     * @param CheckoutCommandInterface $command
     * @param CheckoutForm $form
     * @param CheckoutRepositoryInterface $repository
     */
    public function __construct(CheckoutCommandInterface $command, CheckoutForm $form, CheckoutRepositoryInterface $repository) {
        $this->command = $command;
        $this->form = $form;
        $this->repository = $repository;
    }

    public function indexAction()
    {
        return new ViewModel([
            'checkouts' => $this->repository->findAllCheckouts(),
        ]);
    }

    public function addAction()
    {

        $request   = $this->getRequest();
        $viewModel = new ViewModel(['form' => $this->form]);

        if (! $request->isPost()) {
            return $viewModel;
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return $viewModel;
        }

        $checkout = $this->form->getData();

        try {
            $newFileName = Util::uploadImage($checkout->imagem);
            $checkout->imagem = $newFileName;
            $checkout = $this->command->insertCheckout($checkout);
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $this->redirect()->toRoute(
            'checkout/detail',
            ['id' => $checkout->getId()]
        );
    }

    public function editAction()
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

        $this->form->bind($checkout);
        $viewModel = new ViewModel(['form' => $this->form]);

        $request = $this->getRequest();
        if (! $request->isPost()) {
            return $viewModel;
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return $viewModel;
        }

        $newFileName = Util::uploadImage($checkout->imagem);
        $checkout->imagem = $newFileName;
        $checkout = $this->command->updateCheckout($checkout);
        return $this->redirect()->toRoute(
            'checkout/detail',
            ['id' => $checkout->getId()]
        );
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');

        try {
            $checkout = $this->repository->findCheckout($id);
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('checkout');
        }

        $viewModel = new ViewModel([
            'checkouts' => $checkout,
        ]);
        $viewModel->setTerminal(true);

        return $viewModel;
    }
}