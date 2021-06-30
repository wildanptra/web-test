<?php
require __DIR__ . "/vendor/autoload.php";


class Cache {
    
    protected $client;
    public $redis;
    
    function __construct()
    {
        $this->client = new Predis\Client([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379,
        ]);
        $this->redis = $this->client;
    }

    public function remember(string $key, int $exp, callable $callback) {
        $get = $this->client->get($key);
        $data = null;

        if($get == null) {
            $value = serialize($callback());
            $this->client->set($key, $value, 'EX', $exp);
            $data = $this->client->get($key);
            $data = unserialize($data);

        } else {
            $data = unserialize($get);
        }
        
        return $data;
    }

    public function del($key) {
        $this->client->del($key);
    }
}

// $data = (new Redis)->remember('tes-key', 5, function() {
//     return 'test';
// });