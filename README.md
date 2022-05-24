https://snob.ru/indoc/tilda/1016864/images/tild6435-3536-4138-b264-336537656332__2022-04-28_225632.jpg

function get_user_info($link,$name)   
// получает инфо о юзере, запрос вида test.stbur.ru/user/user-3  <--"user-3" имя юзера


function create_user($link,$name,$pass,$info)
// создает юзера , запрос вида test.stbur.ru/create/user-5/pass_user5/Ulan-Ude%2030.11.2021

function delete_user($link,$name)
// выпиливает юзера по имени test.stbur.ru/delete/user-2
  

function update_user($link,$name,$pass,$info){
// изменени юзера . по сути то же что и create_user

function auth_user($link,$name,$pass)
// авторизация. Сравнивает пару логин-пароль, при успехе возвращает authorized и
// выдает токен

function isAuth проверяет авторизацию пользователя путем поиска токена в БД записанно ранее.
// авторизация. Сравнивает пару логин-пароль, при успехе возвращает authorized



