<?php

namespace App\Traits\Tests\Mailing;

use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageTemplate;
use App\Models\Mailing\MessageType;

trait MessageTemplateMaker
{
    /**
     * Create a template.
     *
     * @return MessageTemplate
     */
    public function createTemplate()
    {
        $template = new MessageTemplate([
            'id' => 'newTest',
            'description' => 'test',
            'subject' => 'test',
            'content' => 'test',
            'message_type_id' => MessageType::first()->id,
            'message_header_id' => MessageHeader::first()->id,
            'message_footer_id' => MessageFooter::first()->id,
        ]);

        $template->save();
        return $template;
    }
}