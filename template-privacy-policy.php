<?php 
  // In order to have this template available in our Page Editor, we must add the following comment => Template n(a)me: <the name we want to assign to the template, this could be any but it is recommendable to assign one that it is accordly to the page in which will be used>
  // Template Name: Page Privacy Policy
  get_header(); 

  // get_fields() -> is a method given by Advanced Custom Fields plugin and this will allow us to bring the custom fields we created for this Page Template
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