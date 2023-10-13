<?php
namespace Checkout\Factory\Checkout;

use Checkout\Interface\CheckoutCommandInterface;
use Checkout\Interface\CheckoutRepositoryInterface;
use Checkout\Controller\DeleteController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DeleteControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return DeleteController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DeleteController(
            $container->get(CheckoutCommandInterface::class),
            $container->get(CheckoutRepositoryInterface::class)
        );
    }
}