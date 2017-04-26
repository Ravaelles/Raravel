<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
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

        // === Blade ===========================================================
        // Bootstrap tooltip
        Blade::directive('tooltip', function($expression) {
            $params = $this->getParamsFromExpression($expression);

            $message = $params[0];
            $align = @$params[1];
            $location = @$params[2];

            if (!empty($align) || strlen($message) > 50) {
                if (empty($align)) {
                    $align = '';
                }
            }

            if (empty($location)) {
                $location = 'bottom';
            }

            $phpCode = " data-toggle=\"tooltip\" data-placement=\"$location\" title=\"$message\" ";

            return $phpCode;
        });
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

    private function getParamsFromExpression($expression)
    {
        $expression = \App\Helpers\Helper::substring($expression, 1, 1);
        $params = explode("', '", $expression);
        return $params;
    }

}
