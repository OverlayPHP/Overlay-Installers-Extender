<?php

declare(strict_types = 1);
namespace Overlay\OverlayInstallersExtender\Installers;

class OverlayInstaller extends BaseInstaller
{
    protected $locations = array(
        'module' => 'Modules/{$vendor}/{$name}/',
        'theme' => 'Themes/{$name}/',
        'command' => 'app/Console/Commands/{$vendor}/{$name}/',
        'library' => 'Libraries/{$vendor}/{$name}/',
        'helper' => 'app/Helpers/{$vendor}/{$name}/',
    );

    /**
     * Format package name.
     *
     * Handle the package type, splitting the -[classifier] from the type to know where to install it.
     *
     *
     */
    public function inflectPackageVars($vars)
    {
        if ($vars['type'] === 'overlay-module') {
            return $this->inflectTypeVars($vars,'module');
        }

        if ($vars['type'] === 'overlay-theme') {
            return $this->inflectTypeVars($vars,'theme');
        }

        if ($vars['type'] === 'overlay-command') {
            return $this->inflectTypeVars($vars,'command');
        }

        if ($vars['type'] === 'overlay-library') {
            return $this->inflectTypeVars($vars,'library');
        }

        if ($vars['type'] === 'overlay-helper') {
            return $this->inflectTypeVars($vars,'helper');
        }

        return $vars;
    }

    protected function inflectTypeVars($vars,$type)
    {
        $vars['name'] = preg_replace('/-'.$type.'$/', '', $vars['name']);
        $vars['name'] = str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }

}
