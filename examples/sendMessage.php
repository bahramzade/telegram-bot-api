#!/usr/bin/env php
<?php

require dirname(__DIR__).'/vendor/autoload.php';

use Steelbot\TelegramBotApi\Api;
use Icicle\Loop;
use Steelbot\TelegramBotApi\Method\SendMessage;

if (!getenv('BOT_TOKEN')) {
    echo "Error: BOT_TOKEN environment variable not found\n";
    printf("Usage:\n  BOT_TOKEN=123:telegram_bot_token ./%s\n", basename(__FILE__));
    exit(-1);
}

$generator = function (): \Generator {
    $api = new Api(getenv('BOT_TOKEN'));
    $method = new SendMessage('104442434', 'Hello, world!');

    $message = yield from $api->execute($method);

    echo "Message was sent:\n";
    print_r($message);
};

$coroutine = new \Icicle\Coroutine\Coroutine($generator());
$coroutine->done(null, function (\Throwable $exception) {
    echo "Exception catched:\n";
    echo "    Code: {$exception->getCode()}\n";
    echo "    Message: {$exception->getMessage()}\n";
    echo "    File: {$exception->getFile()}\n";
    echo "    Line: {$exception->getLine()}\n";
});

Loop\run();
