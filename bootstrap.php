<?php
// Handle http, https root
define('_DIR_ROOT', str_replace('\\', '/', __DIR__));
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$web_root = $protocol . $_SERVER['HTTP_HOST'];
$folder = str_replace($_SERVER['DOCUMENT_ROOT'], '', _DIR_ROOT);
$web_root .= $folder;
define('_WEB_ROOT', $web_root);
/**
 * Load file
 */
require_once 'helpers/function.php';
require_once 'configs/constans.php';
require_once 'configs/routes.php'; // Load config routes
require_once 'configs/database.php'; // Load config database
require_once 'configs/middlewares.php';

require_once 'app/services/phpmailer/Exception.php';
require_once 'app/services/phpmailer/PHPMailer.php';
require_once 'app/services/phpmailer/SMTP.php';

require_once 'app/App.php';
require_once 'core/Session.php';
require_once 'core/Cookie.php';
require_once 'core/Request.php'; // Load Request Class
require_once 'core/Response.php'; // Load Response Class
require_once 'core/Route.php'; // Load Route class
require_once 'core/Connection.php'; // Load Connection Class
require_once 'core/Database.php'; // Load Database Class
require_once 'core/Model.php'; // Load Base Model Class
require_once 'core/Controller.php'; // Load Base Controller Class
require_once 'core/View.php';
require_once 'core/Load.php';
require_once 'app/classes/Utils.php';
require_once 'app/classes/Validate.php';
require_once 'app/classes/UserLogin.php';
require_once 'app/classes/MyMailer.php';
require_once 'app/middlewares/AuthMiddleware.php';
require_once 'app/middlewares/ProviderMiddleware.php';
require_once 'app/middlewares/CheckMiddleware.php';
