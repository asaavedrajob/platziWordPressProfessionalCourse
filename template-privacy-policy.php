<?php 
  // Template Name: Page Privacy Policy
  get_header(); 

  $fields = get_fields();
?>

<main class="container">
  <?php 
    if (have_posts()){
      while(have_posts()){
        the_post();
        ?>
          <h1 class="my-3"><?php echo $fields['title']; ?></h1>
          <img src="<?php echo $fields['image']; ?>">
          <hr/>
          <?php the_content(); ?>
        <?php
      }
    }
  ?>
</main>

<?php get_footer(); ?>