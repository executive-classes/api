<?php

namespace App\Console\Commands\Mailing;

use App\Console\Command;
use App\Repositories\Mailing\MessageRepository;
use App\Services\Mailing\SendMessageService;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing:sendMessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a schedule message in the database';

    /**
     * The Message Repository
     *
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * The service that send the messages.
     *
     * @var SendMessageService
     */
    protected $sendMessageService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        MessageRepository $messageRepository,
        SendMessageService $sendMessageService
    )
    {
        $this->messageRepository = $messageRepository;
        $this->sendMessageService = $sendMessageService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->block('Starting message processing.', '', 'fg=black;bg=cyan', '!', true);

        // Obtain the messages that are ready to be sent.
        $messages = $this->messageRepository->findReadyForSend();
        $this->info($messages->count() . ' message(s) obtained.');

        // Send the message
        $this->output->progressStart($messages->count());
        foreach ($messages as $message) {
            $this->output->progressAdvance();

            try {
                $this->sendMessageService->sendMessage($message);
            } catch (\Exception $e) {
                $this->messageRepository->addError($message, $e);
                continue;
            }
        }
        $this->output->progressFinish();

        $this->block('Messages sent.', 'Success', 'fg=black;bg=green', '!', true);
    }
}
