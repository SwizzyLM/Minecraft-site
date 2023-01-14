<?php
class Config
{
    // Ваш секретный ключ (из настроек проекта в личном кабинете unitpay.ru )
    const SECRET_KEY = '97616210746236f9d5008c84a485495d';
    // Стоимость товара в руб.
    const ITEM_PRICE = 1;

    // Таблица начисления товара, например `users`
    const TABLE_ACCOUNT = 'buy';
    // Название поля из таблицы начисления товара по которому производится поиск аккаунта/счета, например `email`
    const TABLE_ACCOUNT_NAME = 'name';
    // Название поля из таблицы начисления товара которое будет увеличено на колличево оплаченого товара, например `sum`, `donate`
    const TABLE_ACCOUNT_DONATE= 'data';

    // Параметры соединения с бд
    // Хост
    const DB_HOST = 'localhost';
    // Имя пользователя
    const DB_USER = 'root';
    // Пароль
    const DB_PASS = 'rvkt8gS140pbTG5W0N9nyA29ZNFi5yGAw9qR1Go3';
    // Назывние базы
    const DB_NAME = 'sandpex';
    // номер порта(необязательно)
    const DB_PORT = '3306';

}