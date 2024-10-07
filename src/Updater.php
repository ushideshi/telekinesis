<?php

namespace Telekinesis;

class Updater
{

    private $file_backup_name;
    private $db_backup_name;

    public function backup_db(){
        $pass = DB_PASSWORD;
        $user  = DB_USER;
        $db  = DB_NAME;

        $filename = date('Y-m-d-H-i-s').'_database_backup.sql.gz';
        $result = exec('mysqldump '.$db.' --password='.$pass.' --user='.$user.'  | gzip > dumps/'.$filename,$output);
        $this->db_backup_name = $filename;
        if (empty($output)){
            return true;
        }
        else {
            return $output;
        }
    }

    public function backup_files(){
        $dir = 'wp-content/plugins/';
        $filename = date('Y-m-d-H-i-s').'_files_backup.tar';
        $result = exec('tar -cvf dumps/'.$filename.' '.$dir ,$output);
        $this->file_backup_name = $filename;
    }
    public function update_modules(){

        exec('php wp-cli.phar core update --format table', $core_output);
        exec('php wp-cli.phar plugin update --all --format table', $plugin_output);

        wp_send_json([
            'file_backup' => home_url().'/dumps/'.$this->file_backup_name,
            'db_backup' => home_url().'/dumps/'.$this->db_backup_name,
            'update_core' => $core_output,
            'update_plugins' => $plugin_output
        ]);

        exit();
    }

    public function check_wpcli() {
        if (!file_exists('wp-cli.phar')) {
            exec("wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar", $output);
        }
    }

    public function check_dir() {
        if (!file_exists('dumps')) {
            mkdir('dumps', 0755, true);
            $file = 'dumps/.htaccess';
            $content = "Redirect 404";
            file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
        }
    }

}