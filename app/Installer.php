<?php

namespace App;

class Installer
{

    public static function getInstallers()
    {
        $rawArray = json_decode(file_get_contents(base_path('installers.json')), TRUE);
        if ($rawArray === null) {
            die('Cant build json. You probably need to replace \\ with \\\\');
        }

        $installers = [];
        foreach ($rawArray as $rawInstaller) {
            $installer = new Installer;
            foreach ($rawInstaller as $key => $value) {
                if (strlen($key)) {
                    $installer->$key = $value;
                }
            }

            if (!empty($installer->getName())) {
                $installers[] = $installer;
            }
        }

        return $installers;
    }

    public static function getByName($name)
    {
        foreach (self::getInstallers() as $installer) {
            if ($installer->getName() === $name) {
                return $installer;
            }
        }
        return null;
    }

    // =========================================================================

    private $name;
    private $type;
    private $command;
    private $provider;
    private $alias;
    private $route;

    // =========================================================================

    function getName()
    {
        return $this->name;
    }

    function getType()
    {
        return $this->type;
    }

    function getCommand()
    {
        return $this->command;
    }

    function getProvider()
    {
        return $this->provider;
    }

    function getAlias()
    {
        return $this->alias;
    }

    function getRoute()
    {
        return $this->route;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setType($type)
    {
        $this->type = $type;
    }

    function setCommand($command)
    {
        $this->command = $command;
    }

    function setProvider($provider)
    {
        $this->provider = $provider;
    }

    function setAlias($alias)
    {
        $this->alias = $alias;
    }

    function setRoute($route)
    {
        $this->route = $route;
    }

}
