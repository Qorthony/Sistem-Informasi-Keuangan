<?php
function getRate()
{
    $json = file_get_contents("https://free.currconv.com/api/v7/convert?q=USD_IDR&compact=ultra&apiKey=82a10e65fb6a1f9e3e4b");
    $obj = json_decode($json, true);
    $val = floatval($obj["USD_IDR"]);

    // dd($val);
    return $val;
}

function translateToEnglish($data){
    $url = 'https://api.eu-gb.language-translator.watson.cloud.ibm.com/instances/355b7141-aad3-4f7b-9b11-6aa7a120068a/v3/translate?version=2018-05-01';
    $key = 'Basic YXBpa2V5OnZUNWd5bmpreVRSVlV2WVpxcldlZ3FFZGdVdVhwTFQ5Q1hRR0dfcWJtYl83';
    $client = \Config\Services::curlrequest();
    $response = $client->post($url,[
                            "headers"=>[
                                "Authorization"=>$key
                            ],
                            "json"=>[
                                "text"=>$data,
                                "model_id"=>"id-en"
                            ]
                        ]);
    $json = json_decode($response->getBody(),true);
    // dd($json);
    return $json;
}
?>