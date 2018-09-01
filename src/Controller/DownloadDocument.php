<?php

namespace App\Controller;

use App\Entity\Conversion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Vich\UploaderBundle\Handler\DownloadHandler;
use Symfony\Component\Routing\Annotation\Route;

class DownloadDocument extends AbstractController
{
    /**
     * @Route("/document/{id}", name="download_document")
     *
     * @param Conversion $conversion
     * @param DownloadHandler $downloadHandler
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadDocumentAction(Conversion $conversion, DownloadHandler $downloadHandler)
    {
        return $downloadHandler->downloadObject(
            $conversion,
            'file',
            $objectClass = null,
            $conversion->getOriginalName()
        );
    }
}
