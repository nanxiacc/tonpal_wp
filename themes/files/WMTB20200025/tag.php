<?php

/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
global $wp_query, $wp, $post;
$paged = get_query_var('paged');
$max = intval($wp_query->max_num_pages);
$tagName = single_tag_title('', false);
// 当前页面url
$page_url = get_lang_page_url();

$theme_vars = json_config_array('header', 'vars', 1);
$inquiryBtn = ifEmptyText($theme_vars['inquiryBtn']['value'])

?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $tagName; ?><?php if ($paged > 1) printf('–%s', $paged); ?></title>

    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php if ($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts(); ?>" />
    <?php } ?>
    <?php if ($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>

    <?php get_template_part('templates/components/head'); ?>


</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->

        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->

                <!-- main begin -->
                <section class="main index_tags">
                    <div class="items_list">
                        <?php if (have_posts()) { ?>
                            <ul>
                                <?php while (have_posts()) {
                                    the_post();
                                    $category = get_the_category();
                                    $cid = $category[0]->cat_ID;
                                    $pid = get_category_root_id($cid);
                                    $the_slug = get_category($pid)->slug;
                                    if ($the_slug == 'product') {
                                        $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true);
                                        $tags = get_the_tags($post->ID);

                                ?>
                                        <li class="blog-item">
                                            <figure class="item-wrap">
                                                <a href="<?php the_permalink()  ?>" class="item-img"><img src="<?php echo $thumbnail ?>_thumb_220x220.jpg" alt="<?php the_title(); ?>" />
                                                    <!-- <span class='right_top_icon'><?php echo ucfirst($the_slug) . ' Info' ?></span> -->
                                                </a>
                                                <figcaption class="item-info post-tags">
                                                    <a href="<?php the_permalink()  ?>" class='inquiry_btn'><?php echo $inquiryBtn; ?></a>
                                                    <h3 class="item-title">
                                                        <a href="<?php the_permalink()  ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="item-detail"><?php the_excerpt(); ?></div>
                                                    <div class="tags">
                                                        <?php foreach ($tags as $item) { ?>
                                                            <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name ?></a>
                                                        <?php } ?>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                            <?php wpbeginner_numeric_posts_nav(); ?>
                        <?php } ?>
                    </div>

                    <!-- inquiry form -->
                    <?php get_template_part('templates/components/send-message'); ?>
                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<!-- <?php get_template_part('templates/components/microdata') ?> -->

</html>