<?php


require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use Flex\Core\Database;
use Flex\Core\Events\EventManager;
use Flex\Core\Plugins\PluginManager;
use Flex\Core\Routing\Router;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function db() {
    return Database::getInstance();
}
db();

$events = EventManager::getInstance();

$activePlugins = ['page-plugin'];

$pluginManager = new PluginManager($events, $activePlugins);
$pluginManager->loadPlugins();

$content = "Здравей, това е съдържанието на сайта.";
$content = $events->applyFilters('the_content', $content);

$router = new Router($events);
$router->resolve();
