<?php get_header(); ?>

<main class="container my-3">
  <?php 
    if (have_posts()){
      while(have_posts()){
        the_post();
        ?>
          <h1 class="my-3"><?php the_title(); ?></h1>

          <div class="row mb-5">
            <div class="col-4">
              <?php the_post_thumbnail('large'); ?>
            </div>
            <div class="col-8">
              <?php the_content(); ?>
            </div>
          </div>

          <?php
            $args = array(
              'post_type' => 'my_product',
              'post_per_page' => 6,
              'order' => 'ASC',
              'orderby' => 'title'
            );

            $my_products = new WP_Query($args);
          ?>

          <?php if ($my_products -> have_posts()){ ?>
              <div class="row justify-content-center pt-5 related-products">
                <h3 class="text-center">Related Products</h3>
                <?php while($my_products -> have_posts()){ ?>
                  <?php $my_products -> the_post(); ?>
                  <div class="col-2 my-3">
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <h4 class="my-3 text-center">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                  </div>
                <?php } ?>
              </div>
          <?php } ?>
        <?php
      }
    }
  ?>
</main>

<?php get_footer(); ?>