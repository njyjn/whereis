<!DOCTYPE html>
<html>
    <head>
        <title>where the hek is justin ng</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
        <link rel="stylesheet" href="public/css/styles.css">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            $opts = array(
                'http'=>array(
                    'method'=>'GET',
                    'header'=>'Authorization: Bearer '.getenv('GPWS_AUTH_TOKEN')
                )
            );
            $context = stream_context_create($opts);
            $location = @file_get_contents(getenv('GPWS_URL').'/'.getenv('WHEREIS_USER_CHAT_ID'), true, $context);
            if ($location) {
                $user = json_decode($location)->user;
            } else {
                $user = (object) ['status'=>'UNREACHABLE','source'=>'youpassbutter','updatedAt'=>'unknown','lattitude'=>'0.000000','longitude'=>'0.000000'];
            }
            $latt = $user->lattitude;
            $long = $user->longitude;
            $status = $user->status;
            $source = $user->source;
            $updatedAt = $user->updatedAt;
            $url = "https://www.google.com/maps/embed/v1/view?center=$latt,$long&zoom=15&key=".getenv('GOOGLE_MAPS_API_KEY');
        ?>

        <div class="main">
            <div class="container">
                <div class="top">
                    <img src="public/images/sarcasm.png" alt="what is this, sarcasm?" draggable="false">
                    <h1>where the hek is he</h1>
                    <p>updated: <?=$updatedAt?></p>
                </div>
                <div class="row" id="where">
                <h2>last known hearbeat</h2>
                    <div class="table">
                        <div class="cell">
                            <p><?=$status?></p>
                            <p>source: <?=$source?></p>
                        </div>
                    </div>
                    <h2>last known location</h2>
                    <div class="table">
                        <div class="cell">
                            <iframe width='100%' height='400' style='border:0' loading='lazy' allowfullscreen src=<?=$url?>></iframe>
                        </div>
                    </div>
                </div>
                <div class="row" id="checksum">
                    <h2>checksum</h2>
                    <small>[sha256] 52cf90a49fbf6c9bc9f733ad9acae7c98dbb8e2e2ba81f2845d7197aa4ac82ef</small>
                </div>
            </div>
        </div>
    </body>
    <div class="footer">TWENTY TWENTY ONE &copy ALETHEON CORP</div>
</html>
