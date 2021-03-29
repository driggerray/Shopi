<?php wp_enqueue_script( 'jquery-cookie'); ?>
<?php wp_enqueue_script( 'shopwise-subscribe-popup'); ?>

<div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
                <div class="row no-gutters">
                    <div class="col-sm-5">
						<?php $popup_image = wp_get_attachment_url(get_theme_mod( 'shopwise_subscribe_popup_image' )); ?>
						<?php if($popup_image){ ?>
							<div class="background_bg h-100" data-img-src="<?php echo esc_url($popup_image); ?>"></div>
						<?php } ?>
                    </div>
                    <div class="col-sm-7">
                        <div class="popup_content">
                            <div class="popup-text">
                                <div class="heading_s1">
                                    <h4><?php echo esc_html(get_theme_mod('shopwise_subscribe_popup_title')); ?></h4>
                                </div>
                                <p><?php echo esc_html(get_theme_mod('shopwise_subscribe_popup_subtitle')); ?></p>
                            </div>
                            <?php echo do_shortcode('[mc4wp_form id="'.get_theme_mod('shopwise_subscribe_popup_formid').'"]'); ?>
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input dontshow"  type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3"><span><?php esc_html_e('Don\'t show this popup again!','shopwise'); ?></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>