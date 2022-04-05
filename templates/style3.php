<div class="tr-container">
    <div class="title-two-colors">
        <?php
            $title = explode(" ", $title, 2);
            echo '<span style="color: #333333">'.$title[0].'</span> '.$title[1];
        ?>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/framework/assets/img/icons/mulheres-media.svg" class="title-icons">
    </div>
    
    <?php
    $i = 0;
    foreach ($post_obj as $key => $post) {
        $postid = $post->ID;
        $unixtimestamp = strtotime( get_field('date') );
        $postDate = date_i18n( "d F, Y", $unixtimestamp );
        $bgurl = get_the_post_thumbnail_url($postid);
        $term_obj_list = get_the_terms($postid, $taxonomy);
        if (!empty($term_obj_list)) {
//             $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
			foreach($term_obj_list as $tax){
				if($tax->term_id != $catlist){
					$terms_string = $tax->name;
					break;
				}
			}
        }

				
		
        if ($i == 1) {
            echo '<div class="tr-row post-inner tr-contents-style3-inner ">'; // start row fo each 3 post
        }

        if ($key == 0) {
            echo '<div class="tr-row post-main tr-contents-style3"><div class="tr-contents-style3-img-container" style="background-image: url('. $bgurl.');"></div>'; // start First section
        } else {
            echo '<div class="tr-col-4">'; // start column section
        }

    ?>

        <div class="content-wrap-3">
            <div class="post-title"><span><?php echo esc_html($post->post_title);  ?></span></div>
            <div class="post-cat"><span><?php echo $terms_string;  ?></span></div>
            <div class="post-date"><?php echo $postDate; ?></div>
        </div>
        

    <?php

        echo '</div>'; // end column div or main div
        if ($i == 3 || ($total_avilable_post == ($key + 1))) {
            echo '</div>'; // end of each 3 row 
            $i = 0;
        }
        $i++;
    }
    ?>
</div>