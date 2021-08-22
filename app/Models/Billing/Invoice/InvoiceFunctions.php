<?php

namespace App\Models\Billing\Invoice;

use Illuminate\Support\Collection;

trait InvoiceFunctions
{
    /**
     * Return the users authorized to access the invoice.
     *
     * @return Collection
     */
    public function getAuthorizedUsers(): Collection
    {
        /** @todo Pegar usuários do customer */
        /** @todo Pegar funcionario administrador */
        /** @todo Pegar funcionario financeiro */
        
        return collect();
    }
}