<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_token","view_any_token","create_token","update_token","restore_token","restore_any_token","replicate_token","reorder_token","delete_token","delete_any_token","force_delete_token","force_delete_any_token","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","impersonate_user","page_ManageGeneral","page_Themes","page_MyProfilePage","view_film","view_any_film","create_film","update_film","restore_film","restore_any_film","replicate_film","reorder_film","delete_film","delete_any_film","force_delete_film","force_delete_any_film","view_genre","view_any_genre","create_genre","update_genre","restore_genre","restore_any_genre","replicate_genre","reorder_genre","delete_genre","delete_any_genre","force_delete_genre","force_delete_any_genre","view_schedule","view_any_schedule","create_schedule","update_schedule","restore_schedule","restore_any_schedule","replicate_schedule","reorder_schedule","delete_schedule","delete_any_schedule","force_delete_schedule","force_delete_any_schedule","view_studio","view_any_studio","create_studio","update_studio","restore_studio","restore_any_studio","replicate_studio","reorder_studio","delete_studio","delete_any_studio","force_delete_studio","force_delete_any_studio","page_Ticket","page_MyTicket"]},{"name":"admin","guard_name":"web","permissions":["view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","impersonate_user","page_Themes","page_MyProfilePage","view_film","view_any_film","create_film","update_film","restore_film","restore_any_film","replicate_film","reorder_film","delete_film","delete_any_film","force_delete_film","force_delete_any_film","view_genre","view_any_genre","create_genre","update_genre","restore_genre","restore_any_genre","replicate_genre","reorder_genre","delete_genre","delete_any_genre","force_delete_genre","force_delete_any_genre","view_schedule","view_any_schedule","create_schedule","update_schedule","restore_schedule","restore_any_schedule","replicate_schedule","reorder_schedule","delete_schedule","delete_any_schedule","force_delete_schedule","force_delete_any_schedule","view_studio","view_any_studio","create_studio","update_studio","restore_studio","restore_any_studio","replicate_studio","reorder_studio","delete_studio","delete_any_studio","force_delete_studio","force_delete_any_studio","page_Ticket"]},{"name":"user","guard_name":"web","permissions":["page_Themes","page_MyProfilePage","page_MyTicket"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
