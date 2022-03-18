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
        
        <?php require_once('views/header.php'); ?>

        <?php
            //var_dump($anilist->query($query, '{"id":15125}'));
        ?>
        <main class="row">
            <div class="section">
                <form class="col" action="index.php" method="POST">
                    <input placeholder="search" name="search" type="search" class="col">
                    <input type="submit" value="Search" class="btn small solid">
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Proxim episodi</th>
                            <th>Imatge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($series as $serie): ?>
                        <tr>
                            <td><?php echo($serie['id']); ?></td>
                            <td><?php echo($serie['title']['romaji'] . ' | ' . $serie['title']['native']); ?></td>
                            <td><?php echo(!empty($serie['nextAiringEpisode']) ? 'Episodi: <strong>' . $serie['nextAiringEpisode']['episode'] . '</strong><br><span class="countdown">' . $anilist->secondsToDate($serie['nextAiringEpisode']['timeUntilAiring'], '%a:%h:%i:%s') . '</span>' : 'desconegut'); ?></td>
                            <td><img src="<?php echo($serie['coverImage']['large']); ?>"></td>
                        </tr>   
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Footer</td>
                        </tr>
                    </tfoot>
                </table>

                Comptador de prova: <span class="countdown">1:1:1:5</span>
                
            </div>
        </main>

        <script src="vendor/js/jQuery/jquery-3.6.0.slim.min.js"></script>
        <script src="js/coutdown.js"></script>
    </body>
</html>