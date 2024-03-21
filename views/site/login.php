<h2 class="text-center text-4xl my-12">Авторизация</h2>
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php if (!app()->auth::check()): ?>
   <form method="post" class="flex flex-col items-center max-w-xs border-2 border-blue-700 rounded-xl mx-auto mt-5 p-5 gap-2.5">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
       <label class="flex flex-col gap-1 items-center">Логин <input  class="h-10 w-40 bg-gray-200" type="text" name="login"></label>
       <label class="flex flex-col gap-1 items-center">Пароль <input class="h-10 w-40 bg-gray-200" type="password" name="password"></label>
       <button class="bg-blue-500 w-40 h-10 text-white text-xl font-bold">Войти</button>
   </form>
<?php endif;