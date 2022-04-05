<div class="tr-container">
    <div class="tr-row tr-main-row bg-lightgrey">
        <div class="max-width-1100 tr-contents-style5">
        
            <div class="title-two-colors">
            <?php $title = explode(" ", $title, 2); ?>
            <span style="color: #333333"><?php echo $title[0] ?></span><?php echo $title[1] ?><img src="<?php echo get_stylesheet_directory_uri()?>/framework/assets/img/icons/dados-pesquisas.svg" class="title-icons">
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
//               $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
				foreach($term_obj_list as $tax){
					if($tax->term_id != $catlist){
						$terms_string = $tax->name;
						break;
					}
				}
            }

            if ($key == 0) {
                echo '<div class="tr-col-5" style="background-image: url(' . $bgurl . ');">'; // start First section
                echo '<div class="content-text"><div class=" post-title"><span>' . esc_html($post->post_title) . '</span></div>';
                echo '</div></div>';
                echo '<div class="tr-col-7">'; // start column section
            } else {

                if ($i == 1) {
                    echo '<div class="tr-row">';
                }
                echo '<div class="tr-col-6">';
                echo '<div class="post-main-wrap tr-flex tr-v-top">';
                echo '<div class=" post-title"><span>' . esc_html($post->post_title) . '</span></div>
                <div class="post-cat"><span>' . $terms_string . '</span></div>
                <div class="post-date">' . $postDate . '</div>';
                echo '</div>';
                echo '</div>';
            }


            if ($i == 2 || $total_avilable_post == ($key + 1)) {
                echo '</div>'; // end of each 3 row
                $i = 0;
            }
            $i++;

            
        }
        ?>

        </div>
        <div class="view-more" style="text-align:right"><a href="#">VEJA MAIS DADOS <span>→</span></a></div>
    </div>
</div>