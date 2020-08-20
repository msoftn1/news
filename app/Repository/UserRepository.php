<?php


namespace App\Repository;

use App\User;

/**
 * Репозитории пользователей.
 */
class UserRepository extends BaseRepository
{
    /**
     * Конструктор.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Первый пользователь у которого есть API токен.
     *
     * @return User|null
     */
    public function getFirstUserWithApiToken(): ?User
    {
        return $this->model->newQuery()
            ->whereNotNull('api_token')
            ->first();
    }

    /**
     * Наличие пользователя.
     *
     * @param string $email
     * @return bool
     */
    public function checkUser(string $email): bool
    {
        return $this->model->newQuery()
            ->where('email', $email)
            ->exists();
    }
}
