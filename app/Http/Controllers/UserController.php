<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\LeadService;
use App\Services\TelegramService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(private LeadService $leadService, private TelegramService $telegramService)
    {
    }

    public function openForm(): Factory|View|Application
    {
        return view('createUser');
    }

    public function createUser(UserFormRequest $request): RedirectResponse
    {
        $data = $request->all();

        User::create($data);

        $message = $this->leadService->addLead($data);

        if (empty($message)) {
            $message = $this->telegramService->createMessage($data);
        }

        $this->telegramService->sendingToTelegram($message);

        return back();
    }
}
