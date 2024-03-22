<h2 class="text-center text-4xl my-12">Регистрация нового сотрудника</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post" enctype="multipart/form-data" class="flex flex-col items-center max-w-xs border-2 border-blue-700 rounded-xl mx-auto mt-5 p-5 gap-2.5">
   <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
   <label class="flex flex-col gap-1 items-center">Имя<input class="h-10 w-60 bg-gray-200" type="text" name="FirstName"></label>
   <label class="flex flex-col gap-1 items-center">Фамилия<input class="h-10 w-60 bg-gray-200" type="text" name="LastName"></label>
   <label class="flex flex-col gap-1 items-center">Отчество<input class="h-10 w-60 bg-gray-200" type="text" name="MiddleName"></label>
   <label class="flex flex-col gap-1 items-center">Пол
      <select class="h-10 w-60 bg-gray-200" name="Gender">
         <option value="">Выберите отдел</option>
         <option value="Male">Мужчина</option>
         <option value="Female">Выберите отдел</option>

      </select>
   </label>
   <label class="flex flex-col gap-1 items-center">Дата рождения<input class="h-10 w-60 bg-gray-200" type="date" name="DateOfBirth"></label>
   <label class="flex flex-col gap-1 items-center">Адрес<input class="h-10 w-60 bg-gray-200" type="text" name="Address"></label>
   <label class="flex flex-col gap-1 items-center">Состав
      <select class="h-10 w-60 bg-gray-200" name="CompoundID">
         <option value="">Выберите состав</option>
         <?php foreach($compounds as $compound): ?>
            <option value="<?= $compound->getId() ?>"><?= $compound->CompoundName ?></option>
         <?php endforeach; ?>
      </select>
   </label>
   <label class="flex flex-col gap-1 items-center">Сотрудники
      <select class="h-10 w-60 bg-gray-200" name="PositionID">
         <option value="">Выберите должность</option>
         <?php foreach($positions as $position): ?>
            <option value="<?= $position->getId() ?>"><?= $position->PositionName ?></option>
         <?php endforeach; ?>
      </select>
   </label>
   <label class="flex flex-col gap-1 items-center">Отдел
      <select class="h-10 w-60 bg-gray-200" name="DepartmentID">
         <option value="">Выберите отдел</option>
         <?php foreach($departments as $department): ?>
            <option value="<?= $department->getId() ?>"><?= $department->DepartmentName ?></option>
         <?php endforeach; ?>
      </select>
   </label>
   <label class="flex flex-col gap-1 items-center">Пользователи
      <select class="h-10 w-60 bg-gray-200" name="UserRoleID">
         <option value="">Выберите пользователя</option>
         <?php foreach($users as $user): ?>
            <option value="<?= $user->getId() ?>"><?= $user->name ?></option>
         <?php endforeach; ?>
      </select>
   </label>
   <label class="flex flex-col gap-1 items-center">Изображение <input class="h-10 w-60 bg-gray-200" type="file" name="Image"></label>
   <button class="bg-blue-500 w-60 h-10 text-white text-xl font-bold">Зарегистрироваться</button>
</form>