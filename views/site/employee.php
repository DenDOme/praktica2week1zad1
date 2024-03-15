<h2>Регистрация нового сотрудника</h2>
<form method="post">
   <label>Имя<input type="text" name="FirstName"></label>
   <label>Фамилия<input type="text" name="LastName"></label>
   <label>Отчество<input type="text" name="MiddleName"></label>
   <label>Пол
      <select name="Gender">
         <option value="">Выберите отдел</option>
         <option value="Male">Мужчина</option>
         <option value="Female">Выберите отдел</option>

      </select>
   </label>
   <label>Дата рождения<input type="date" name="DateOfBirth"></label>
   <label>Адрес<input type="text" name="Address"></label>
   <label>Прописка<input type="text" name="Position"></label>
   <label>Отдел
      <select name="DepartmentID">
         <option value="">Выберите отдел</option>
         <?php foreach($departments as $department): ?>
            <option value="<?= $department->getId() ?>"><?= $department->DepartmentName ?></option>
         <?php endforeach; ?>
      </select>
   </label>
   <label>Сотрудники
      <select name="UserRoleID">
         <option value="">Выберите сотрудника</option>
         <?php foreach($users as $user): ?>
            <option value="<?= $user->getId() ?>"><?= $user->name ?></option>
         <?php endforeach; ?>
      </select>
   </label>
   <button>Зарегистрироваться</button>
</form>