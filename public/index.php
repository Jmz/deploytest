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

$app->get('/bye', function() {
   return 'Goodbye, world!';
});

$app->run();
