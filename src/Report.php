<?php

namespace Telekinesis;

class Report
{
    private $counts;


    public function __construct(){
        $this->counts = [
            'plugins' => 0,
            'themes' => 0,
            'wordpress' => 0,
        ];
    }
   public function report(){
        $update_plugins = get_site_transient( 'update_plugins' );
        $update_themes = get_site_transient( 'update_themes' );

        if (!function_exists('get_core_updates')) {
            require_once(ABSPATH . '/wp-admin/includes/update.php');
        }


        $update_wordpress = get_core_updates( array( 'dismissed' => false ) );

        if ( ! empty( $update_plugins->response ) ) {
            $this->counts['plugins'] = count( $update_plugins->response );
        }

        if ( ! empty( $update_themes->response ) ) {
            $this->counts['themes'] = count( $update_themes->response );
        }


        if ( ! empty( $update_wordpress )
            && ! in_array( $update_wordpress[0]->response, array( 'development', 'latest' ), true )
        ) {
            $this->counts['wordpress'] = 1;
        }

        wp_send_json( [
            'core' => get_bloginfo( 'version' ),
            'updates' =>  [
                'plugins' => $this->counts['plugins'],
                'themes' => $this->counts['themes'],
                'wordpress' => $this->counts['wordpress'],
            ]
        ] );

        exit();
    }


}