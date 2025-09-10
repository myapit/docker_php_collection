<?php
unset($CFG);
global $CFG;
$CFG = new stdClass();

// Database configuration
$CFG->dbtype    = 'mariadb';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'db';
$CFG->dbname    = 'moodle';
$CFG->dbuser    = 'moodle';
$CFG->dbpass    = 'moodle';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array(
    'dbpersist' => 0,
    'dbport' => 3306,
    'dbsocket' => '',
    'dbcollation' => 'utf8mb4_unicode_ci',
);

// Site configuration
$CFG->wwwroot   = 'http://foi.usm.my';
$CFG->dataroot  = '/var/moodledata';
$CFG->admin     = 'admin';

// Directory permissions
$CFG->directorypermissions = 0777;

// Performance settings
$CFG->cachejs = true;
$CFG->perfdebug = 0;

// Session settings
/*
 * $CFG->session_handler_class = '\core\session\redis';
$CFG->session_redis_host = 'redis';
$CFG->session_redis_port = 6379;
$CFG->session_redis_database = 0;
$CFG->session_redis_password = 'redispassword';
$CFG->session_redis_prefix = 'moodle_session_';
$CFG->session_redis_acquire_lock_timeout = 120;
$CFG->session_redis_lock_expire = 7200;
 */
// Cache configuration
/*$CFG->cachestores = array(
    'redis' => array(
        'name' => 'redis',
        'plugin' => 'redis',
        'configuration' => array(
            'server' => 'redis:6379',
            'prefix' => 'moodle_',
            'password' => 'redispassword',
            'serializer' => 1,
        ),
    ),
);

$CFG->defaultexpiredsession = 7200;
 */
// Required for setup
require_once(__DIR__ . '/lib/setup.php');
