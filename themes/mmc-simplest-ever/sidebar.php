<?php 
/*
Template Part - Sidebar
The basic blog sidebar
*/ 
?>
<aside class="sidebar">
    <section id="categories" class="widget">
        <h3 class="widget-title"> Categories </h3>
        <ul>
            <?php 
            //show the most popular 10 categories
            wp_list_categories(array(
                'show_count'    => true,
                'depth'         => -1,
                'orderby'       => 'count',
                'order'         => 'desc',
                'number'        => 10,
                'title_li'      => '',
            )); ?>
        </ul>
    </section>
    <section id="archives" class="widget">
        <h3 class="widget-title"> Archives </h3>
        <ul>
            <?php 
            //show yearly archives
            wp_get_archives(array(
                'type' => 'yearly',
                'limit' => 5,
                'show_post_count' => true,
            )); ?>
        </ul>
    </section>
    <section id="tags" class="widget">
        <h3 class="widget-title"> Tags </h3>
        <?php 
        //show the most popular 20 tags
        wp_tag_cloud( array(
            'format'        => 'list', //list or flat
            'smallest'      => 1,
            'largest'       => 1,
            'unit'          => 'em',
            'show_count'    => true,
            'orderby'       => 'count',
            'order'         => 'DESC',
            'number'        => 20,
        ) ); ?>
    </section>
    <section id="meta" class="widget">
        <h3 class="widget-title"> Meta </h3>
        <ul>
            <li><a href="#">Site Admin</a></li>
            <li><a href="#">Log out</a> </li>
        </ul>
    </section>
</aside>
<!-- end .sidebar -->