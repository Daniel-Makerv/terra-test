<?php
require '../../vendor/autoload.php';

use GuzzleHttp\Client;


class TaskService
{
    public function getData()
    {
        $client = new Client();


        $response = $client->request('GET', 'http://host.docker.internal:8080/api/task');
        $body = $response->getBody();
        return  json_decode($body, true);
    }
}
