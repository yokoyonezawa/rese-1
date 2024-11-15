<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Role and Permission models
    |--------------------------------------------------------------------------
    |
    | Here you can specify the models for your roles and permissions. 
    |
    */

    'models' => [
        'role' => \Spatie\Permission\Models\Role::class,
        'permission' => \Spatie\Permission\Models\Permission::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Table names
    |--------------------------------------------------------------------------
    |
    | Here you can specify the table names for your roles, permissions and the
    | pivot tables that connect models to their permissions.
    |
    */

    'table_names' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'model_has_roles' => 'model_has_roles',
        'model_has_permissions' => 'model_has_permissions',
        'role_has_permissions' => 'role_has_permissions',
    ],

    /*
    |--------------------------------------------------------------------------
    | Column names
    |--------------------------------------------------------------------------
    |
    | Here you can specify the column names for your roles and permissions. 
    | 
    | You can also specify a foreign key name for teams, if you are using teams
    | in your application.
    |
    */

    'column_names' => [
        'model_morph_key' => 'model_id',
        'role_morph_key' => 'role_id',
        'permission_morph_key' => 'permission_id',
        'team_foreign_key' => 'team_id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | You can enable or disable caching of the permissions.
    |
    */

    'cache' => [
        'store' => 'default',
        'key' => 'spatie.permission.cache',
        'lifetime' => 60,
    ],

    /*
    |--------------------------------------------------------------------------
    | Teams
    |--------------------------------------------------------------------------
    |
    | If your application uses teams, you can enable this option to allow roles
    | and permissions to be associated with teams.
    |
    */

    'teams' => false,
];
