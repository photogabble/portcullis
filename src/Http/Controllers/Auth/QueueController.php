<?php

namespace Photogabble\Portcullis\Http\Controllers\Auth;

use Photogabble\Portcullis\Entities\RegistrationQueue;
use Photogabble\Portcullis\Http\Controllers\Controller;
use Photogabble\Portcullis\Http\Requests\RegistrationQueueRequest;
use Illuminate\Support\MessageBag;

class QueueController extends Controller
{
    public function store(RegistrationQueueRequest $request)
    {
        $messageBag = new MessageBag();
        $request->persist($messageBag);
        return view('auth.queue-success', ['model' => $request->model(), 'queueLength' => RegistrationQueue::query()->count('id')]);
    }
}
