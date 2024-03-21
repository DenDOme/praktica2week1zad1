<h2 class="text-center text-4xl my-12">Регистрация нового пользователя</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post" class="flex flex-col max-w-xs border-2 border-blue-700 rounded-3xl mx-auto mt-5 p-5 gap-2.5">
   <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
   <label class="flex flex-col gap-1 items-center" >Имя <input class="h-10 w-60 bg-gray-200" type="text" name="name"></label>
   <label class="flex flex-col gap-1 items-center" >Логин <input class="h-10 w-60 bg-gray-200" type="text" name="login"></label>
   <label class="flex flex-col gap-1 items-center" >Пароль <input class="h-10 w-60 bg-gray-200" type="password" name="password"></label>
   <button class="bg-blue-500 w-60 h-10 text-white text-xl font-bold mx-auto">Зарегистрироваться</button>
</form>