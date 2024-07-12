<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bellaworks
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyDmgUGFg14uJNzb4dk3V4tTIbsw2qsa7lQ');
}
add_action('acf/init', 'my_acf_init');


function bellaworks_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_front_page() || is_home() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage';
    }

    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

    return $classes;
}
add_filter( 'body_class', 'bellaworks_body_classes' );

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}


function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


function shortenText($string, $limit, $break=".", $pad="...") {
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}

/* Fixed Gravity Form Conflict Js */
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

function get_page_id_by_template($fileName) {
    $page_id = 0;
    if($fileName) {
        $pages = get_pages(array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => $fileName.'.php'
        ));

        if($pages) {
            $row = $pages[0];
            $page_id = $row->ID;
        }
    }
    return $page_id;
}

function string_cleaner($str) {
    if($str) {
        $str = str_replace(' ', '', $str); 
        $str = preg_replace('/\s+/', '', $str);
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
        $str = strtolower($str);
        $str = trim($str);
        return $str;
    }
}

function format_phone_number($string) {
    if(empty($string)) return '';
    $append = '';
    if (strpos($string, '+') !== false) {
        $append = '+';
    }
    $string = preg_replace("/[^0-9]/", "", $string );
    $string = preg_replace('/\s+/', '', $string);
    return $append.$string;
}

function get_instagram_setup() {
    global $wpdb;
    $result = $wpdb->get_row( "SELECT option_value FROM $wpdb->options WHERE option_name = 'sb_instagram_settings'" );
    if($result) {
        $option = ($result->option_value) ? @unserialize($result->option_value) : false;
    } else {
        $option = '';
    }
    return $option;
}

function extract_emails_from($string){
  preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
  return $matches[0];
}

function email_obfuscator($string) {
    $output = '';
    if($string) {
        $emails_matched = ($string) ? extract_emails_from($string) : '';
        if($emails_matched) {
            foreach($emails_matched as $em) {
                $encrypted = antispambot($em,1);
                $replace = 'mailto:'.$em;
                $new_mailto = 'mailto:'.$encrypted;
                $string = str_replace($replace, $new_mailto, $string);
                $rep2 = $em.'</a>';
                $new2 = antispambot($em).'</a>';
                $string = str_replace($rep2, $new2, $string);
            }
        }
        $output = apply_filters('the_content',$string);
    }
    return $output;
}

function get_social_links() {
    $social_types = array(
        'facebook'  => 'fab fa-facebook-square',
        'twitter'   => 'fab fa-twitter-square',
        'instagram' => 'fab fa-instagram',
        'snapchat'  => 'fab fa-snapchat-ghost',
        'youtube'   => 'fab fa-youtube'
    );
    $social = array();
    foreach($social_types as $k=>$icon) {
        $value = get_field($k,'option');
        if($value) {
            $social[$k] = array('link'=>$value,'icon'=>$icon);
        }
    }
    return $social;
}

function insert_teams($isInsert=false) {
    global $wpdb;
    $teams[] = array("Frank Scibelli","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in est velit. Quisque auctor velit ante, vel auctor nisi porta eu. Aliquam rhoncus quam mauris, ac lobortis libero vehicula non. Praesent vitae nisi urna. Morbi laoreet nunc lorem, eget viverra mauris pretium eu.");
    $teams[] = array("Eric Fenner","Pellentesque sed lacinia dolor. Nam eu purus at magna vehicula pretium. Aenean posuere ultricies porttitor. Nullam nulla orci, auctor ut posuere a, interdum ut justo. Praesent lacinia, magna id elementum consequat, mi diam dapibus lectus, ac egestas leo tortor non nisi.");
    $teams[] = array("Stephanie Kalish","Praesent vulputate quam nisi, ac tempus turpis volutpat id. Pellentesque placerat dapibus diam. Aliquam nec tincidunt urna. Nam maximus purus non pellentesque facilisis. Proin sit amet diam odio. Proin eget lobortis enim. Nullam placerat vestibulum ante ut ultrices.");
    $teams[] = array("Taryn Fenner","Nulla mattis libero odio, bibendum porttitor arcu dictum sed. Donec placerat velit mi, non blandit orci elementum vitae. Suspendisse ullamcorper a lacus id lobortis. Curabitur mi dolor, aliquet id tellus at, molestie iaculis lorem. Morbi elementum tempor eleifend.");

    $ids = array();
    if( $isInsert ) {
        foreach($teams as $data) {
            $post_title = $data[0];
            $post_content = $data[1];
            $post_status = 'publish';
            $post_type = 'teams';
            $args = array(
                'post_title'=>$data[0],
                'post_content'=>$data[1],
                'post_status'=>'publish',
                'post_type'=>'teams'
            );

            wp_insert_post( $args );
            $lastid = $wpdb->insert_id;
            $ids[] = $lastid;
        }
    }
    if( $ids ) {
        echo "POST INSERTED!";
    }
}

