<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\LeadAddService;
use App\Services\SendingToTelegramService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(private LeadAddService $leadAddService, private SendingToTelegramService $telegramService)
    {
    }

    public function openForm(): Factory|View|Application
    {
        return view('createUser');
    }

    public function createUser(UserFormRequest $request): RedirectResponse
    {
        $data = $request->all();

        User::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'surname' => $data['surname'],
            'birthday' => $data['birthday'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'comment' => $data['comment']
        ]);

        $status = $this->leadAddService->addLead($data);

        $this->telegramService->sendingToTelegram($status, $data);

        return back();
    }
}
