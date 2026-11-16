# GitSync Clear Cache

A Grav plugin that clears Grav's cache after every [Git Sync](https://github.com/trilbymedia/grav-plugin-git-sync) pull.

## Why

Grav only notices files it has already seen change. When Git Sync pulls a commit that adds a new template, blueprint or plugin (from the webhook, or after an Admin save), the site keeps serving the old cached version until someone runs `bin/grav clearcache` on the server. This plugin runs that clear for you.

## How it works

It listens to Git Sync's `onGitSyncAfterSynchronize` event and calls `Cache::clearCache('standard')`, the same as `bin/grav clearcache`. Images are left alone.

It has to be a plugin rather than code in your theme: Git Sync answers its webhook in `onPluginsInitialized` and exits before any theme is loaded, so a theme listener would never fire.

The cost is a cache rebuild on the next page view after each sync: a few hundred milliseconds on a typical site.

## Install

Copy this folder to `user/plugins/gitsync-clearcache`, or clone it there:

```bash
cd user/plugins
git clone https://github.com/vjandrea/grav-plugin-gitsync-clearcache.git gitsync-clearcache
```

Then clear the cache once by hand (`bin/grav clearcache`), so Grav picks up the new plugin. From then on it clears the cache itself.

There is nothing to configure. It's enabled by default; turn it off in `user/config/plugins/gitsync-clearcache.yaml` with `enabled: false`.

## Requirements

- Grav 1.7 or 2.x
- The Git Sync plugin. Without it the event never fires and this plugin does nothing.

## License

MIT
