<?php get_header(); ?>

<main class="container my-3">
  <?php 
    if (have_posts()){
      while(have_posts()){
        the_post();

        // get_the_ID() -> will bring the ID of the current Post
        // 'category-my-products' -> is the taxonomy name that we specified on register_taxonomy FN
        $my_taxonomy = get_the_terms(get_the_ID(), 'category-my-products');
        ?>
          <h1 class="my-3"><?php the_title(); ?></h1>

          <div class="row mb-5">
            <div class="col-6">
              <?php the_post_thumbnail('large'); ?>
            </div>
            <div class="col-6">
              <?php 
                // do_shortcode -> will allow us to call any plugin shortcode and use it in any custom view we want
                echo do_shortcode('[contact-form-7 id="50" title="Contact form My Product item"]') 
              ?>
            </div>
            <div><?php the_content(); ?></div>
          </div>

          <?php
            // 'tax_query' => array(...) -> will allow us to filter our query based on a taxonomy
            // 'taxonomy' => 'category-my-products' -> is the taxonomy name that we specified on register_taxonomy FN
            // 'field' => 'slug' -> which field will be used to filter the results
            // 'terms' => $my_taxonomy[0] -> slug -> the taxonomy slug value of the current Post
            $args = array(
              'post_type' => 'my_product',
              'post_per_page' => 6,
              'order' => 'ASC',
              'orderby' => 'title',
              'tax_query' => array(
                array(
                  'taxonomy' => 'category-my-products',
                  'field' => 'slug',
                  'terms' => $my_taxonomy[0] -> slug
                )
              )
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