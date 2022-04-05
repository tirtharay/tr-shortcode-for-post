<div class="tr-container">
    <div class="tr-row tr-main-row col-rev-mob">
        <div class="tr-col-7 bg-red tr-contents-style2">
            <div style="max-width:780px;float: right;">
            
            <?php
            foreach ($post_obj as $key => $post) {
                $postid = $post->ID;
                $unixtimestamp = strtotime( get_field('date') );
                $postDate = date_i18n( "d F, Y", $unixtimestamp );
                $nome_do_veiculo_jornalistico = get_field( "nome_do_veiculo_jornalistico" );
                $term_obj_list = get_the_terms($postid, $taxonomy);

                if (!empty($term_obj_list)) {
//                     $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
						foreach($term_obj_list as $tax){
						if($tax->term_id != $catlist){
							$terms_string = $tax->name;
							break;
						}
					}
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
                        <div class="thumb-container"><img src="<?php echo get_the_post_thumbnail_url($postid) ?>" /></div>
                    </div>
                </div>
            <?php
                if ($key % 2 == 1 || ($total_avilable_post == ($key + 1))) {
                    echo '</div>';
                }
            }
            ?>
            </div>
            <div class="mais-pesquisadas"><a href="#">VEJA MAIS PESQUISAS <span>&#8594;</span></a></div>
        </div>


        <div class="tr-col-5 tr-bg-img" style="background: url( '<?php echo $bgimg;  ?>' );">
            <div class="bgimgtitle"><?php echo $bgimgtitle;  ?></div>
            <div class="bgimgtitlebtn"><a class="bgimgtitle-btn-text" href="#">VER TODAS<span>&#8594;</span></a></div>

        </div>
    </div>
</div>