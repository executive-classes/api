<?php

namespace App\Repositories\Mailing;

use App\Models\Mailing\MessageTemplate;
use App\Repositories\Repository;

class MessageTemplateRepository extends Repository
{
    /**
     * Create the MessageTemplate Repository.
     *
     * @param MessageTemplate $messageTemplate
     */
    public function __construct(MessageTemplate $messageTemplate) 
    {
        $this->model = $messageTemplate;
    }
}