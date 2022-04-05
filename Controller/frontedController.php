<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('frontedController')) {
    class frontedController
    {
        private $shortCodeList;
        public function __construct()
        {
            $this->shortCodeList = ['tr_ftd_cat_posts']; // fill a shortcode 
            $this->load_shortcode(); // load all shortcode list
            add_action('wp_enqueue_scripts', [$this, 'load_tr_scripts']);
        }

        private function load_shortcode()
        {
            $shortcode_list = $this->shortCodeList;
            foreach ($shortcode_list as $shortcode) {
                add_shortcode($shortcode, [$this, $shortcode]);
            }
        }

        public function tr_ftd_cat_posts($atts)
        {
            $post_type = isset($atts['type']) ? $atts['type'] : 'post';
            $total_post = isset($atts['count']) ? $atts['count'] : 4;
            $taxonomy = isset($atts['taxonomy']) ? $atts['taxonomy'] : 'category';
            $style = isset($atts['style']) ? $atts['style'] : 1;
            $catlist = isset($atts['catid']) ? $atts['catid'] : '';
            $title = isset($atts['title']) ? $atts['title'] : '';
            $bgimg = isset($atts['bgimg']) ? $atts['bgimg'] : '';
            $bgimgtitle = isset($atts['bgimgtitle']) ? $atts['bgimgtitle'] : '';


            // buit query
            $args = array(
                'post_type' => $post_type,
                
                'posts_per_page' => $total_post
            );

            if (!empty($catlist)) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => $catlist,
                    )
                );
            }

            $query = new WP_Query($args);
            $post_obj = $query->posts; // list of all posts 

            $css = file_get_contents(TR_PATH . "assets/css/main.css");
            if (!empty($post_obj)) {
                $total_avilable_post = count($post_obj);
                if (file_exists(TR_PATH . "assets/css/style" . $style . ".css")) {
                    $css .= file_get_contents(TR_PATH . "assets/css/style" . $style . ".css");
                }

                ob_start();
                echo '<style>' . $css . '</style>';
                if (file_exists(TR_PATH . "templates/style" . $style . ".php")) {
                    require TR_PATH . "templates/style" . $style . ".php";
                } else {
                    return '<div class="tr-nppost-found"><span>' . __('Missing template File', 'tr-post-list') . '</span></div>';
                }
                return ob_get_clean();
            } else {
                return '<div class="tr-nppost-found"><span>' . __('Não tem nenhuma postagem', 'tr-post-list') . '</span></div>';
            }
        }

        public function load_tr_scripts()
        {
            wp_enqueue_style('tr-slick-carousel', TR_URL . 'assets/css/slick.css');
            wp_enqueue_style('tr-slick-theme-carousel', TR_URL . 'assets/css/slick-theme.css');
            wp_enqueue_style('tr-carousel', TR_URL . 'assets/css/owl.min.css');
            wp_enqueue_script('tr-carousel', TR_URL . 'assets/js/owl.min.js', array(), time(), true);
            wp_enqueue_script('tr-slick-carousel', TR_URL . 'assets/js/slick.min.js', array(), time(), true);
            wp_enqueue_script('tr-main', TR_URL . 'assets/js/main.js', array(), time(), true);
        }
    }
    new frontedController();
}



