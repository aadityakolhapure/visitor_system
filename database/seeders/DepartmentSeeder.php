<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            'Human Resources',
            'Information Technology',
            'Finance',
            'Marketing',
            'Operations',
        ];

        foreach ($departments as $department) {
            Department::create(['name' => $department]);
        }
    }
}