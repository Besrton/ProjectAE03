<?php

    class AniList {

        private $graphql;

        public function __construct($host = 'https://graphql.anilist.co') {
            $this->graphql = new GraphQL($host, null);
        }


        public function airing() {
            return $this->graphql->query('graphql/airing.graphql');
        }

        public function searchAiring($search) {
            $response = $this->graphql->query('graphql/airing.graphql', ['search' => $search]);

            return $response;
        }

    }

?>