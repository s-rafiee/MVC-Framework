<?php

/*
 *
 * include config.php
 *
 */
require_once 'config/settings.php';

/*
 *
 * include lan/lan.php
 *
 */
require_once 'lan/' . $SETTINGS['LAN'] . '.php';


/*
 *
 * include core/Request.php
 *
 */
require_once 'core/Request.php';


/*
 *
 * include core/Controller.php
 *
*/
require_once 'core/Controller.php';

/*
 *
 * include core/Route.php
 *
*/
require_once 'core/Route.php';

/*
 *
 * include core/Core.php
 *
 */
require_once 'core/Core.php';


