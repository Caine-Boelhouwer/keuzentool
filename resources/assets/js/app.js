$(document).foundation();

$(document).on('ready', init());

function init() {
  /***
   * General
   */
  if ($('#session_toast').length != 0) {
    activateToast('#session_toast', 'active', null);
  }

  if ($('.confirm_reveal_trigger').length != 0) {
    confirmRevealTrigger();
  }

  if ($('.result_explanation').length != 0) {
    $('.result_explanation .explanation').on('click', function(e) {
      e.preventDefault();

      $('.result_explanation p').fadeToggle(300, 'linear');
    });
  }

  if ($('#contact_reveal').hasClass('active')) {
    $('#contact_reveal').foundation('open');
  }

  if ($('.custom_form_container').length != 0) {
    var $form = $('.custom_form_container'),
    origForm = $form.serialize();

    $('.custom_form_container :input').on('change input', function() {
      $(window).on('beforeunload', function () {
        if ($form.serialize() !== origForm) {
          return 'You haven\'t saved your changes.';
        }
      });
    });
  }

  $('#save_form').on('click', function(e) {
    $(window).off('beforeunload');
    e.preventDefault();
    $('#send_mail').val(0);
    $('.custom_form_container').submit();
  });


  /***
  * Toggle menu
  */
  $('#toggle_side_menu').on('click', function(e) {
    e.preventDefault();

    $('.side_menu').toggleClass('active');
  });

  if ($('.date_picker').length > 0) {
    $('.date_picker').fdatepicker({
      format: 'dd-mm-yyyy',
      disableDblClickSelection: true,
      leftArrow:'<',
      rightArrow:'>',
      closeButton: false,
      pickTime: false,
      weekStart: 1,
      startDate: null,
    });
  }


  /***
  * Avatar
  */
  if ($('#upload_file_avatar').length != 0) {
    $("#upload_file_avatar").change(function() {
      if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.avatar_preview').css('background-image', 'url('+e.target.result+')');
        }
        reader.readAsDataURL(this.files[0]);
      }
    });
  }


  /***
  * Insulation image
  */
  if ($('#upload_file_insulation_image').length != 0) {
    $("#upload_file_insulation_image").change(function() {
      if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.insulation_image_preview').css('background-image', 'url('+e.target.result+')');
        }
        reader.readAsDataURL(this.files[0]);
      }
    });
  }


  /***
  * Bulk archive event
  */
  $('#bulk_archive').on('click', function(e){
    // Prevent actual form submission
    e.preventDefault();

    var form = $('#table_form');
    var rows_selected = table.column(0).checkboxes.selected();

    if (rows_selected.length > 0) {
      $('input[name="id\[\]"]', form).remove();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
        // Create a hidden element
        $(form).append(
          $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'id[]')
            .val(rowId)
        );
      });

      $('#table_form').submit();
    }
  });

  /***
  * Datatables
  */
  if ($('#overview_table').length != 0) {
    var table = '';
    $.fn.dataTable.moment('DD-MM-YYYY');

    var sort_column = ($('.default-sort').length != 0) ? [$('th.default-sort').index(), 'asc'] : [0, 'asc'];
    // var sort_column = [0, 'asc'];

    var table = $('#overview_table').DataTable({
      responsive: true,
      paging: true,
      info: false,
      lengthMenu: [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
      pageLength: 10,
      order: [sort_column],
      dom: 'rt<"bottom"lp>',
      buttons: [],
      columnDefs: [
        {
           targets: 'multi-select',
           sortable: false,
           searchable: false,
           checkboxes: {
              selectRow: false
           }
        },
        {
          targets: 'no-sort',
          sortable: false,
          searchable: false,
        },
        {
            targets: 'hidden-filter',
            visible: false,
            searchable: true,
        },
      ],
      select: {
        style: 'multi'
      },
      language: {
          url: '/language/datatables.custom.json'
      },
      initComplete: function(settings) {
        $('.spinner').fadeOut(200, function() {
          $(this).remove();
          $('#overview_table').css('opacity', 1);
          $('#overview_table_wrapper').css('opacity', 1);
        });
      }
    });
  } else {
    $('.spinner').fadeOut(200, function() {
      $(this).remove();
      $('.custom_form').css('opacity', 1);
    });
  }

  $('#table_searchbar').on('keyup', function () {
      table.search(this.value).draw();
  });

  $('#switch_for_active').on('change', function() {
    if(this.checked){
      $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
          return $(table.row(dataIndex).node()).attr('data-status') == 1;
        }
      );
      table.draw();
    }else{
      $.fn.dataTable.ext.search.pop();
      table.draw();
    }
  });
}

function activateToast(selector, classes, content) {
  if (content != null) {
    $(selector+' h6').html(content);
  }

  $(selector).addClass(classes);

  setTimeout(function(){
    $(selector).removeClass(classes);
  }, 6000);
}

function confirmRevealTrigger() {
  $('.confirm_reveal_trigger').on('click', function() {
    var reveal_title = $(this).data('reveal-title');
    var reveal_content = $(this).data('reveal-content');
    var reveal_link = $(this).data('reveal-link');

    $('#reveal_title').html(reveal_title);
    $('#reveal_content').html(reveal_content);
    $('#reveal_confirm').attr('href', reveal_link);

    $('#confirm_reveal').foundation('open');
  })
}
