<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getData(string $method, array $options = [])
    {
        $instagramApiUrl = env('INSTAGRAM_API_URL');
        $instagramBussinesId = env('BUSSINES_INSTAGRAM_ID');
        $accessToken = ['access_token' => env('INSTAGRAM_TOKEN')];
        $options = array_merge($options ?? [], $accessToken);
        $client = new Client();
        $response = $client->request($method, $instagramApiUrl . $instagramBussinesId . '/', [
            RequestOptions::QUERY => $options,
        ]);

        $responseBody = json_decode($response->getBody()->getContents());

        return $responseBody;
    }
}
