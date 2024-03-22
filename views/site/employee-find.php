<div class="flex items-center max-w-[1200px] mx-auto justify-between mt-12 bg-gray-300 p-8">
    <form method="post" class="flex items-center gap-4">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="text" placeholder = "username" class="h-10 w-60 bg-gray-500 text-white px-2" name="Username">
        <button class="bg-blue-500 w-40 h-10 text-white font-bold">ПРИМЕНИТЬ</button>
    </form>
</div>

<div class="max-w-[1200px] mx-auto mt-10">
    <div class="flex justify-around mt-5 flex-wrap">
        <?php foreach($employees as $employee): ?>
        <div class="max-w-xs p-5 w-full flex flex-col items-center bg-gray-300">
            <div class="flex flex-col gap-2 items-center">Фото
                <img src="<?= $employee->Image ?>" alt="Photo" class="h-40 w-40 object-cover">
            </div>
            <div class="flex flex-col gap-2 items-center">Имя <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->FirstName ?></p></div>
            <div class="flex flex-col gap-2 items-center">Фамилия <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->LastName ?></p></div>
            <div class="flex flex-col gap-2 items-center">Отчество <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->MiddleName ?></p></div>
            <div class="flex flex-col gap-2 items-center">Пол <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->Gender ?></p></div>
            <div class="flex flex-col gap-2 items-center">Дата рождения <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->DateOfBirth ?></p></div>
            <div class="flex flex-col gap-2 items-center">Состав <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->CompoundName ?></p></div>
            <div class="flex flex-col gap-2 items-center">Адрес <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->Address ?></p></div>
            <div class="flex flex-col gap-2 items-center">Должность <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->PositionName ?></p></div>
            <div class="flex flex-col gap-2 items-center">Департамент <p class="h-10 w-40 bg-gray-500 text-center flex items-center justify-center text-white"><?= $employee->DepartmentName ?></p></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>