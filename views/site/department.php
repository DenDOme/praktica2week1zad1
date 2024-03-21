<h2 class="text-center text-4xl my-12">Регистрация нового Департамента</h2>
<h3 class=""><?= $message ?? ''; ?></h3>
<form method="post" class="flex flex-col items-center max-w-xs border-2 border-blue-700 rounded-xl mx-auto mt-5 p-5 gap-2.5">
   <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
   <label class="flex flex-col gap-1 items-center">Название<input class="h-10 w-60 bg-gray-200" type="text" name="DepartmentName"></label>
   <label class="flex flex-col gap-1 items-center">Тип<input class="h-10 w-60 bg-gray-200" type="text" name="DepartmentType"></label>
   <button class="bg-blue-500 w-60 h-10 text-white text-xl font-bold">Зарегистрироваться</button>
</form>