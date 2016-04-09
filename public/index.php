<?php

require_once __DIR__.'/../vendor/autoload.php';

use RedisClient\RedisClient;

$redis = new RedisClient([
  'server' => 'tcp://redis:6379'
]);

$app = new Silex\Application();

$app->get('/', function() use ($redis) {
  $count = $redis->executeRawString('INCR count');
  return sprintf("Current count: %d", $count);
});

$app->get('/info', function() {
    phpinfo();
});

$app->get('/db', function() {
    try {
        $dbh = new PDO('mysql:host=mysql;dbname=test', 'newuser', 'password');
        foreach($dbh->query('SELECT * from test') as $row) {
            print_r($row);
        }
        $dbh = null;
        return;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
});

$app->get('/bye', function() {
   return 'Goodbye, world!';
});

$app->run();
