<?php
namespace Checkout\Factory\Checkout;

use Checkout\Interface\CheckoutRepositoryInterface;
use Checkout\Interface\CheckoutCommandInterface;
use Checkout\Controller\CheckoutController;
use Checkout\Form\Checkout\CheckoutForm;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class CheckoutControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return CheckoutController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');
    
        return new CheckoutController(
            $container->get(CheckoutCommandInterface::class),
            $formManager->get(CheckoutForm::class),
            $container->get(CheckoutRepositoryInterface::class)
        );
    }
}