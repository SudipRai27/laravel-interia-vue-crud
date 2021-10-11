<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\Department\DepartmentStoreRequest;
use App\Http\Requests\Department\DepartmentUpdateRequest;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Department::class);
    }

    public function index()
    {
        $departments = Department::orderBy('created_at', 'DESC')
            ->paginate(10)
            ->through(function ($department) {
                return  [
                    'id' => $department->id,
                    'name' => $department->name,
                    'email' => $department->email,
                    'slug' => $department->slug,
                    'can' => [
                        'delete' => auth()->user()->can('delete', $department),
                        'update' => auth()->user()->can('update', $department)
                    ]
                ];
            });

        return Inertia::render('Departments/Index', [
            'departments'  => $departments,
            'can' => [
                'create' => auth()->user()->can('create', Department::class),
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Departments/Create');
    }

    public function edit(Department $department)
    {
        return Inertia::render('Departments/Edit', [
            'department' => $department
        ]);
    }

    public function store(DepartmentStoreRequest $request)
    {
        Department::create($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department Stored Successfully');
    }

    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $department->update($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department Updated Successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department Deleted Successfully');
    }
}