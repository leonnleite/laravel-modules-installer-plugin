<?php

namespace Wend\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class LaravelModulesInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $name = $package->getPrettyName();
        $vendorPkg = explode('/',$name);
        if ( strstr($vendorPkg[1],'-',true) !== 'module') {
            throw new \InvalidArgumentException(
                'Unable to install module, laravel modules '
                .'should always start their package name with '
                .'"<vendor>/module-"'
            );
        }
        $name = str_replace(['Module-','-'],'', ucwords($vendorPkg[1], '-'));
        return 'app/Modules/' . $name;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'laravel-modules' === $packageType;
    }
}
