<?php declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Core\Validator\Exception\ValidationException;
use App\Form\OrderFile;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Order;

final class OrderAction
{
    private $validator;
    private $doctrine;
    private $factory;

    public function __construct(RegistryInterface $doctrine, FormFactoryInterface $factory, ValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->doctrine = $doctrine;
        $this->factory = $factory;
    }

    public function __invoke(Request $request): Order
    {
        $order = new Order();

        $form = $this->factory->create(OrderFile::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order->setStatus(1);

            $em = $this->doctrine->getManager();
            $em->persist($order);
            $em->flush();

            return $order;
        }

        // This will be handled by API Platform and returns a validation error.
        throw new ValidationException($this->validator->validate($order));
    }
}
