<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateCreateRequest;
use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateUpdateRequest;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplateRepository;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function list(Request $request)
    {
        $templates = $this->messageTemplateRepository->list();
        return api()->ok($templates);
    }

    /**
     * Get a template.
     *
     * @param Request $request
     * @param MessageTemplate $messageTemplate
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show(Request $request, MessageTemplate $messageTemplate)
    {
        return api()->ok($messageTemplate);
    }

    /**
     * Create a new template.
     *
     * @param MessageTemplateCreateRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function create(MessageTemplateCreateRequest $request)
    {
        $messageTemplate = $this->messageTemplateRepository->create($request->validated());
        return api()->created($messageTemplate);
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
        $messageTemplate = $this->messageTemplateRepository->update($messageTemplate, $request->validated());
        return api()->ok($messageTemplate);
    }

    /**
     * Delete a template.
     *
     * @param Request $request
     * @param MessageTemplate $messageTemplate
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function delete(Request $request, MessageTemplate $messageTemplate)
    {
        $this->messageTemplateRepository->delete($messageTemplate);
        return api()->noContent();
    }
}
