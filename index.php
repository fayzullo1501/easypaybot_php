<?php

// Устанавливаем токен вашего бота
$token = "6107040954:AAFEHayVPz39VHKYsiJseEkXpM9bMAdDOEk";

// Получаем запросы от Telegram API
$update = json_decode(file_get_contents("php://input"), TRUE);

// Получаем идентификатор чата и сообщение
$chat_id = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

// Создаем функцию, которая отправляет сообщение пользователю
function sendMessage($chat_id, $text) {
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($text);
    file_get_contents($url);
}

// Создаем обработчик команды /start
if ($message == "/start") {
    // Создаем клавиатуру с двумя кнопками
    $keyboard = [
        ["Подписаться на канал"],
        ["Калькулятор"]
    ];

    // Конвертируем клавиатуру в JSON формат
    $reply_markup = json_encode([
        "keyboard" => $keyboard,
        "resize_keyboard" => true,
        "one_time_keyboard" => true
    ]);

    // Отправляем сообщение с клавиатурой
    sendMessage($chat_id, "Выберите действие:", $reply_markup);
}

// Создаем обработчик команды "Калькулятор"
else if ($message == "Калькулятор") {
    // Создаем клавиатуру с двумя кнопками
    $keyboard = [
        ["12 месяцев"],
        ["6 месяцев"]
    ];

    // Конвертируем клавиатуру в JSON формат
    $reply_markup = json_encode([
        "keyboard" => $keyboard,
        "resize_keyboard" => true,
        "one_time_keyboard" => true
    ]);

    // Отправляем сообщение с клавиатурой
    sendMessage($chat_id, "Выберите срок:", $reply_markup);
}

// Создаем обработчик команды "12 месяцев"
else if ($message == "12 месяцев") {
    // Отправляем сообщение с запросом суммы
    sendMessage($chat_id, "Введите сумму:");

    // Получаем сумму от пользователя
    $sum = $update["message"]["text"];

    // Рассчитываем результат по формуле
    $result = $sum * 20 * 44 / 12;

    // Отправляем сообщение с результатом
    sendMessage($chat_id, "Результат: " . $result);
}
// Создаем обработчик команды "6 месяцев"
else if ($message == "6 месяцев") {
    // Отправляем сообщение с запросом суммы
    sendMessage($chat_id, "Введите сумму:");
    
    // Получаем сумму от пользователя
    $sum = $update["message"]["text"];
    
    // Рассчитываем результат по формуле
    $result = $sum * 20 * 26 / 6;
    
    // Отправляем сообщение с результатом
    sendMessage($chat_id, "Результат: " . $result);
    }
    
    ?>