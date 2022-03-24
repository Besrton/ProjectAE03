<?php

    class GraphQL {

        private $host;
        private $token;

        public function __construct($host, $token = null) {
            $this->host = $host;
            $this->token = $token;
        }

        public function query($query, $variables = []) {

            if (is_file($query))
                $query = file_get_contents($query);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

            curl_setopt($ch, CURLOPT_URL, $this->host);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            //echo('{"query":' . json_encode($query) . ', "variables":' . json_encode($variables) . '}');
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"query":' . json_encode($query) . ', "variables":' . json_encode($variables) . '}');
            curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type: application/json; Accept: application/json; charset=UTF-8'. (isset($token) ? 'Authorization: Bearer ' . $token : '')));

            $response = curl_exec($ch);

            curl_close($ch);

            return json_decode($response, true);

        }

        public function queryByID($query, $id) {
            return $this->query($query, ['id'=>$id]);
        }

    }

?>