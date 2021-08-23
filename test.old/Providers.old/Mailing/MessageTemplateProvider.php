<?php

namespace Tests\Providers\Mailing;

use App\Models\Eloquent\Mailing\MessageFooter\MessageFooter;
use App\Models\Eloquent\Mailing\MessageHeader\MessageHeader;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use App\Models\Eloquent\Mailing\MessageType\MessageType;

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