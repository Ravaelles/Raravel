<?php

namespace App\Traits;

use App\Helpers\ConfigAppHelper;
use App\Helpers\ConsoleHelper;
use App\Helpers\DebugHelper;
use App\Helpers\RouteHelper;
use App\Models\Installer;
use App\Models\Project;

trait InstallsPackages
{

    public function install($project, $installer)
    {
        $installer = Installer::getByName($installer);
        $project = Project::getProjectByName($project);
//        dd($installer);

        $output = null;

        if (!empty($installer->getCommand())) {
            echo DebugHelper::getGreenSection("Running command: " . $installer->getCommand());
            $output = ConsoleHelper::executeCommandInProject($installer->getCommand(), $project);
            ConsoleHelper::printConsoleOutput($output);
        }

        if (strlen($output) <= 1 || str_contains($output, ["failed", "revert"])) {
            echo DebugHelper::getRedSection("Exiting because installation has failed.");
            die;
        }

        if (!empty($installer->getProvider())) {
            echo DebugHelper::getGreenSection("Adding provider: " . $installer->getProvider());
            ConfigAppHelper::addServiceProvider($installer->getProvider(), $project);
        }

        if (!empty($installer->getAlias())) {
            echo DebugHelper::getGreenSection("Adding alias: " . $installer->getAlias());
            ConfigAppHelper::addAlias($installer->getAlias(), $project);
        }

        if (!empty($installer->getRoute())) {
            echo DebugHelper::getGreenSection("Adding route: " . $installer->getRoute());
            RouteHelper::addRoute($installer->getRoute());
        }
    }

}
