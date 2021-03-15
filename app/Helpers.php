<?php

use Carbon\Carbon;

if (!function_exists('getMinuteAfterPosted')) {
    function getMinuteAfterPosted($time)
    {
        $date = Carbon::parse($time);
        $now = Carbon::now();
        return $diff = $date->diffInHours($now,false);
    }
}
if (!function_exists('getCommunityList')) {
    function getCommunityListData()
    {
        $data = '{"id":7,"jsonrpc":"2.0","method":"bridge.list_communities","params":{"sort":"rank","observer":null,"last":"","limit":100}}';
        $response = cUrl($data);
        return json_decode($response);
        // $data = '{"id":2,"jsonrpc":"2.0","method":"bridge.list_all_subscriptions","params":{"account":"peak.featured"}}';

    }
}
if (!function_exists('getCommunityInfo')) {
    function getCommunityInfo($communityName)
    {
        $data = '{"id":10,"jsonrpc":"2.0","method":"bridge.get_community","params":{"name":"' . $communityName . '","observer":null}}';
        $response = cUrl($data);
        return json_decode($response);
        // $data = '{"id":2,"jsonrpc":"2.0","method":"bridge.list_all_subscriptions","params":{"account":"peak.featured"}}';

    }
}
if (!function_exists('getCommunityPosts')) {
    function getCommunityPosts($communityName, $limit = 20, $startAuthor = null, $startPermalink = null)
    {
        $data  = json_encode(array(
            'id' => 11,
            'jsonrpc' => '2.0',
            'method' => 'bridge.get_ranked_posts',
            'params' =>
            array(
                'tag' => $communityName,
                'sort' => 'created',
                'limit' => $limit,
                'start_author' => $startAuthor,
                'start_permlink' => $startPermalink,
                'observer' => NULL,
            ),
        ));


        // $data = '{"id":11,"jsonrpc":"2.0","method":"bridge.get_ranked_posts","params":{"tag":"' . $communityName . '","sort":"created","limit":21,"start_author":null,"start_permlink":null,"observer":null}}';
        $response = cUrl($data);
        return json_decode($response);
        // $data = '{"id":2,"jsonrpc":"2.0","method":"bridge.list_all_subscriptions","params":{"account":"peak.featured"}}';

    }
}


if (!function_exists('cUrl')) {
    function cUrl($data)
    {


        $url = "https://api.hive.blog/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Connection: keep-alive",
            "accept: application/json, text/plain, */*",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.86 Safari/537.36",
            "content-type: application/json",
            "Sec-GPC: 1",
            "Origin: https://peakd.com",
            "Sec-Fetch-Site: cross-site",
            "Sec-Fetch-Mode: cors",
            "Sec-Fetch-Dest: empty",
            "Accept-Language: en-US,en;q=0.9",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }
}
