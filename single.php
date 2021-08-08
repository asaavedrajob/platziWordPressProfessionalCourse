<?php get_header(); ?>

<main class="container my-3">
  <?php 
    if (have_posts()){
      while(have_posts()){
        the_post();
        ?>
          <h1 class="my-3"><?php the_title(); ?></h1>

          <div class="row">
            <div class="col-4">
              <?php the_post_thumbnail('large'); ?>
            </div>
            <div class="col-8">
              <?php the_content(); ?>
            </div>
          </div>

          <?php 
            // This will allow us to use 'partials' which is code that could be re-used in other parts of the code
            // 'template-parts/post' => is the location of the file
            // 'navigation' => is the last part of the file name, due to we could have several files starting with the word 'post', we only have to add the word 'navigation' to identify the file we want to use here. The extension file is not necesary here.
            get_template_part('template-parts/post','navigation') 
          ?>
        <?php
      }
    }
  ?>
</main>

<?php get_footer(); ?>