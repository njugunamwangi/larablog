<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\OurSocial;
use App\Models\TextWidget;
use App\Policies\ActivityPolicy;
use App\Policies\OurSocialPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\TextWidgetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        TextWidget::class => TextWidgetPolicy::class,
        OurSocial::class => OurSocialPolicy::class,
        Activity::class => ActivityPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
