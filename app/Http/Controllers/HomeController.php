<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Document;
use App\Department;
use App\Category;
use App\Log;

use  Spatie\Permission\Models\Role;
use  Spatie\Permission\Models\Permission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('documents.documents');
    }
    public function dashboard()
    {
        $users = User::get()->count();
        $documents = Document::get()->count();
        $departments = Department::get()->count();
        $categories = Category::get()->count();
        $logs = Log::get()->count();
        $roles = Role::get()->count();
        $permissions = Permission::get()->count();

        return view('dashboard')->with(compact('users', 'documents', 'departments', 'categories', 'logs', 'roles', 'permissions'));
    }
}
