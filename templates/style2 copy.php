<div class="tr-container">
    <?php
    foreach ($post_obj as $key => $post) {
        $postid = $post->ID;
        $postDate = $postDate = date("d F Y", strtotime($post->post_date));
        $term_obj_list = get_the_terms($postid, $taxonomy);
        if (!empty($term_obj_list)) {
            $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
        }

        if ($key % 2 == 0) {
            echo '<div class="tr-row">';
        }
    ?>
        <div class="tr-col-6"> 
            <div class="post-main-wrap tr-flex tr-v-center">
                <div class="post-title"><span><?php echo $post->post_title;  ?></span></div>
                <div><img src="<?php echo get_the_post_thumbnail_url($postid) ?>" /></div>
                <div class="post-cat"><?php echo $terms_string;  ?></div>
                <div class="post-date"><?php echo $postDate; ?></div>
            </div>              
        </div>
    <?php
        if ($key % 2 == 1 || ($total_avilable_post == ($key + 1))) {
            echo '</div>';
        }
    }
    ?>
</div>