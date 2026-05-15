<?php

namespace Flex\Core\Controllers;

use Flex\Core\Routing\View;
use Flex\Models\Role;
use Flex\Models\Permission;

class RoleController extends BaseController
{
    public function create()
    {
        $permissions = Permission::all()->groupBy('module');

        $this->render(View::make('admin/users/roles/form', [
            'title' => 'Нова роля',
            'permissions' => $permissions
        ], 'admin'));
    }

    public function store()
    {
        $data = $this->getRoleDataFromRequest();
        $role = Role::create($data);

        if ($role) {
            $role->permissions()->sync($_POST['permissions'] ?? []);
        }

        View::redirect('/admin/users?tab=roles');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy('module');

        $this->render(View::make('admin/users/roles/form', [
            'title' => 'Редактиране на роля: ' . $role->name,
            'role' => $role,
            'permissions' => $permissions
        ], 'admin'));
    }

    public function update($id)
    {
        $role = Role::findOrFail($id);
        $data = $this->getRoleDataFromRequest();

        $role->update($data);
        $role->permissions()->sync($_POST['permissions'] ?? []);

        View::redirect('/admin/roles/edit/' . $id);
    }

    private function getRoleDataFromRequest(): array
    {
        $rawSchedule = $_POST['schedule'] ?? [];
        $filteredSchedule = [];

        if (isset($_POST['has_time_limit'])) {
            foreach ($rawSchedule as $dayNum => $data) {
                if (isset($data['active'])) {
                    $filteredSchedule[$dayNum] = [
                        'start' => $data['start'] ?? '09:00',
                        'end' => $data['end'] ?? '18:00'
                    ];
                }
            }
        }

        return [
            'name' => $_POST['name'] ?? '',
            'slug' => $_POST['slug'] ?? '',
            'description' => $_POST['description'] ?? '',
            'priority' => (int) ($_POST['priority'] ?? 0),
            'color' => $_POST['color'] ?? '#6366f1',
            'is_active' => isset($_POST['is_active']),
            'is_default' => isset($_POST['is_default']),
            'options' => [
                'schedule' => $filteredSchedule
            ]
        ];
    }
}
