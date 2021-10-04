<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('name')->paginate(2);
        return Inertia::render('Departments/Index', [
            'departments'  => $departments
        ]);
    }
}