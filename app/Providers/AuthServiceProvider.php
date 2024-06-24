<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Services\PermissionGateAndPolicyAccess;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // define permission
        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess();
        $permissionGateAndPolicy->setGateAndPolicyAccess();

        $this->GateProduct();
    }


    public function GateProduct() {
        Gate::define('product_list', function($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-product'));
        });

        Gate::define('product_add', function($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-product'));
        });

        Gate::define('product_edit', function($user, $id) {
            $product = Product::find($id);
            if($user->checkPermissionAccess(config('permissions.access.edit-product')) && $user->id === $product->user_id) {
                return true;
            }
            return false;
        });

        Gate::define('product_delete', function($user, $id) {
            $product = Product::find($id);
            if($user->checkPermissionAccess(config('permissions.access.delete-product')) && $user->id === $product->user_id) {
                return true;
            }
            return false;
        });
    }
}
