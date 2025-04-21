<?php
require '../../vendor/autoload.php';

use GuzzleHttp\Client;


class TaskService
{
    public function getData()
    {


        $client = new Client();

        $response = $client->request('GET', 'https://pokeapi.co/api/v2/berry/64/');
        $body = $response->getBody();
        $users = json_decode($body, true);
    }
}
