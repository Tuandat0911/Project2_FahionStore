<?php

namespace App\Services;

use App\Policies\CategoryPolicy;
use App\Policies\OrderPolicy;
use App\Policies\SizePolicy;
use App\Policies\SliderPolicy;
use App\Policies\SettingPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\MenuPolicy;
use App\Policies\InventoryPolicy;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess {
    public function setGateAndPolicyAccess()  {
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->definceGateSlider();
        $this->defineGateSetting();
        $this->defineGateRole();
        $this->defineGateUser();
        $this->defineGateSize();
        $this->defineGateOrder();
        $this->defineGateInventory();
    }

    public function defineGateCategory() {
        Gate::define('category_list', [CategoryPolicy::class, 'view']);
        Gate::define('category_add', [CategoryPolicy::class, 'create']);
        Gate::define('category_edit', [CategoryPolicy::class, 'update']);
        Gate::define('category_delete', [CategoryPolicy::class, 'delete']);
    }

    public function defineGateMenu() {
        Gate::define('menu_list', [MenuPolicy::class, 'view']);
        Gate::define('menu_add', [MenuPolicy::class, 'create']);
        Gate::define('menu_edit', [MenuPolicy::class, 'update']);
        Gate::define('menu_delete', [MenuPolicy::class, 'delete']);
    }

    public function definceGateSlider() {
        Gate::define('slider_list', [SliderPolicy::class, 'view']);
        Gate::define('slider_add', [SliderPolicy::class, 'create']);
        Gate::define('slider_edit', [SliderPolicy::class, 'update']);
        Gate::define('slider_delete', [SliderPolicy::class, 'delete']);
    }

    public function defineGateSetting() {
        Gate::define('setting_list', [SettingPolicy::class, 'view']);
        Gate::define('setting_add', [SettingPolicy::class, 'create']);
        Gate::define('setting_edit', [SettingPolicy::class, 'update']);
        Gate::define('setting_delete', [SettingPolicy::class, 'delete']);
    }

    public function defineGateRole() {
        Gate::define('role_list', [RolePolicy::class, 'view']);
        Gate::define('role_add', [RolePolicy::class, 'create']);
        Gate::define('role_edit', [RolePolicy::class, 'update']);
        Gate::define('role_delete', [RolePolicy::class, 'delete']);
    }

    public function defineGateUser() {
        Gate::define('user_list', [UserPolicy::class, 'view']);
        Gate::define('user_add', [UserPolicy::class, 'create']);
        Gate::define('user_edit', [UserPolicy::class, 'update']);
        Gate::define('user_delete', [UserPolicy::class, 'delete']);
    }

    public function defineGateSize() {
        Gate::define('size_list', [SizePolicy::class, 'view']);
        Gate::define('size_add', [SizePolicy::class, 'create']);
        Gate::define('size_edit', [SizePolicy::class, 'update']);
        Gate::define('size_delete', [SizePolicy::class, 'delete']);
    }

    public function defineGateOrder() {
        Gate::define('order_list', [OrderPolicy::class, 'view']);
        Gate::define('order_edit', [OrderPolicy::class, 'update']);
    }

    public function defineGateInventory() {
        Gate::define('inventory_list', [InventoryPolicy::class, 'view']);
        Gate::define('inventory_add', [InventoryPolicy::class, 'create']);
    }
}
