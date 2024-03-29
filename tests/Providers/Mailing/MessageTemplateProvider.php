<?php

namespace Tests\Providers\Mailing;

use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageTemplate;
use App\Models\Mailing\MessageType;

trait MessageTemplateProvider
{
    /**
     * Providers
     */

    public function getMessageTemplate()
    {
        return [
            [$this->getMessageTemplateFunction()]
        ];
    }

    /**
     * Providers Functions
     */

    private function getMessageTemplateFunction()
    {
        return function () { return [$this->makeMessageTemplate()]; };
    }

    /**
     * Makers
     */

    public function makeMessageTemplate()
    {
        return MessageTemplate::factory()->create();
    }

    public function makeMultipleMessageTemplates(int $count = 1)
    {
        return MessageTemplate::factory()->count($count)->create();
    }

}