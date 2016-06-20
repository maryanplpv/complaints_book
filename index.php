<?php
/* error reporting

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

include_once 'const.php';

require_once 'engine/session.php';

require_once 'engine/db.php';

require_once 'engine/model.php';

require_once 'engine/view.php';

require_once 'engine/controller.php';

require_once 'engine/route.php';

Route::start();

?>