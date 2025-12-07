<?php
/**
 * Nova Theme constants
 *
 * @author  Movve - https://movve.nl
 * @package Nova
 * @since   1.0.0
 */

/*
|--------------------------------------------------------------------------
| Theme Constants
|--------------------------------------------------------------------------
|
| These constants are used to define the theme details. These
| constants are used across the theme to define the theme details.
|
*/

const NOVA_INIT = true;
const NOVA_THEME_VERSION = '1.0.0';
const NOVA_THEME_NAME = 'Nova';
const NOVA_THEME_SLUG = 'nova';
const NOVA_THEME_TEMPLATE = 'nova-theme';
const NOVA_THEME_AUTHOR = 'Movve';
const NOVA_THEME_AUTHOR_URL = 'https://movve.nl';
const NOVA_THEME_DESCRIPTION = 'A clean and simple WordPress block theme, built for speed and simplicity.';

/*
|--------------------------------------------------------------------------
| Child Theme Constants
|--------------------------------------------------------------------------
|
| These constants are used to define the child theme details.
|
*/

const NOVA_CHILD_THEME_VERSION = '1.0.0';
const NOVA_CHILD_THEME_NAME = 'Nova Child';
const NOVA_CHILD_THEME_SLUG = 'nova-child';

/*
|--------------------------------------------------------------------------
| Path Constants
|--------------------------------------------------------------------------
|
| These constants are used to define paths within the theme.
|
*/

const NOVA_PARENT_THEME_DIR = __DIR__ . '/../';
const NOVA_TEXT_DOMAIN = 'nova';
const NOVA_DEVELOPMENT_URLS = [
	'.localhost',
	'.test',
	'.local',
	'.dev',
	'movve.nl'
];
