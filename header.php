<!DOCTYPE html>
<html lang="en" class="h-100">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
  </head>
  <body class="d-flex flex-column h-100">
    
    <header>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-4">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="logo">
          </div>
          <div class="col-8">
            <nav>
              <?php wp_nav_menu(
                  array(
                    'theme_location' => 'my_top_menu',
                    'menu_class' => 'main-menu',
                    'container_class' => 'container-menu'
                  )
                  ); ?>
            </nav>
          </div>
        </div>
      </div>
    </header>
  