<?php

namespace Telekinesis;

class Init
{

    public static function add_update_endpoint() {
        add_rewrite_rule('^telekinesis-update/([^/]+)/?$', 'index.php?telekinesis-update=update&update-key=$matches[1]', 'top');
        add_rewrite_rule('^telekinesis-report/([^/]+)/?$', 'index.php?telekinesis-update=report&update-key=$matches[1]', 'top');

    }

  public static function add_query_var( $query_vars ) {
        $query_vars[] = 'telekinesis-update';
        $query_vars[] = 'update-key';
        return $query_vars;
    }
}