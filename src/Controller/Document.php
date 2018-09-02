<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Conversion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Vich\UploaderBundle\Handler\DownloadHandler;
use Symfony\Component\Routing\Annotation\Route;

class Document extends AbstractController
{
    /**
     * @Route("/document/source/{id}", name="download_source_document")
     *
     * @param OrderAction $conversion
     * @param DownloadHandler $downloadHandler
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadSourceDocumentAction(Order $conversion, DownloadHandler $downloadHandler)
    {
        return $downloadHandler->downloadObject(
            $conversion,
            'file',
            null,
            $conversion->getOriginalName()
        );
    }

    /**
     * @Route("/document/converted/{id}", name="download_converted_document")
     *
     * @param ConversionAction $converted
     * @param DownloadHandler $downloadHandler
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadConvertedDocumentAction(Conversion $converted, DownloadHandler $downloadHandler)
    {
        return $downloadHandler->downloadObject(
            $converted,
            'convertedFile',
            null,
            $converted->getConvertedOriginalName()
        );
    }
}
