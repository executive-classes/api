<?php

namespace App\Models\Eloquent\Mailing\MessageTemplate;

use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use App\Support\Repositories\Repository;

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