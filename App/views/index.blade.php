<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body {
            background: #ededed;
        }

        .post {
            background: #fff;
            margin-top: 10px;
            padding: 20px;
        }

        .post-title {
            border-bottom: 1px solid #ededed;
            font-size: 18px;
        }

        .post-description {
            color: #666;
            font-size: 14px;
            line-height: 14px;
        }
    </style>
</head>
<body>
<h1>sample viewwwwww.</h1>

<?php
for ($i = 0; $i < count($data['posts']); $i++){ ?>
    <div class="post">
        <h1 class="post-title"><?php echo $data['posts'][$i]['title']; ?></h1>
        <p class="post-description"><?php echo $data['posts'][$i]['body']; ?></p>
    </div>
<?php } ?>
</body>
</html>