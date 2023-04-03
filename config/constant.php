<?php 
defined('FILE_READ_MODE')                       or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE')                      or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')                        or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')                       or define('DIR_WRITE_MODE', 0755);
defined('DIR_FREE_MODE')                        or define('DIR_FREE_MODE', 0777);
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');
defined('TPL_VIEW_FOLDER')                      or define('TPL_VIEW_FOLDER', 'backend/template/');
defined('ENCRYPT_KEY')                          or define('ENCRYPT_KEY', 'cc50fD77f8');
defined('ASSETS_FOLDER')                        or define('ASSETS_FOLDER', '/assets/');
defined('GLOBAL_ASSETS_FOLDER')                 or define('GLOBAL_ASSETS_FOLDER', ASSETS_FOLDER.'global/');
defined('FRONTEND_ASSETS_FOLDER')               or define('FRONTEND_ASSETS_FOLDER', ASSETS_FOLDER.'frontend/');
defined('BACKEND_ASSETS_FOLDER')                or define('BACKEND_ASSETS_FOLDER', ASSETS_FOLDER.'backend/');
defined('PLUGIN_ASSETS_FOLDER')                 or define('PLUGIN_ASSETS_FOLDER', GLOBAL_ASSETS_FOLDER.'plugin/');
defined('GLOBAL_JS')                            or define('GLOBAL_JS', GLOBAL_ASSETS_FOLDER.'js/');
defined('AFC')                                  or define('AFC', FRONTEND_ASSETS_FOLDER.'css/');
defined('AFF')                                  or define('AFF', FRONTEND_ASSETS_FOLDER.'font/');
defined('AFI')                                  or define('AFI', FRONTEND_ASSETS_FOLDER.'img/');
defined('AFJ')                                  or define('AFJ', FRONTEND_ASSETS_FOLDER.'js/');
defined('BACKEND_CSS')                          or define('BACKEND_CSS', BACKEND_ASSETS_FOLDER.'css/');
defined('BACKEND_FONT')                         or define('BACKEND_FONT', BACKEND_ASSETS_FOLDER.'font/');
defined('BACKEND_IMAGE')                        or define('BACKEND_IMAGE', BACKEND_ASSETS_FOLDER.'img/');
defined('BACKEND_JS')                           or define('BACKEND_JS', BACKEND_ASSETS_FOLDER.'js/');
defined('OP')                                   or define('OP', 'where_operator');
defined('VAL')                                  or define('VAL', 'where_value');

// defined('UPLOAD_FOLDER_LINK')                   or define('UPLOAD_FOLDER_LINK', 'upload/');
// defined('US') or define('US', 'upload/summernote/');
// defined('UBL') or define('UBL', 'upload/boloc/');
// defined('UGT') or define('UGT', 'upload/giatri/');
// defined('UHV') or define('UHV', 'upload/hienvat/');