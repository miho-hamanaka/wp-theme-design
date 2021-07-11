<?php get_header(); ?>

<div id="contents" class="wrapper">
  <ul class="breadcrumb clearfix">
    <li><a href="#">TOP</a></li>
    <?php if (!(is_home() || is_front_page())): ?>
    <div class="breadcrumb-area">
    <?php
    if (function_exists('bcn_display')) {
        bcn_display();
    }
    ?>
    </div>
    <?php endif; ?>
  </ul>
  <!-- パンクズ -->
  <div class="global-container">
    <main id="contents_right" class="single-container">
      <section class="single">
      <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <h1 class="title"><?php the_title(); ?> </h1>
        <div class="post-date"><i class="far fa-clock"></i><?php the_date('Y年m月j日'); ?></div>
        <div class="content">
          <div class="icatch">
              <?php the_post_thumbnail(); ?>
              <?php the_category(); ?>
          </div>
        <?php the_content(); ?>
        </div>
      <?php endwhile; endif; ?>
      </section>
    </main>
    <div class="display-sp"><?php the_post_navigation(); ?> </div>
    <?php get_sidebar(); ?>
  </div>
  <div class="display-none"><?php the_post_navigation(); ?> </div>
</div>
<?php get_footer(); ?>
