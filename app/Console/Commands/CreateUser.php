<?php

namespace App\Console\Commands;

use App\Repository\UserRepository;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Команда создает пользователя.
 */
class CreateUser extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $signature = 'user:create {name} {email} {password}';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Create User';

    /** Репозиторий пользователей. */
    private UserRepository $userRepository;

    /**
     * Конструктор.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    /**
     * Обработчик команды.
     */
    public function handle(): void
    {
        if ($this->checkUser()) {
            $this->error('Пользователь с таким e-mail уже существует!');

            return;
        }

        $token = Str::random(60);
        $this->createUser($token);

        $this->line(sprintf('Пользователь успешно создан. Токен: %s', $token));
    }

    /**
     * Проверить существование пользователя.
     *
     * @return bool
     */
    private function checkUser(): bool
    {
        return $this->userRepository->checkUser($this->argument('email'));
    }

    /**
     * Создать пользователя.
     *
     * @param string $token
     * @return User
     */
    private function createUser(string $token): User
    {
        $user = $this->userRepository->create(
            [
                'name' => $this->argument('name'),
                'email' => $this->argument('email'),
                'password' => Hash::make($this->argument('password')),
                'api_token' => $token,
            ]
        );

        return $user;
    }

}
