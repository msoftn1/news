<?php


namespace App\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Базовый класс логгера.
 */
class BaseLogger extends Logger
{
    /**
     * Конструктор.
     */
    public function __construct()
    {
        $name = 'logger';
        parent::__construct($name);

        $this->init('logs/app.log');
    }

    /**
     * Инициализация обработчиков логов.
     *
     * @param string $path
     */
    public function init(string $path): void
    {
        $this->pushHandler(new StreamHandler(storage_path($path)), Logger::ERROR);
        $this->pushHandler(new StreamHandler('php://stdout', Logger::INFO));
    }

    /**
     * {@inheritDoc}
     */
    public function debug($message, array $context = array()): void
    {
        parent::debug($message, $context);
    }
}
