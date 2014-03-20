<?php
// require_once __DIR__.'/../lib/autoload.php';
$redis = new Redis();
$redis->connect('192.168.0.10', 6379);

$redis->set('key', 'val');

echo $redis->get('key');


// require __DIR__.'/../lib/autoload.php';

// $single_server = array(
//     'host'     => '127.0.0.1',
//     'port'     => 6379
// );

// $redis = new Predis\Client($single_server);
// $redis->set('library', 'predis');

// echo $redis->get('library');

// $client = new Predis\Client($single_server, array('prefix' => 'nrk:'));

// $client->mset(array('foo' => 'bar', 'lol' => 'wut'));
// var_dump($client->mget('foo', 'lol'));


// var_dump($client->keys('*'));
