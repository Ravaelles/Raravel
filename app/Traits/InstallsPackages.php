<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Installer;
use App\Project;
use App\Helpers\ConsoleHelper;
use App\Helpers\ConfigAppHelper;
use App\Helpers\DebugHelper;

trait InstallsPackages
{

    public function install($project, $installer)
    {
        $installer = Installer::getByName($installer);
        $project = Project::getProjectByName($project);

        if (!empty($installer->getCommand())) {
            echo DebugHelper::getGreenSection("Running command: " . $installer->getCommand());
            $output = ConsoleHelper::executeCommandInProject($installer->getCommand(), $project);
            ConsoleHelper::printConsoleOutput($output);
        }

        if (!empty($installer->getProvider())) {
            echo DebugHelper::getGreenSection("Adding provider: " . $installer->getProvider());
            ConfigAppHelper::addServiceProvider($installer->getProvider());
        }

        if (!empty($installer->getAlias())) {
            echo DebugHelper::getGreenSection("Adding alias: " . $installer->getAlias());
            ConfigAppHelper::addAlias($installer->getAlias());
        }
    }

}
