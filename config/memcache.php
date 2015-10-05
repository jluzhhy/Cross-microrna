<?php
    $memcache_host = 'localhost';	   
    // $memcache_host = '127.0.0.1';	   
    // $memcache_host = '192.168.0.38';	   
    // $memcache_host = '192.168.0.24';
    // Need set -I 50M for memcached to increase maximal item size, 1M by default
    $memcache_port = '11211';
    $memcache = new Memcache;
    $memcache->connect($memcache_host, $memcache_port) or die ("Couldn't connect memcache server");
    
    // Example
    // if ($name = $memcache->get('name')){ 
    //     // Process $name
    // } else {
    //     $memcache->set('name', 'xxx', 1, 0) // 1 compressed, 0 never expired
    // };
?>
