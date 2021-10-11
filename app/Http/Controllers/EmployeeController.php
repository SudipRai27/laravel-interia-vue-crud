<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::with('department')
            ->when($request->has('department_id'), function ($query) use ($request) {
                if (is_null($request->department_id)) {
                    return;
                }
                return $query->where('department_id', $request->department_id);
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->through(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'email' => $employee->email,
                    'phone' => $employee->phone,
                    'department' => $employee->department->name ?? null
                ];
            });

        return Inertia::render('Employees/Index', [
            'employees' => $employees,
            'departments' => function () {
                return Department::orderBy('created_at')
                    ->get()
                    ->transform(function ($department) {
                        return  [
                            'id' => $department->id,
                            'name' => $department->name
                        ];
                    });
            },
            'department_id' => $request->department_id ?? ''
        ]);
    }

    public function create()
    {
        return Inertia::render('Employees/Create', [
            'departments' => Department::select('name', 'id')->get()
        ]);
    }

    public function store(EmployeeStoreRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with([
            'success' => 'Employee Created Successfully'
        ]);
    }

    public function edit(Employee $employee)
    {
        return Inertia::render('Employees/Edit', [
            'employee' => collect($employee->only('id', 'name', 'email', 'department_id', 'phone')),
            'departments' => Department::orderBy('created_at')
                ->get()
                ->transform(function ($department) {
                    return  [
                        'id' => $department->id,
                        'name' => $department->name
                    ];
                })
        ]);
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with([
            'success' => 'Employee updated successfully'
        ]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with([
            'success' => 'Employee deleted successfully'
        ]);
    }
}