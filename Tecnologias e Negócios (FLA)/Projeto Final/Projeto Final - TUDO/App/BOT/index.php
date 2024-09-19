<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "inc/settings.php";
    include "inc/db.php";
    db_connect();

?>

<!DOCTYPE html>
<html lang="en">

    <?php

        include "inc/head.php";

    ?>

    <body>

        <?php

            include "inc/navbar.php";

        ?>

        <section id="main">

        </section>

        <?php

            include "inc/footer.php";

        ?>

    </body>

</html>