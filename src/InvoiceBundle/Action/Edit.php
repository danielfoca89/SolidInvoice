<?php

declare(strict_types=1);

/*
 * This file is part of SolidInvoice project.
 *
 * (c) Pierre du Plessis <open-source@solidworx.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\InvoiceBundle\Action;

use Exception;
use Generator;
use SolidInvoice\CoreBundle\Response\FlashResponse;
use SolidInvoice\InvoiceBundle\Entity\Invoice;
use SolidInvoice\InvoiceBundle\Form\Handler\InvoiceEditHandler;
use SolidInvoice\InvoiceBundle\Model\Graph;
use SolidWorx\FormHandler\FormHandler;
use SolidWorx\FormHandler\FormRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

final class Edit
{
    private FormHandler $formHandler;

    private RouterInterface $router;

    public function __construct(RouterInterface $router, FormHandler $formHandler)
    {
        $this->router = $router;
        $this->formHandler = $formHandler;
    }

    /**
     * @return FormRequest|RedirectResponse
     * @throws Exception
     */
    public function __invoke(Request $request, Invoice $invoice)
    {
        if (Graph::STATUS_PAID === $invoice->getStatus()) {
            $route = $this->router->generate('_invoices_index');

            return new class($route) extends RedirectResponse implements FlashResponse {
                public function getFlash(): Generator
                {
                    yield FlashResponse::FLASH_WARNING => 'invoice.edit.paid';
                }
            };
        }

        $options = [
            'invoice' => $invoice,
            'form_options' => [
                'currency' => $invoice->getClient()->getCurrency(),
            ],
        ];

        return $this->formHandler->handle(InvoiceEditHandler::class, $options);
    }
}
