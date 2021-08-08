(function ($) {
  console.info("Hello WP!");

  // .change -> will listen when a new option is selected on the dropdown
  $(".js-my-products-categories").change(function () {
    $.ajax({
      url: myObject.ajaxurl, // myObject -> nam registered in wp_localize_script
      method: "POST",
      data: {
        action: "filter_for_my_products", // filter_for_my_products -> name of the FN registered on the Hook wp_ajax_nopriv_filter_for_my_products and wp_ajax_filter_for_my_products
        category_to_filter: $(this).find(":selected").val(), // This will give us the selected category on the dropdown
      },
      beforeSend: function () {
        $(".js-my-products-list").html("Loading...");
      },
      success: function (data) {
        let html = "";

        // item -> is the result of the WP_Query executed on the FN filter_for_my_products and it has the props of image, link and title
        data.forEach((item) => {
          html += `
            <div class="col-4">
              <figure>${item.image}</figure>
              <h4 class="my-3 text-center">
                <a href="${item.link}">${item.title}</a>
              </h4>
            </div>
          `;
        });

        $(".js-my-products-list").html(html);
      },
      error: function () {
        console.error(error);
      },
    });
  });
})(jQuery);
