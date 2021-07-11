<?php get_header(); ?>

<div id="contents" class="wrapper">
  <ul class="breadcrumb clearfix">
    <li><a href="#">TOP</a></li>
    <li ><a class="breadcrumb-active" href="<?php echo esc_url(home_url('/')); ?>">コラム</a> </li>
  </ul>
  <!-- パンクズ -->
  <div class="global-container">
    <main id="contents_right" class="posts">
      <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
          <div class="post">
            <div class="thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a><br>
              <?php the_category(); ?>
            </div>
            <div class="detail">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="post-date"><i class="far fa-clock"></i><?php the_time('Y年m月j日'); ?></p>
                <?php
                if (mb_strlen($post->post_content, 'UTF-8') > 80) {
                    $content = str_replace('\n', '', mb_substr(strip_tags($post->post_content), 0, 80, 'UTF-8'));
                    echo $content.'…';
                } else {
                    echo str_replace('\n', '', strip_tags($post->post_content));
                }
                ?>
            </div>
          </div>
          <?php endwhile; ?>
          <?php
            /* 以下、ページャーの表示 */
            if (function_exists('pagination')) :
              pagination($wp_query->max_num_pages, get_query_var('paged'));
            endif;
          ?>
      <?php else : ?>
        <h3>記事がありません</h3>
        <p>表示する記事はありませんでした。</p>
      <?php endif; ?>
    </main>
    <!--.posts-->

    <?php get_sidebar(); ?>
  </div>

</div>

<?php get_footer(); ?>