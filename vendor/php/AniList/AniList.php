<?php

class AniList {

    private $host;

    public function __construct($host = 'https://graphql.anilist.co') {
        $this->host = $host;
    }


    public function query($query, $variables) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_URL, $this->host);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

        $post = '{"query":"\\nquery ($id: Int) { # Define which variables will be used in the query (id)\\n  Media (id: $id, type: ANIME) { # Insert our variables into the query arguments (id) (type: ANIME is hard-coded in the query)\\n    id\\n    title {\\n      romaji\\n      english\\n      native\\n    }\\n  }\\n}\\n","variables":{"id":15125}}';
        
        $post2 = '{"query":' . json_encode($query, JSON_UNESCAPED_UNICODE) . ', "variables":' . json_encode($variables, JSON_UNESCAPED_UNICODE) . '}';

        echo '<br><br>'. $post. '<br><br>'. $post2. '<br><br>';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post2);

        curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type: application/json; Accept: application/json; charset=utf-8'));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);

        return json_decode($response, JSON_UNESCAPED_UNICODE);

    }

    /*
    public function graphql1($host, $query, $variables, $token = '') {
        // Cleanup
        $query = preg_replace('/\s+/S', ' ', $query);

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $host,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"query": "' . trim($query) . '", "variables": ' . $variables . '}',
            CURLOPT_HTTPHEADER => array(
                //'Authorization: Bearer ' . trim($token),
                'Content-Type: application/json; charset=utf-8'
            )
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
    */


}




?>