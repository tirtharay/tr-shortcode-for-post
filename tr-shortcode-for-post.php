<?php

/**
 * Plugin Name: TR Shortcode For Displaying Post
 * Description: A plugin that help you to display posts
 * Version: 1.0
 * Author: Tirtha ray 
 * Text Domain: tr-post-list
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!defined('TR_PATH')) {
    define('TR_PATH', plugin_dir_path(__FILE__));
}
if (!defined('TR_URL')) {
    define('TR_URL', plugin_dir_url(__FILE__));
}

// int plugin
require_once 'inc/inc.php';


// =======================================================

// function that runs when shortcode is called
function wpb_demo_shortcode()
{

	ob_start();

	echo '<div class="tr-container">';
	echo '<div class="tr-row max-width-1100">';
	echo '

	<div class="title-two-colors" style="margin-bottom:30px">
	<span style="color: #333333">REDES</span> SOCIAIS
	<img src="http://localhost/ipg/wp-content/themes/ipg/framework/assets/img/icons/redes-sociais.svg" class="title-icons">
	</div>
	';
	echo '<div class="redesocias-item-container">';
	/*
		Instagram Timeline HERE : START
	*/

	// query the user media
	$fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username";
	$token = "IGQVJWNlVlNS12VS05QXRxZAXAyRlF4ZAVNDbmNpcEdxbHM5RE54cFlUNW1RSEtQSmdkX05uSExkUkZAlUkowZAkM4eEVSV1VpX3dWV01iWFl2RU4xMGxnNDM5WUN3Q1FUZAlg4WnROMkp2RF9GazhtR3MtSwZDZD";
	$limit = 10;

	$json_feed_url = "https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
	$json_feed = @file_get_contents($json_feed_url);
	$contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);

	echo "<div class='ig_feed_container'>";
	foreach ($contents["data"] as $post) {

		$username = isset($post["username"]) ? $post["username"] : "";
		$caption = isset($post["caption"]) ? $post["caption"] : "";
		$media_url = isset($post["media_url"]) ? $post["media_url"] : "";
		$permalink = isset($post["permalink"]) ? $post["permalink"] : "";
		$media_type = isset($post["media_type"]) ? $post["media_type"] : "";

		echo "
            <div class='ig_post_container'>
                <div>";

		if ($media_type == "VIDEO") {
			echo "<video controls style='width:100%; display: block !important;'>
                            <source src='{$media_url}' type='video/mp4'>
                            Your browser does not support the video tag.
                        </video>";
		} else {
			echo "<img src='{$media_url}' />";
		}

		echo "</div>
                <div class='ig_post_details'>
                    <div>
                        <strong>@{$username}</strong> {$caption}
                    </div>
                    <div class='ig_view_link'>
                        <a href='{$permalink}' target='_blank'>View on Instagram</a>
                    </div>
                </div>
            </div>
        ";
	}
	echo "</div>";

	/*
		Instagram Timeline HERE : END
	*/

	

	/*
		Facebook Timeline HERE : START
	*/

	// Things that you want to do.
	echo '<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=1615612418754886&autoLogAppEvents=1" nonce="qT4NFHRc"></script>';

	echo '<div class="fb-page" data-href="https://www.facebook.com/ipatriciagalvao" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ipatriciagalvao" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ipatriciagalvao">Agência Patrícia Galvão</a></blockquote></div>';


	/*
		Facebook Timeline HERE : END
	*/

	/*
		Twitter Timeline HERE : START
	*/
	echo '<div id="twitter-data"><a class="twitter-timeline" href="https://twitter.com/ipatriciagalvao?ref_src=twsrc%5Etfw">Tweets by parth_twitte</a></div><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';
	/*
		Twitter Timeline HERE : END
	*/

	echo '</div>';
	echo '</div>';
	echo '</div>';

	// Output needs to be return
	return ob_get_clean();
}
// register shortcode
add_shortcode('greeting', 'wpb_demo_shortcode');
