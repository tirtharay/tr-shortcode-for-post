<div class="tr-container">
    <div class="owl-carousel tr-carousel owl-theme">
        <?php
        foreach ($post_obj as $key => $post) {
            $postid = $post->ID;
            $unixtimestamp = strtotime( get_field('date') );
            $postDate = date_i18n( "d F, Y", $unixtimestamp );
            $bgurl = get_the_post_thumbnail_url($postid);
            $nome_do_veiculo_jornalistico = get_field( "nome_do_veiculo_jornalistico" );
            $term_obj_list = get_the_terms($postid, $taxonomy);
            if (!empty($term_obj_list)) {
//                 $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
					foreach($term_obj_list as $tax){
					if($tax->term_id != $catlist){
						$terms_string = $tax->name;
						break;
					}
				}
            }

        ?>
            <div class="item tr-single-item">
                <div class="tr-contents-style1">
                    <div class="post-title"><span><?php echo wp_trim_words ( esc_html($post->post_title) , 16, '');  ?></span></div>
                    <div class="post-cat"><span><?php echo $terms_string;  ?></span></div>
                    <div class="post-date"><span><?php echo $postDate; ?> <?php $nome_do_veiculo_jornalistico ?></span></div>
                </div>
                <div class="tr-contents-style-img-container" style="background-image: url('<?php echo $bgurl; ?>');"></div>

            </div>
        <?php  }
        ?>
    </div>
</div>