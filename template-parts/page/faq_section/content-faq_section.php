<?php 
    /*
    * Template Part Name    : FAQ Section
    * Flexbile Layout Key   : faq_section
    */
    global $is_preview;
    $faq_list           = get_sub_field('faq_list');

    if (have_rows('faq_list')) : ?>
        <section class="faq-page <?php echo ($is_preview) ? ' acf-admin-preview' : ''; ?>">
            <div class="container">
                <div class="title-wrapper text-center">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="faq">
                    <?php while (have_rows('faq_list')) : the_row();
                        $question = get_sub_field('faq_title');
                        $answer   = get_sub_field('faq_content'); ?>
                        <div class="single-faq">
                            <h6 class="question"><?php echo esc_html($question); ?></h6>
                            <div class="answercont">
                                <div class="answer">
                                    <?php echo wp_kses_post($answer); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>