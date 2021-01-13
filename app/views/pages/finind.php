<!doctype html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Easy Fullscreen HTML5 Background Video</title>
    <meta name="keywords" content="css3, html5, js, background video, fullscreen video">
    <meta name="description" content="Super easy to implement HTML5 fullscreen background video library in JavaScript.">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">


    <script src="https://use.typekit.net/nlq1kdt.js"></script>
    <script>
        try {
            Typekit.load({
                async: true
            });
        } catch (e) {}
    </script>
</head>

<body>
    <div id="container">
        <video id="background_video" loop muted></video>
        <div id="video_cover"></div>
        <div id="overlay"></div>

        <div id="video_controls">
            <span id="play">
                <img src="<?php echo URLROOT; ?>/public/img/play.png">
            </span>
            <span id="pause">
                <img src="<?php echo URLROOT; ?>/public/img/pause.png">
            </span>
        </div>

        <section id="main_content">
            <div id="head">
                <h1>ShareQuotes</h1>
                <p class="sub_head">A JS library that makes it super easy to add fullscreen background videos.</p>
                <p class="info">(Hold on! The video might take a while to load.)</p>
            </div>

            <div id="links">
                <a href="">Login</a>
                <a href="">Register</a>
            </div>
        </section>
    </div>



    <script src="<?php echo URLROOT; ?>/public/js/bideo.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/main.js"></script>

    <script>
        if (window.location.host.indexOf('github.io') !== -1 && window.location.protocol !== "https:") {
            window.location.protocol = "https";
        }
    </script>
</body>

</html>



<?php require APPROOT . '/views/include/footer.php'; ?>