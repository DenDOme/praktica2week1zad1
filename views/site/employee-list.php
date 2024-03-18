<div class="flex items-center max-w-4xl mx-auto justify-between mt-5">
    <form method="post" class="flex items-center gap-1">
        <select class="h-10 w-60 bg-gray-200" name="DepartmentID">
            <option value="">Все сотрудники</option>
            <?php foreach($departments as $department): ?>
                <option value="<?= $department->getId() ?>"><?= $department->DepartmentName ?></option>
            <?php endforeach; ?>
        </select>
        <button class="bg-blue-500 w-40 h-10 text-white font-bold">Применить</button>
    </form>
    <div class="h-10 w-40 bg-gray-200 flex items-center justify-center">
        Средний возраст : <?= $srvozrast ?>
    </div>
</div>
<h1 class="text-center text-4xl">Все сотрудники</h1>
<div class="max-w-[1200px] mx-auto">
    <div class="flex gap-5 mt-5">
        <?php foreach($employees as $employee): ?>
        <div class="max-w-xs p-5 w-full rounded-3xl flex flex-col items-center border-2 border-gray-500 flex-wrap">
            <div class="flex flex-col gap-2 items-center">Имя <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->FirstName ?></p></div>
            <div class="flex flex-col gap-2 items-center">Фамилия <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->LastName ?></p></div>
            <div class="flex flex-col gap-2 items-center">Отчество <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->MiddleName ?></p></div>
            <div class="flex flex-col gap-2 items-center">Пол <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->Gender ?></p></div>
            <div class="flex flex-col gap-2 items-center">Дата рождения <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->DateOfBirth ?></p></div>
            <div class="flex flex-col gap-2 items-center">Адрес <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->Address ?></p></div>
            <div class="flex flex-col gap-2 items-center">Должность <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->Position ?></p></div>
            <div class="flex flex-col gap-2 items-center">Департамент <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->DepartmentID ?></p></div>
            <div class="flex flex-col gap-2 items-center">Сотрудники <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->UserRoleID ?></p></div>
            <button class="h-10 w-40 bg-blue-500 text-center flex items-center justify-center text-white mt-5 font-bold text-xl"> Редактировать</button>
        </div>
        <br>
        <br>
        <?php endforeach; ?>
    </div>
</div>