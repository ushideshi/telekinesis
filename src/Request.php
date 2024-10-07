<?php

namespace Telekinesis;

class Request
{
    protected static $key;

    public static function get_config_key(){
        self::$key = get_option('telekinesis_secret');
    }
    public static function check_query_vars( $template ) {
        self::get_config_key();

        $path = get_query_var( 'telekinesis-update' );
        $key = get_query_var( 'update-key' );

        if ( !in_array($path, ['report', 'update'])   ) {
            return $template;
        }

        if($path == 'report' && $key == self::$key) {
            $report = new Report();
            $report->report();

        }
        elseif($path == 'update' && $key == self::$key) {
            $updater = new Updater();
            $check_dir = $updater->check_dir();
            $backup_db = $updater->backup_db();
            $backup_files = $updater->backup_files();
            $cli = $updater->check_wpcli();
            $update = $updater->update_modules();
        }
        else {
            return $template;
        }
    }
}