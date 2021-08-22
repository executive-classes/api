<?php

namespace Tests\Unit\Traits\Models;

use Carbon\Carbon;
use App\Models\Mailing\MessageTemplate;
use App\Enums\Mailing\MessageStatusEnum;

trait HasMessageVerificationAsserts
{
    public function test_hasTemplate_function()
    {
        $this->assertHasMethod(get_class($this->model), 'hasTemplate');

        $this->model->template = null;
        $this->assertFalse($this->model->hasTemplate());

        $this->model->template = new MessageTemplate();
        $this->assertTrue($this->model->hasTemplate());
    }
    
    public function test_wasSent_function()
    {
        $this->assertHasMethod(get_class($this->model), 'wasSent');

        $this->model->message_status_id = null;
        $this->assertFalse($this->model->wasSent());

        $this->model->message_status_id = MessageStatusEnum::SENT;
        $this->assertTrue($this->model->wasSent());
    }

    public function test_isScheduled_function()
    {
        $this->assertHasMethod(get_class($this->model), 'isScheduled');

        $this->model->message_status_id = null;
        $this->assertFalse($this->model->isScheduled());

        $this->model->message_status_id = MessageStatusEnum::SCHEDULED;
        $this->assertTrue($this->model->isScheduled());
    }

    public function test_wasCanceled_function()
    {
        $this->assertHasMethod(get_class($this->model), 'wasCanceled');

        $this->model->message_status_id = null;
        $this->assertFalse($this->model->wasCanceled());

        $this->model->message_status_id = MessageStatusEnum::CANCELED;
        $this->assertTrue($this->model->wasCanceled());
    }

    public function test_isReadyForSent_function()
    {
        $this->assertHasMethod(get_class($this->model), 'isReadyForSent');

        $this->model->message_status_id = null;
        $this->model->should_proccess_at = null;
        $this->assertFalse($this->model->isReadyForSent());
        
        $this->model->message_status_id = MessageStatusEnum::SCHEDULED;
        $this->model->should_proccess_at = Carbon::now()->addDay()->toDateTimeString();
        $this->assertFalse($this->model->isReadyForSent());

        $this->model->message_status_id = MessageStatusEnum::SCHEDULED;
        $this->model->should_proccess_at = Carbon::now()->toDateTimeString();
        $this->assertTrue($this->model->isReadyForSent());
    }
}