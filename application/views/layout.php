<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php if(isset($page_title)) echo $page_title ; ?></title>
    <base href="<?php echo base_url() ; ?>" />
    <meta name="viewport" content="initial-scale=1.0">
    <script src="assets/js/vendor/html5shiv.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
</head>
 
<body class="page-<?php echo $code ; ?> <?php if(isset($is_util) && $is_util) echo 'is-util' ; ?>">
    <div class="skip-links">
        <a href="#menu">Aller au menu</a>
        <a href="#content">Aller au contenu</a>
    </div>
    <div class="wrapper">
        <?php if(isset($menu)) : ?>
        <nav class="main-sidebar" id="menu">
            <?php echo $menu ; ?>
        </nav>
        <?php endif ; ?>
        <main class="main-content" id="content">
            <?php if(isset($code)) : ?><div class="bg bg-<?php echo $code ; ?>"></div><?php endif ; ?>
            <div class="content">
                <?php echo $content; ?>
            </div>
            <?php if(isset($is_util) && $is_util) : ?><script src="assets/js/vendor/jquery-1.11.0.min.js"></script><?php endif ;?>
        </main>
    </div>

</body>
</html>