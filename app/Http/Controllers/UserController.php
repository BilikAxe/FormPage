<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\BitrixService;
use App\Services\TelegramService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(private BitrixService $bitrixService, private TelegramService $telegramService)
    {
    }

    /**
     * Открывает страницу с формой
     * @return Factory|View|Application
     */
    public function openForm(): Factory|View|Application
    {
        return view('createUser');
    }

    /**
     * Создает модель пользователя и сохраняет в базу данных
     * @param UserFormRequest $request принимает данные из формы
     * @return RedirectResponse после отправки данных формы возвращается на страницу с формой
     */
    public function createUser(UserFormRequest $request): RedirectResponse
    {
        $data = $request->all();

        User::create($data);

        $message = $this->bitrixService->addLead($data);

        if (empty($message)) {
            $message = $this->telegramService->createMessage($data);
        }

        $this->telegramService->sendingToTelegram($message);

        return back();
    }
}
