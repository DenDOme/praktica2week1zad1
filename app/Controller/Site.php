<?php
namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Model\Employee;
use Model\Department;

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
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function employee(Request $request): string 
    {
        $departments = Department::all();
        $users = User::all();
        if($request->method === 'POST' && Employee::create($request->all())){
            app()->route->redirect('/employee');
        }
        return new View('site.employee', ['departments' => $departments , 'users' => $users]);
    }

    public function department(Request $request): string 
    {
        if($request->method === 'POST' && Department::create($request->all())){
            app()->route->redirect('/department');
        }
        return new View('site.department');
    }

    public function employee_list(Request $request): string
    {   
        $departments = Department::all();
        
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
            $id = $temp['DepartmentID'];
            if (!empty($id)) {
                app()->route->redirect('/employee-list?id=' . $id);
            } else {
                app()->route->redirect('/employee-list');
            }
        }

        if (array_key_exists('id', $request->all())) {
            $id = $request->id;
            $employees = Employee::where('DepartmentID', $id)->get();

            $srvozrast = __calculateAge($employees);
            return (new View())->render('site.employee-list', ['employees' => $employees, 'departments' => $departments, 'srvozrast' => $srvozrast]);
        } else {
            $employees = Employee::all();
            $srvozrast = __calculateAge($employees);
        }

        return new View('site.employee-list', ['employees' => $employees, 'departments' => $departments, 'srvozrast' => $srvozrast]);
    }
}
