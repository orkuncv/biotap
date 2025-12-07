<?php

/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;

use function Env\env;

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', true);
Config::define('WP_DEBUG_LOG', env('WP_DEBUG_LOG') ?? true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
Config::define('SCRIPT_DEBUG', true);
Config::define('DISALLOW_INDEXING', true);

ini_set('display_errors', '1');

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);

// Constants below this line are added/updated by the Vivid kickstart script
Config::define('WP_MEMORY_LIMIT', env('WP_MEMORY_LIMIT') ?: '512M');
Config::define('WP_DEFAULT_THEME', env('WP_DEFAULT_THEME') ?: 'nova');
Config::define('WP_DEVELOPMENT_MODE', env('WP_DEVELOPMENT_MODE') ?: 'theme');

//Config::define('NV_SYNC_DISABLED', env('NV_SYNC_DISABLED') ?: false);
Config::define('NV_SYNC_API_USER', env('NV_SYNC_API_USER') ?: 'api_user_placeholder');
Config::define('NV_SYNC_API_TOKEN', env('NV_SYNC_API_TOKEN') ?: '\'+fm^+ow3[P#}7-t+6;VsS2|LQuLkeA|ea_X)S.2mw*z^g/MSz%`-A%HCUW-gx&xS\'');

Config::define('WP_REDIS_PORT', env('WP_REDIS_PORT') ?: 6379);
Config::define('WP_REDIS_HOST', env('WP_REDIS_HOST') ?: '127.0.0.1');
// WP_CACHE_KEY_SALT should preferentially come from .env if defined there
Config::define('WP_CACHE_KEY_SALT', env('WP_CACHE_KEY_SALT') ?: '\'mYz#AP25%G}Hcd3XX<T%+#fs*i%yNE,*?!N,udf8y.;Rjuwf[PK6j6n*%saR.VlT\'');

