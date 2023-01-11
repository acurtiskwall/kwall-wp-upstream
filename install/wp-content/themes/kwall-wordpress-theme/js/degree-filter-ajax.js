(function($){
  $(document).ready(function(){
    $(document).on('click', '.js-filter-item > a', function(e){
      e.preventDefault();

      var category = $(this).data('category'),
          search = $("#search-input-degree-page").val();
          
      $.ajax({
        url: ajax_url,
        data: {
          action: 'filter',
          category: category,
          search: search,
        },
        type:'post',
        success: function(result) {
          $('.js-filter').html(result);
        },
        error: function(result) {
          console.warn(result);
        }
      });
    });
    $('.filter-toggle').on('click', function() {
      $('.filter-toggle').removeClass('active');
      $(this).addClass('active');
        });

    $(document).on('click','#submit-button-degree-page',function(e) {
      e.preventDefault();
      var category = $(".js-filter-item.filter-toggle.degree_cat.active").data('category'),
          search = $("#search-input-degree-page").val();

      $("#submit-button-degree-page").text("Searching...");

      $.ajax({
        url: ajax_url,
        data: {
          action: 'filter',
          category: category,
          search: search,
        },
        type:'post',
        success: function(result) {
          $('.js-filter').html(result);
        },
        error: function(result) {
          console.warn(result);
        },
        complete: function (xhr) {
          $("#submit-button-degree-page").text("Search");
        },
      });    

    })

    $(document).on('click','#reset_degree_cat_filter',function(e) {
      e.preventDefault();
      reset_degree_search();
    });

    $(document).on('click','#reset-button-degree-page',function(e) {
      e.preventDefault();
      reset_degree_search();
    });

});
})(jQuery);


function reset_degree_search() {
  jQuery("#search-input-degree-page").val("");
  jQuery(".js-filter-item").removeClass("active");
  var category = '',
      search = '';
  jQuery.ajax({
    url: ajax_url,
    data: {
      action: 'filter',
      category: category,
      search: search,
    },
    type:'post',
    success: function(result) {
      jQuery('.js-filter').html(result);
    },
    error: function(result) {
      console.warn(result);
    }
  }); 
}