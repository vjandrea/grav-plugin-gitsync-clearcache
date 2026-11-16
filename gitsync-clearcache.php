<?php
namespace Grav\Plugin;

use Grav\Common\Cache;
use Grav\Common\Plugin;

/**
 * Clears Grav's cache after every Git Sync pull (webhook or Admin save), so new templates,
 * blueprints and plugins pushed to the content repo take effect without a manual clearcache.
 * A plugin, not the theme: the webhook is answered in onPluginsInitialized, before themes load.
 */
class GitsyncClearcachePlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return ['onGitSyncAfterSynchronize' => ['onGitSyncAfterSynchronize', 0]];
    }

    public function onGitSyncAfterSynchronize(): void
    {
        Cache::clearCache('standard');
    }
}
