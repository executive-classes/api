<?php

namespace App\Http\Controllers\Mailing;

use App\Exceptions\Mailing\MessageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mailing\Message\MessageCancelRequest;
use App\Http\Requests\Mailing\Message\MessageCreateRequest;
use App\Http\Requests\Mailing\Message\MessageDeleteRequest;
use App\Http\Requests\Mailing\Message\MessageRequest;
use App\Models\Mailing\Message;
use App\Repositories\Mailing\MessageRepository;

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
     * @param MessageRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function list(MessageRequest $request)
    {
        $messages = $this->messageRepository->list();
        return $this->okResponse($messages);
    }

    /**
     * Show a message.
     *
     * @param MessageRequest $request
     * @param Message $message
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(MessageRequest $request, Message $message)
    {
        return $this->okResponse($message);
    }

    /**
     * Create a new message.
     *
     * @param MessageCreateRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function create(MessageCreateRequest $request)
    {
        $message = $this->messageRepository->create($request->all());
        return $this->createdResponse($message);
    }

    /**
     * Cancel a scheduled message.
     *
     * @param MessageCancelRequest $request
     * @param Message $message
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function cancel(MessageCancelRequest $request, Message $message)
    {
        try {
            $this->messageRepository->cancelScheduledMessage($message);
        } catch (MessageException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }

        return $this->noContentResponse();
    }

    /**
     * Delete a message.
     *
     * @param MessageDeleteRequest $request
     * @param Message $message
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function delete(MessageDeleteRequest $request, Message $message)
    {
        $this->messageRepository->delete($message->id);
        return $this->noContentResponse();
    }
}
