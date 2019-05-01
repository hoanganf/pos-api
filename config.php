<?php
//server DB
define('HOST','localhost');
define('USER_NAME','root');
define('PASSWORD','');
define('DATABASE_NAME','anit_pos_new');
// print result
define('LIB_DIR','../pos-lib/');
define('CONTROLLER_DIR','src/controllers/');
define('MODEL_DIR','src/models/');
define('VIEW_DIR','src/views/');
define('LOGIN_DIR','../pos-login/');
define('LOG_DIR','../log/');
//have to import for login
include_once LIB_DIR.'php/util/Login.php';
include_once LIB_DIR.'php/error_handling.php';

set_error_handler("errorToJson");

include_once constant("LIB_DIR").'/php/dao/Data.php';
include_once constant("LIB_DIR").'/php/dao/BaseDAO.php';
include_once constant("LIB_DIR").'/php/util/ResponseBuilder.php';
include_once constant("LIB_DIR").'/php/util/ResponseGetter.php';

include_once constant("CONTROLLER_DIR").'LocalApiResponseGetter.php';
?>
