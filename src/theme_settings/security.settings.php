<?php



  class SecuritySettings{
    function __construct(){
      $this->addActions();
      $this->addFilters();
    }

    function addActions(){

      add_action( 'template_redirect', [$this, 'action__redirect_author_request'], 1);
    }

    function addFilters(){
      
      add_filter( 'author_link', function() { return '#'; }, 99 );
      add_filter( 'the_author_posts_link', '__return_empty_string', 99 );
      add_filter('xmlrpc_enabled', '__return_false');
      add_filter('the_generator', [$this, 'filter__remove_wp_generator']);
      add_filter( 'rest_endpoints', [$this, 'remove_rest_endpoints'] );
      add_filter('login_errors', [$this, 'filter__override_login_error']);
    }

    //START ACTIONS
    function action__redirect_author_request(){
      if ( isset( $_GET['author'] ) || is_author() ) {
              global $wp_query;
              $wp_query->set_404();
              status_header( 404 );;
              nocache_headers();
      }            
    }

    //START FILTER
    function filter__remove_wp_generator(){
      return '';
    }
    function filter__override_login_error(){
      // return 'Credenziali errate';
    }
    function remove_rest_endpoints( $endpoints ) {
      if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
      }
      if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
      }

      return $endpoints;
    }
  }

  $securitySettings = new \SecuritySettings();

?>