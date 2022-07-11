
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <?php require_once 'html/head.php'; ?>
</head>
<body class="stretched overlay-menu">
    <div id="wrapper" class="clearfix bg-light">
        <?php require_once 'html/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Content -->
                <?php require_once 'news.php'; ?>
                <!-- #content end -->
                <section class="right-side mb-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?php require_once 'goldprices.php'; ?>
                                <?php require_once 'coinprices.php'; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php require_once 'html/footer.php'; ?>
    </div>
    <!-- Go To Top
	============================================= -->
    <div id="gotoTop" class="icon-angle-up rounded-circle"></div>
    <?php require_once 'html/script.php'; ?>
</body>
</html>