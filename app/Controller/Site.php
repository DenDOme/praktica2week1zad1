<?php
namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Model\Employee;
use Model\Department;
use Model\Position;
use Src\Validator\Validator;
use Model\Compound;

class Site
{
    public function index(Request $request): string
    {
        if (array_key_exists('id', $request->all())) {
            $id = $request->id;
            $posts = Post::where('id', $id)->get();

            return (new View())->render('site.post', ['posts' => $posts]);
        } else {
            $posts = Post::all();
        }
        return (new View())->render('site.post', ['posts' => $posts]);
    }

   public function hello(): string
   {
       return new View('site.hello', ['message' => 'hello working']);
   }

   public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
     
            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }   
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'login' => ['required'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.login',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Auth::attempt($request->all())) {
                app()->route->redirect('/hello');
            }
            
            else {
                return new View('site.login',
                    ['message' => 'Не правильный пароль или логин']);
            }
        
        }
        return new View('site.login', ['message' => '']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function employee(Request $request): string 
    {
        $departments = Department::all();
        $positions = Position::all();
        $compounds = Compound::all();
        $users = User::where('role', 'quest')->get();
        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'FirstName' => ['required'],
                'LastName' => ['required'],
                'MiddleName' => ['required'],
                'Gender' => ['required'],
                'DateOfBirth' => ['required', 'date'],
                'Address' => ['required'],
                'CompoundID' => ['required'],
                'PositionID' => ['required'],
                'DepartmentID' => ['required'],
                'UserRoleID' => ['required'],
                'Image' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'date' => 'Поле :date не может быть больше сегодня'
            ]);

            if($validator->fails()){
                return new View('site.employee', ['departments' => $departments, 'compounds' => $compounds , 'positions' => $positions, 'users' => $users, 'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $image = $request->file('Image');
            $image_name = $image['name'];
            $image_tmp = $image['tmp_name'] ;
            $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);

            $new_path = 'uploads/';
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex;
            move_uploaded_file($image_tmp, $new_path . $new_img_name);

            $employeeData = $request->all();
            $employeeData['Image'] = $new_path . $new_img_name;

            if (Employee::create($employeeData)) {
                $temp = $request->all();
                $id = $temp['UserRoleID'];
                $changeUser = User::where('UserRoleID', $id)->first();
                
                if ($changeUser) {
                    $changeUser->role = 'employee';
                    $changeUser->save();
                }
                app()->route->redirect('/employee');
            }

        }
        return new View('site.employee', ['departments' => $departments , 'compounds' => $compounds , 'positions' => $positions, 'users' => $users]);
    }

    public function department(Request $request): string 
    {
        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'DepartmentName' => ['required'],
                'DepartmentType' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.department', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if(Department::create($request->all())){
                app()->route->redirect('/department');
            }
        }
        return new View('site.department');
    }

    public function position(Request $request): string 
    {
        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'PositionName' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.position', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if(Position::create($request->all())){
                app()->route->redirect('/position');
            }
        }
        return new View('site.position');
    }

    public function compound(Request $request): string
    {
        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'CompoundName' => ['required'],
            ] , [
                'required' => 'Поле : field пусто',
            ]);

            if($validator->fails()){
                return new View('site.compound', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if(Compound::create($request->all())){
                app()->route->redirect('/compound');
            }
        }
        return new View('site.compound');
    }

    public function employee_list(Request $request): string
    {   
        $departments = Department::all();
        $compounds = Compound::all();
        $employees = Employee::all();
        function loadNames($employees)
        {
            foreach($employees as $emp){
                $positionID = $emp->PositionID;
                $positionName = Position::find($positionID);
                $emp->PositionName = $positionName->PositionName;

                $departmentID = $emp->DepartmentID;
                $departmentName = Department::find($departmentID);
                $emp->DepartmentName = $departmentName->DepartmentName;

                $compoundID = $emp->CompoundID;
                $compoundName = Compound::find($compoundID);
                $emp->CompoundName = $compoundName->CompoundName;
            }
            return $employees;
        }

        function __calculateAge($employees){
            $srvozrast = 0;
            $i = 0;
            foreach ($employees as $employee) {
                $dateOfBirth = $employee->DateOfBirth;
                $birthDate = new \DateTime($dateOfBirth);
                $currentDate = new \DateTime();
                $age = $currentDate->diff($birthDate)->y;
                $srvozrast += $age;
                $i += 1;
            }
            if($i === 0){
                return 0;
            }
            $srvozrast = $srvozrast / $i;
            return $srvozrast;
        }

        if($request->method === 'POST'){
            $temp = $request->all();
            $departmentid = $temp['DepartmentID'];
            $compoundtid = $temp['CompoundID'];
            
            if (!empty($departmentid) && !empty($compoundtid)) {
                app()->route->redirect('/employee-list?department=' . $departmentid . '&compound=' . $compoundtid);
            } elseif (!empty($departmentid)){
                app()->route->redirect('/employee-list?department=' . $departmentid);
            }  elseif (!empty($compoundtid)){
                app()->route->redirect('/employee-list?compound=' . $compoundtid);
            } 
            else {
                app()->route->redirect('/employee-list');
            }
        }
        if (array_key_exists('department', $request->all()) && array_key_exists('compound', $request->all())) {
            $department_id = $request->department;
            $compound_id = $request->compound;
            $employees = Employee::where('DepartmentID', $department_id)->where('CompoundID', $compound_id)->get();  

            $srvozrast = __calculateAge($employees);
            $employees = loadNames($employees);
            
            return (new View())->render('site.employee-list', ['employees' => $employees, 'compounds' => $compounds, 'departments' => $departments, 'srvozrast' => $srvozrast]);
        } elseif(array_key_exists('department', $request->all())){
            $department_id = $request->department;
            $employees = Employee::where('DepartmentID', $department_id)->get();  

            $srvozrast = __calculateAge($employees);
            $employees = loadNames($employees);
            
            return (new View())->render('site.employee-list', ['employees' => $employees, 'compounds' => $compounds, 'departments' => $departments, 'srvozrast' => $srvozrast]);
        } elseif(array_key_exists('compound', $request->all())){
            $compoun_id = $request->compound;
            $employees = Employee::where('CompoundID', $compoun_id)->get();  

            $srvozrast = __calculateAge($employees);
            $employees = loadNames($employees);
            
            return (new View())->render('site.employee-list', ['employees' => $employees, 'compounds' => $compounds, 'departments' => $departments, 'srvozrast' => $srvozrast]);
        } else {
            $employees = Employee::all();
            $srvozrast = __calculateAge($employees);
        }
        $srvozrast = __calculateAge($employees);
        $employees = loadNames($employees);
        return new View('site.employee-list', ['employees' => $employees, 'departments' => $departments, 'compounds' => $compounds, 'srvozrast' => $srvozrast]);
    }

    public function employee_find(Request $request): string
    {
        $employees = Employee::all();
        function loadNames($employees)
        {
            foreach($employees as $emp){
                $positionID = $emp->PositionID;
                $positionName = Position::find($positionID);
                $emp->PositionName = $positionName->PositionName;

                $departmentID = $emp->DepartmentID;
                $departmentName = Department::find($departmentID);
                $emp->DepartmentName = $departmentName->DepartmentName;

                $compoundID = $emp->CompoundID;
                $compoundName = Compound::find($compoundID);
                $emp->CompoundName = $compoundName->CompoundName;
            }
            return $employees;
        }

        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'Username' => ['required'],
            ], [
                'required' => 'Поле : field пусто',
            ]);

            if($validator->fails()){
                return new View('site.employee-find', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'employees' => $employees]);
            }
            
            $temp = $request->all();
            $name = $temp['Username'];


            $employees = Employee::where('FirstName', 'LIKE', "%$name%")->get();
            $employees = loadNames($employees);
            return new View('site.employee-find', ['message' => '', 'employees' => $employees]);
        }
        $employees = loadNames($employees);
        return new View('site.employee-find', ['message' => '', 'employees' => $employees]);
    }
}
