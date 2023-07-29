<?php

namespace App\Utils;

class RedisConnection {
    private $redis;

    public function __construct() {
        try {
            $this->redis = new \Predis\Client('tcp://127.0.0.1:6379');
            $this->redis->connect();
        } catch (\Predis\Connection\ConnectionException $e) {
            $this->redis = null;
        }
    }

    public function getRedis() {
        return $this->redis;
    }

    public function clearCacheWithPrefix($prefix) {
        if ($this->redis !== null) {
            $redis = $this->redis;
            $keys = $redis->keys($prefix . '*');

            if (!empty($keys)) {
                $redis->del($keys);
            }
        }
    }
}
