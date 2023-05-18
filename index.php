<?php
require_once 'vendor/autoload.php';
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\Inline\InlineKeyboardButton;

$bot = new \TelegramBot\Api\Client('6107040954:AAFEHayVPz39VHKYsiJseEkXpM9bMAdDOEk');
$bot->command('start', function ($message) use ($bot) {
    $keyboard = new InlineKeyboardMarkup([
        [new InlineKeyboardButton('Kanalga obuna bo\'ling', 'https://t.me/kunuzofficial')],
        [new InlineKeyboardButton('Kalkulyator', 'calculator')]
    ]);

    $bot->sendMessage($message->getChat()->getId(), 'Assalomu aleykum.', null, false, null, $keyboard);
});

$bot->on(function ($update) use ($bot) {
    $callback = $update->getCallbackQuery();
    if ($callback !== null && $callback->getData() === 'calculator') {
        $keyboard = new InlineKeyboardMarkup([
            [new InlineKeyboardButton('6 oy', 'six_months')],
            [new InlineKeyboardButton('12 oy', 'twelve_months')]
        ]);

        $bot->editMessageText($callback->getMessage()->getChat()->getId(), $callback->getMessage()->getMessageId(), 'Davomiyligi qancha muddatga olasiz?', null, false, $keyboard);
    }
});

$bot->on(function ($update) use ($bot) {
    $callback = $update->getCallbackQuery();
    if ($callback !== null && $callback->getData() === 'six_months') {
        $bot->sendMessage($callback->getMessage()->getChat()->getId(), 'Summani kiriting:');
        $bot->registerNextStepHandler($callback->getMessage(), 'calculate_six_months');
    }
});

$bot->on(function ($update) use ($bot) {
    $callback = $update->getCallbackQuery();
    if ($callback !== null && $callback->getData() === 'twelve_months') {
        $bot->sendMessage($callback->getMessage()->getChat()->getId(), 'Summani kiriting:');
        $bot->registerNextStepHandler($callback->getMessage(), 'calculate_twelve_months');
    }
});

$bot->onText(function ($message) use ($bot) {
    if ($message->getReplyToMessage() !== null) {
        if ($message->getReplyToMessage()->getText() === 'Summani kiriting:') {
            $amount = floatval($message->getText());
            if ($amount !== false) {
                if ($message->getReplyToMessage()->getCallbackQuery()->getData() === 'calculate_six_months') {
                    $amount_with_interest = $amount * 1.20 * 1.26 / 6;
                    $installment = round($amount_with_interest / 1, 2);
                    $formatted_installment = number_format($installment, 2, '.', ' ');
                    $bot->sendMessage($message->getChat()->getId(), "6 oylik tolov $formatted_installment sum.\n\nBosh menuga qaytish uchun /start ni bosing");
                    $bot->sendMessage($message->getChat()->getId(), '⬅️ Orqaga qaytish uchun', null, false, null, new InlineKeyboardMarkup([
                        [new InlineKeyboardButton('⬅️ Orqaga', 'calculator')]
                    ]));
                } elseif ($message->getReplyToMessage()->getCallbackQuery()->getData() === 'calculate_twelve_months') {
                    $amount_with_interest = $amount * 1.20 * 1.44 / 12;
                    $installment = round($amount_with_interest / 1, 2);
                    $formatted_installment = number_format($installment, 2, '.', ' ');
                    $bot->sendMessage($message->getChat()->getId(), "12 oylik tolov $formatted_installment sum.\n\nBosh menuga qaytish uchun /start ni bosing");
                    $bot->sendMessage($message->getChat()->getId(), '⬅️ Orqaga qaytish uchun', null, false, null, new InlineKeyboardMarkup([
                        [new InlineKeyboardButton('⬅️ Orqaga', 'calculator')]
                    ]));
                }
            } else {
                $bot->sendMessage($message->getChat()->getId(), 'Yaroqli raqam kiriting.');
            }
        }
    }
});

$bot->run();
