<?php

namespace Artooha\UniversalBot\Traits;

trait CurlRequestsTrait
{
    /**
     * @param string $url
     * @param array  $data
     * @param array  $headers
     * @return \stdClass Properties: code - returned HTTP code, response - text of response itself
     */
    protected function sendPostRequest($url, array $data = [], array $headers = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        if (in_array('Content-Type: application/json', $headers)) {
            $json = json_encode($data);
            $headers[] = 'Content-Length: '.strlen($json);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        } else {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        $response = new \stdClass();
        $response->code = $info['http_code'];
        $response->response = $result;

        return $response;
    }

    /**
     * @param string $url
     * @param array  $data
     * @param array  $headers
     * @return \stdClass Properties: code - returned HTTP code, response - text of response itself
     */
    protected function sendGetRequest($url, array $data = [], array $headers = [])
    {
        $url = explode('?', $url);
        $url = $url[0];

        $ch = curl_init($url.'?'.http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        $response = new \stdClass();
        $response->code = $info['http_code'];
        $response->response = $result;

        return $response;
    }
}
