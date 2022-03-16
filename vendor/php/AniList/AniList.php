<?php

    class AniList {

        private $graphql;

        public function __construct($host = 'https://graphql.anilist.co') {
            $this->graphql = new GraphQL($host, null);
        }

        public function airing() {
            return $this->graphql->query();
        }

    }

?>