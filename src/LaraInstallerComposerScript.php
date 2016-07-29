<?php

namespace Shipu\Installer;

use Composer\Script\Event;

class LaraInstallerComposerScripts
{
    /**
     * Handle the post-install Composer event.
     *
     * @param  \Composer\Script\Event  $event
     * @return void
     */
    public static function addProvider(Event $event)
    {
        return "ok";
    }
}
