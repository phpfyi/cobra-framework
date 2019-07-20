<?php

/**
 * HTTP package
 *
 * @category  HTTP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

// DEFINES
define('HTTP_PACKAGE_ROOT', dirname(__FILE__));

// FUNCTIONS
include 'functions/ip.php';
include 'functions/request.php';
include 'functions/response.php';
include 'functions/uri.php';