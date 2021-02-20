# permission


publish provider

php artisan vendor:publish --provider=GovindTomar\Permission\PermissionServiceProvider

Add middleware

'permission' => \App\Http\Middleware\AccessPermissionMiddleware::class,


Add in User Table 

$table->unsignedBigInteger('role_id')->default(3);
$table->foreign('role_id')->references('id')->on('roles');


Add in each controller

public function __construct(){
    $this->middleware(['web', 'permission']);
}
