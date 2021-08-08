<?php get_header(); ?>

<main class="container my-3">
  <?php 
    if (have_posts()){
      while(have_posts()){
        the_post();
        ?>
          <h1 class="my-3"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        <?php
      }
    }
  ?>

  <div class="product-list my-5">
    <h2 class="text-center">All Products</h2>

    <div class="row">
      <?php
        // 'post_type' => 'my_product' -> this has to be the same name we used when we register_post_type in the functions.php file
        // 'post_per_page' => -1 -> how many items will return, -1 means all in one page
        // 'order' => 'ASC' -> the order in which the query will be sorted, y default is 'DESC'
        // 'orderby' => 'title' -> the field that will be used to sort the query, by default is 'date' which means creation date
        $args = array (
          'post_type' => 'my_product',
          'post_per_page' => -1,
          'order' => 'ASC',
          'orderby' => 'title'
        );

        // WP_Query($args) -> will allow use to bring our Custom Post Type that we created in our functions.php file, and which is possible due to we specify 'publicly_queryable' => true as an attribute of our CPT
        $products = new WP_Query($args);

        if ($products -> have_posts()){
          while($products -> have_posts()){
            $products -> the_post();
            ?>
              <div class="col-4">
                <figure>
                  <?php the_post_thumbnail('large'); ?>
                </figure>
                <h4 class="my-3 text-center">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
              </div>
            <?php
          }
        }
      ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>