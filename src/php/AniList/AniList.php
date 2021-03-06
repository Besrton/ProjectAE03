<?php

    class AniList {

        private $graphql;

        public function __construct($host = 'https://graphql.anilist.co') {
            $this->graphql = new GraphQL($host, null);
        }


        public function airing() {
            return $this->graphql->query('graphql/airing.graphql', ['page'=> 1, 'perPage' => 12]);
        }

        public function searchAiring($search) {
            $response = $this->graphql->query('graphql/airing.graphql', ['search' => $search, 'page'=> 1, 'perPage' => 5]);

            return $response;
        }

        public function secondsToDate($sec, $format = '%y years, %a days, %h hours, %i minutes, %s seconds') {
            $dtF = new DateTime('@0');
            $dtT = new DateTime("@$sec");
            return $dtF->diff($dtT)->format($format);
        }

    }

?>