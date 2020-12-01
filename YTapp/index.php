<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>YouTube API</title>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


    </head>
    <body>
            <div class="container">
                <h2 class="text-center"> YouTube Data
        </div>

        <?php
            $key = "AIzaSyB0G7O_uy5gUAjCsg8mbh9LpNVy3VnJ_0U";
            $base_url = "https://www.googleapis.com/youtube/v3/";
            $channel = "UCCKkXAa9aTYqBg7sm8WMl1g";
            $limit = 10;
            $video_type = !isset($_GET['vtype'])?1:2;

            include "process.php";
            $db = new DBconnect();
            $conn = $db->connect();

            $stmt = $conn->prepare("select * from videos where type = '2'");
            $stmt->execute();
            ?>
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Type</th>
                            <th> Video ID </th>
                            <th> Title </th>
                        </tr>
                    </thead>

                    <?php
                        while ($row = $stmt->fetchAll(PDO:FETCh_ASSOC)): ?>

                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['type']; ?> </td>
                                <td> <?php echo $row['video_id']; ?> </td>
                                <td> <?php echo $row['title']; ?> </td>


                            </td>

                        </tr>
                        <?php endwhile; ?>
                        </table>
        <?php
            $API_url = $base_url . "playlists?order=date&part=snippet&channelId=".$channel."&maxResults=".$limit."&key=".$key;
            $playlist = json_decode(file_get_contents($API_url));

            if ($video_type == 1){
                $API_url = $base_url . "search?order=date&part=snippet&channelId=".$channel."&maxResults=".$limit."&key=".$key;
                getVideos($API_url);
            }
            else{
                $API_url = $base_url . "playlists?order=date&part=snippet&channelId=".$channel."&maxResults=".$limit."&key=".$key;
                getPlaylist($API_url);
            }


            function getPlaylist($API_url){
                global $conn;
            $playlist = json_decode(file_get_contents($API_url));

                foreach ($playlist->items as $video) {

                $sql = "INSERT INTO `videos` (`id`, `type`, `video_id`, `title`)
                VALUES (NULL, 2 , :vid, :vtitle)" ;

                $stmt = $conn->prepare($sql);
                $stmt->bindParam("vid",$video->id);
                $stmt->bindParam("vtitle",$video->snippet->title);

                $stmt->execute();
            }

            function getVideos($API_url){
                global $conn;
                $video = json_decode(file_get_contents($API_url));

                foreach ($video->items as $video) {

                $sql = "INSERT INTO `videos` (`id`, `type`, `video_id`, `title`)
                VALUES (NULL, 1 , :vid, :vtitle)" ;

                $stmt = $conn->prepare($sql);
                $stmt->bindParam("vid",$video->id->videoId);
                $stmt->bindParam("vtitle",$video->snippet->title);

                $stmt->execute();
    }

            }
         ?>
    </body>
</html>
