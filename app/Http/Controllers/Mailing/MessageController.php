<?php

namespace App\Http\Controllers\Mailing;

use App\Exceptions\Mailing\MessageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mailing\Message\MessageCreateRequest;
use App\Models\Eloquent\Mailing\Message\Message;
use App\Models\Eloquent\Mailing\Message\MessageRepository;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * The Message Repository.
     */
    protected MessageRepository $messageRepository;

    /**
     * Create a Message Controller.
     *
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository) 
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * List all messages.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function list(Request $request)
    {
        $messages = $this->messageRepository->list();
        return api()->ok($messages);
    }

    /**
     * Show a message.
     *
     * @param Request $request
     * @param Message $message
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(Request $request, Message $message)
    {
        return api()->ok($message);
    }

    /**
     * Create a new message.
     *
     * @param MessageCreateRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function create(MessageCreateRequest $request)
    {
        $message = $this->messageRepository->create($request->validated());
        return api()->created($message);
    }

    /**
     * Cancel a scheduled message.
     *
     * @param Request $request
     * @param Message $message
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function cancel(Request $request, Message $message)
    {
        try {
            $this->messageRepository->cancelScheduledMessage($message);
        } catch (MessageException $e) {
            return api()->error($e->getCode(), $e->getMessage());
        }

        return api()->noContent();
    }
}
