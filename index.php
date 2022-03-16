<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('vendor/php/AniList/AniList.php');
    require_once('vendor/php/GraphQL/GraphQL.php');

    // Obtenir serie per a la cerca
    $serie = filter_input(INPUT_POST, 'serie', FILTER_SANITIZE_STRING);
    $series = [];

    // Here we define our query as a multi-line string
    $query = '
            query ($id: Int) {
                Media (id: $id, type: ANIME) {
                id
                title {
                    romaji
                    english
                    native
                }
                }
            }
            ';

    // Define our query variables and values that will be used in the query request
    $variables = [
        "id" => 131646
    ];

    
    $anilist = new AniList();


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
                    <input placeholder="search" name="serie" type="search" class="col">
                    <input type="submit" value="Search" class="btn small solid">
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Tipus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($series as $serie): ?>
                        <tr>
                            <td><?php echo($serie['id']); ?></td>
                            <td><?php echo($serie['name']); ?></td>
                            <td><?php echo($serie['type']); ?></td>
                        </tr>   
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Footer</td>
                        </tr>
                    </tfoot>
                </table>

            
            </div>
        </main>
    </body>
</html>