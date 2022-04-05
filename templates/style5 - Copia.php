<div class="tr-container">
    <div class="tr-row tr-main-row bg-lightgrey">
        <div class="max-width-1100 tr-contents-style5">
        
        <div class="title-two-colors">
        <?php $title = explode(" ", $title, 2); ?>
		<span style="color: #333333"><?php echo $title[0] ?></span><?php echo $title[1] ?><img src="<?php echo get_stylesheet_directory_uri()?>/framework/assets/img/icons/dados-pesquisas.svg" class="title-icons">
		</div>

        <div class="tr-col-5 tr-bg-img" style="background: url( '<?php echo $bgimg;  ?>' );">
            <div class="bgimgtitle"><?php echo $bgimgtitle;  ?></div>
            <div class="bgimgtitlebtn"><a class="bgimgtitle-btn-text" href="#">VEJA TODOS &#8594;</a></div>

        </div>

        <div class="tr-col-7">

            
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
                    <div class="post-main-wrap tr-flex tr-v-top">
                        <div>
                            <div class="post-title"><span><?php echo wp_trim_words ( esc_html($post->post_title) , 16, '');  ?></span></div>
                            <div class="post-cat"><?php echo $terms_string;  ?></div>
                            <div class="post-date"><?php echo $postDate; ?></div>
                        </div>
                    </div>
                </div>
            <?php
                if ($key % 2 == 1 || ($total_avilable_post == ($key + 1))) {
                    echo '</div>';
                }
            }
            ?>
            <div class="view-more" style="text-align:right"><a href="#">VEJA MAIS DADOS &#8594;</a></div>

            
        </div>
        </div>
    </div>
</div>