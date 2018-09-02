<?php declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Core\Validator\Exception\ValidationException;
use App\Entity\Conversion;
use App\Form\ConversionFile;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ConversionAction
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

    public function __invoke(Request $request): Conversion
    {
        $conversion = new Conversion();

        $form = $this->factory->create(ConversionFile::class, $conversion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->doctrine->getManager();
            $em->persist($conversion);
            $em->flush();

            $conversion->getOrder()->setStatus(2);

            return $conversion;
        }

        // This will be handled by API Platform and returns a validation error.
        throw new ValidationException($this->validator->validate($conversion));
    }
}
