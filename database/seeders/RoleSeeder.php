<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('group_permissions')->truncate();

        // Default value
        $default = [
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Role
        $role = [
            [
                'name' => 'Supper-admin',
                'default_name' => 'Quản trị viên cấp cao',
            ],
            [
                'name' => 'admin',
                'default_name' => 'Quản trị viên',
            ],
        ];

        $permission = [
            //1
            [
                'name' => 'List-orders',
                'default_name' => 'Xem danh sách đơn hàng',
                'group_id' => 1,
                'order' => 1
            ],
            //2
            [
                'name' => 'View-orders',
                'default_name' => 'Xem chi tiết đơn hàng',
                'group_id' => 1,
                'order' => 2
            ],
            //3
            [
                'name' => 'Edit-orders',
                'default_name' => 'Chỉnh sửa đơn hàng',
                'group_id' => 1,
                'order' => 3
            ],
            //4
            [
                'name' => 'Delete-orders',
                'default_name' => 'Xóa đơn hàng',
                'group_id' => 1,
                'order' => 4
            ],
            //5
            [
                'name' => 'List-clients',
                'default_name' => 'Xem danh sách khách hàng',
                'group_id' => 2,
                'order' => 1
            ],
            //6
            [
                'name' => 'View-clients',
                'default_name' => 'Xem chi tiết khách hàng',
                'group_id' => 2,
                'order' => 2
            ],
            //7
            [
                'name' => 'Delete-clients',
                'default_name' => 'Xóa khách hàng',
                'group_id' => 2,
                'order' => 3
            ],
            //8
            [
                'name' => 'List-users',
                'default_name' => 'Xem danh sách nhân sự',
                'group_id' => 3,
                'order' => 1
            ],
            //9
            [
                'name' => 'Create-users',
                'default_name' => 'Tạo nhân sự',
                'group_id' => 3,
                'order' => 2
            ],
            //10
            [
                'name' => 'Edit-users',
                'default_name' => 'Chỉnh sửa nhân sự',
                'group_id' => 3,
                'order' => 3
            ],
            //11
            [
                'name' => 'Delete-users',
                'default_name' => 'Xóa nhân sự',
                'group_id' => 3,
                'order' => 4
            ],
            //12
            [
                'name' => 'List-products',
                'default_name' => 'Xem danh sách sản phẩm',
                'group_id' => 4,
                'order' => 1
            ],
            //13
            [
                'name' => 'Create-products',
                'default_name' => 'Tạo sản phẩm',
                'group_id' => 4,
                'order' => 2
            ],
            //14
            [
                'name' => 'Edit-products',
                'default_name' => 'Chỉnh sửa sản phẩm',
                'group_id' => 4,
                'order' => 3
            ],
            //15
            [
                'name' => 'Delete-products',
                'default_name' => 'Xóa sản phẩm',
                'group_id' => 4,
                'order' => 4
            ],
            //16
            [
                'name' => 'List-categories',
                'default_name' => 'Xem danh sách danh mục',
                'group_id' => 5,
                'order' => 1
            ],
            //17
            [
                'name' => 'Create-categories',
                'default_name' => 'Tạo danh mục',
                'group_id' => 5,
                'order' => 2
            ],
            //18
            [
                'name' => 'Edit-categories',
                'default_name' => 'Chỉnh sửa danh mục',
                'group_id' => 5,
                'order' => 3
            ],
            //19
            [
                'name' => 'Delete-categories',
                'default_name' => 'Xóa danh mục',
                'group_id' => 5,
                'order' => 4
            ],
        ];
        $roleHasPermission = [
            // Super-admin|Admin|
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 2, 'permission_id' => 1],

            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 2, 'permission_id' => 2],

            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 2, 'permission_id' => 3],

            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 2, 'permission_id' => 5],

            ['role_id' => 1, 'permission_id' => 6],
            ['role_id' => 2, 'permission_id' => 6],

            ['role_id' => 1, 'permission_id' => 8],
            ['role_id' => 2, 'permission_id' => 8],

            ['role_id' => 1, 'permission_id' => 12],
            ['role_id' => 2, 'permission_id' => 12],

            ['role_id' => 1, 'permission_id' => 13],
            ['role_id' => 2, 'permission_id' => 13],

            ['role_id' => 1, 'permission_id' => 14],
            ['role_id' => 2, 'permission_id' => 14],

            ['role_id' => 1, 'permission_id' => 16],
            ['role_id' => 2, 'permission_id' => 16],

            ['role_id' => 1, 'permission_id' => 17],
            ['role_id' => 2, 'permission_id' => 17],

            ['role_id' => 1, 'permission_id' => 18],
            ['role_id' => 2, 'permission_id' => 18],

            //Super-admin
            ['role_id' => 1, 'permission_id' => 4],
            ['role_id' => 1, 'permission_id' => 7],
            ['role_id' => 1, 'permission_id' => 9],
            ['role_id' => 1, 'permission_id' => 10],
            ['role_id' => 1, 'permission_id' => 11],
            ['role_id' => 1, 'permission_id' => 15],
            ['role_id' => 1, 'permission_id' => 19],
        ];

        $modelHasRole = [
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 1],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 2],
        ];

        $groupPermission = [
            ['name' => 'Quản lý đơn hàng', 'order' => 1],
            ['name' => 'Quản lý khách hàng', 'order' => 2],
            ['name' => 'Quản lý nhân sự', 'order' => 3],
            ['name' => 'Quản lý sản phẩm', 'order' => 4],
            ['name' => 'Quản lý danh mục', 'order' => 5],
        ];

        $roles = $permissions = $groupPermissions = [];
        foreach ($role as $roleItem) {
            $roles[] = array_merge($roleItem, $default);
        }

        foreach ($permission as $permissionItem) {
            $permissions[] = array_merge($permissionItem, $default);
        }

        foreach ($groupPermission as $groupPermissionItem) {
            $groupPermissions[] = array_merge($groupPermissionItem, $default);
        }

        DB::table('roles')->insert($roles);
        DB::table('permissions')->insert($permissions);
        DB::table('role_has_permissions')->insert($roleHasPermission);
        DB::table('model_has_roles')->insert($modelHasRole);
        DB::table('group_permissions')->insert($groupPermissions);

        Schema::enableForeignKeyConstraints();
    }
}
