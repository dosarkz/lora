# Dosmin backend module system for Laravel Framework 5.6
Features:
- Module System
- Module Generator with command
- Remove modules
- Default modules (superAdmin, role, image, article, menu )
- AdminLte template
- Upload image files with resize
- Visible modules for role

## Installation

- Install laravel 5.6
- Configure db
- Install admin package
`composer require dosarkz/dosmin`
- Make dosmin system
`php artisan admin:install`
- Go through all the necessary steps
- Visit `your_project/admin`
- and Be Happy!


## Make new module with command
`php artisan module:make {module name}`
- New modules created in app/Modules folder.
- After making add new provider to config/admin.php
`
 'providers' => [
            'user' =>  \App\Modules\User\Providers\UserServiceProvider::class,
            ...
        ]
`
- Visit new module on admin menu



## Module install 

`php artisan module:install {module name}`

This command consist of:
- Make publish files
- Run migrations and seeder 

