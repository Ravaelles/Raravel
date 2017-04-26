<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Project;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $project = $this->getProjectFromUrl();
        View::share('currentProject', $project);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    // =========================================================================

    protected function getProjectFromUrl()
    {
        $projectName = \Illuminate\Support\Facades\Request::segment(2);
        if ($projectName == null) {
            return null;
        } else {
            return Project::getProjectByName($projectName);
        }
    }

}
