<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateCreateRequest;
use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateDeleteRequest;
use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateRequest;
use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateUpdateRequest;
use App\Models\Mailing\MessageTemplate;
use App\Repositories\Mailing\MessageTemplateRepository;

class MessageTemplateController extends Controller
{
    /**
     * The Message Template Repository
     */
    protected MessageTemplateRepository $messageTemplateRepository;

    /**
     * Create a Message Template Controller.
     *
     * @param MessageTemplateRepository $messageTemplateRepository
     */
    public function __construct(MessageTemplateRepository $messageTemplateRepository) 
    {
        $this->messageTemplateRepository = $messageTemplateRepository;
    }

    /**
     * List all templates
     *
     * @param MessageTemplateRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function list(MessageTemplateRequest $request)
    {
        $templates = $this->messageTemplateRepository->list();
        return $this->okResponse($templates);
    }

    /**
     * Get a template.
     *
     * @param MessageTemplateRequest $request
     * @param MessageTemplate $messageTemplate
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(MessageTemplateRequest $request, MessageTemplate $messageTemplate)
    {
        return $this->okResponse($messageTemplate);
    }

    /**
     * Create a new template.
     *
     * @param MessageTemplateCreateRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function create(MessageTemplateCreateRequest $request)
    {
        $messageTemplate = $this->messageTemplateRepository->create($request->all());
        return $this->createdResponse($messageTemplate);
    }

    /**
     * Update a existing template.
     *
     * @param MessageTemplateUpdateRequest $request
     * @param MessageTemplate $messageTemplate
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function update(MessageTemplateUpdateRequest $request, MessageTemplate $messageTemplate)
    {
        $messageTemplate = $this->messageTemplateRepository->update($messageTemplate->id, $request->all());
        return $this->okResponse($messageTemplate);
    }

    /**
     * Delete a template.
     *
     * @param MessageTemplateDeleteRequest $request
     * @param MessageTemplate $messageTemplate
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function delete(MessageTemplateDeleteRequest $request, MessageTemplate $messageTemplate)
    {
        $this->messageTemplateRepository->delete($messageTemplate->id);
        return $this->noContentResponse();
    }
}
