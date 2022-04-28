<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('vendor/php/AniList/AniList.php');
    require_once('vendor/php/GraphQL/GraphQL.php');

    // Obtenir serie per a la cerca
    $series = [];
    $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    
    $anilist = new AniList();
    
    if (!empty($search)) {
        $series = $anilist->searchAiring($search)['data']['Page']['media'];
    } else {
        $series = $anilist->airing()['data']['Page']['media'];
    }
    //
    // Descomenta esta linia si vols veure el resultat
    //print("<pre>".print_r($series, true)."</pre>");

?>

<!DOCTYPE html>

<?php require_once('views/head.php'); ?>

<html>
    <body>
        


        <main>

            <?php require_once('views/header.php'); ?>

            <section class="container">
                <form class="search" action="index.php" method="POST">
                    <input placeholder="Search" name="search">
                    <input type="submit" value="search">
                </form>
            </section>
            <section class="container">

                <div class="row cards">
                    <?php foreach($series as $serie): ?>
                        <div class="column column-25">
                            <div class="card">
                                <div class="content">
                                    <small class="episode">Episode: <?php echo($serie['nextAiringEpisode']['episode']); ?></small>
                                    <img src="<?php echo($serie['coverImage']['large']); ?>">
                                    <strong class="title"><?php echo($serie['title']['romaji']); ?></strong>
                                </div>
                                <div class="row countdown" <?php echo(!empty($serie['nextAiringEpisode']) ? 'data-countdown="' . $serie['nextAiringEpisode']['timeUntilAiring'] . '"' : ''); ?>>                                
                                    <div>
                                        <div class="days">0</div>
                                        <small>Days</small>
                                    </div>
                                    <div>
                                        <div class="hours">0</div>
                                        <small>Hours</small>
                                    </div>
                                    <div>
                                        <div class="minutes">0</div>
                                        <small>Minutes</small>
                                    </div>
                                    <div>
                                        <div class="seconds">0</div>
                                        <small>Seconds</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                Comptador de prova: <span data-countdown="">1:1:1:5</span>
                
            </section>
        </main>
        <script src="vendor/js/jQuery/jquery-3.6.0.slim.min.js"></script>
        <script src="js/coutdown.js"></script>
    </body>
</html>