$(document).ready(function () {
  $('.edit-submit').click(function () {

    $('.editForm').submit()
  })
})

$(document).ready(function () {
  // Datatables
  $('#myDataTable').DataTable ( {
    columnDefs: [
      {
        targets: [ 0, 1, 2 ],
        className: 'mdl-data-table__cell--non-numeric'
      }
    ]
  } )
})

$(document).ready(function () {
  $(".editPerm").hide();
})


$(document).ready(function (){
  

  // Initialise tooltips
  $('.tooltipped').tooltip();

  // User trying to delete record
  $('a#delnow').click(function () {
    // alert('something')
    if (confirm('Are You Sure To delete this record, You will never recover it again')) {
      return true
    }
    return false
  })

  // Modal Trigger For addind record
  $('#trigger').click(function () {
    $('.modal').modal()
  })

  $('#view').click(function () {
    $('.modall').modal()
  })

  // Intialize select box
  $('select').formSelect()

  // Initialise floating botton
  $('.fixed-action-btn').floatingActionButton()



  // Dropdown
  $('.dropdown-trigger').dropdown();

})

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.fixed-action-btn');
  var instances = M.FloatingActionButton.init(elems, {
    direction: 'left'
  })
})


$(document).ready(function(){

  $(".dropdown-button").dropdown();
  // side nav
  $(".button-collapse").sideNav();
  // select
  $('select').material_select();
  // modal
  $('#modal1').modal();
  // modal for help
  $('#modal2').modal();
  // DELETE using link
  $(function () {
    $('.data-delete').on('click', function (e) {
      if (!confirm('Are you sure you want to delete?')) return;
      e.preventDefault();
      $('#form-delete-' + $(this).data('form')).submit();
    });
  });
  // SHARE using link
  $(function () {
    $('.data-share').on('click', function (e) {
      if (!confirm('Are you sure you want to share?')) return;
      e.preventDefault();
      $('#form-share-' + $(this).data('form')).submit();
    });
  });
  // calendar
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false, // Close upon selecting a date,
    format: 'yyyy-mm-dd' // format the date
  });
  // search
  $(function() {
    $('#search').keypress(function(e) {
      if (e.which == 13) {
        console.log('enter pressed');
        e.preventDefault();
        $('#search-form').submit();
      }
    })
  });
  // sort
  $(function() {
    $('#sort').change(function(e) {
      console.log('select changed');
      $('#sort-form').submit();
    });
  });
});

// <!-- data tables -->
$(document).ready(function(){
  $('#myDataTable').DataTable({
    "paging": false,
    "dom": '<"right"i>r<"left"f><"clear">'
  });
});

// <!-- for spinner -->

document.addEventListener("DOMContentLoaded", function(){
$('.preloader-background').delay(1000).fadeOut('slow');

$('.preloader-wrapper')
  .delay(1000)
  .fadeOut();
});

// <!-- sideNav -->

$('.button-collapse').sideNav({
  menuWidth: 300, // Default is 300
  edge: 'left', // Choose the horizontal origin
  closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
  draggable: true, // Choose whether you can drag to open on touch screens,
}
);

// <!-- enable/disable based on checkbox -->
$(function () {
  $("#isExpire").click(function () {
    if ($(this).is(":checked")) {
      $("#expirePicker").attr("disabled","disabled");
      $("#expirePicker").focus();
    } else {
      $("#expirePicker").removeAttr("disabled");
    }
  });
});

// <!-- collapsible -->

$(document).ready(function(){
$('.collapsible').collapsible();
});

// <!-- for checkbox multiple delete -->

$(document).ready(function () {

  $('#master').on('click', function(e) {
    if($(this).is(':checked',true))
    {
      $(".sub_chk").prop('checked', true);
    } else {
      $(".sub_chk").prop('checked',false);
    }
  });

  $('.delete_all').on('click', function(e) {

    var allVals = [];
    $(".sub_chk:checked").each(function() {
      allVals.push($(this).attr('data-id'));
    });

    if(allVals.length <=0)
    {
      alert("Please select.");
    }  else {

      var check = confirm("Are you sure you want to delete these?");
      if(check == true){

        var join_selected_values = allVals.join(",");

        $.ajax({
          url: $(this).data('url'),
          type: 'DELETE',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: 'ids='+join_selected_values,
          success: function (data) {
            if (data['success']) {
              $(".sub_chk:checked").each(function() {
                $(this).parents("tr").remove();
              });
              alert(data['success']);
            } else if (data['error']) {
              alert(data['error']);
            } else {
              alert('Whoops Something went wrong!!');
            }
          },
          error: function (data) {
            alert(data.responseText);
          }
        });

        $.each(allVals, function( index, value ) {
          $('table tr').filter("[data-row-id='" + value + "']").remove();
        });
      }
    }
  });

  $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
      element.trigger('confirm');
    }
  });

  $(document).on('confirm', function (e) {
    var ele = e.target;
    e.preventDefault();

    $.ajax({
      url: ele.href,
      type: 'DELETE',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function (data) {
        if (data['success']) {
          $("#" + data['tr']).slideUp("slow");
          alert(data['success']);
        } else if (data['error']) {
          alert(data['error']);
        } else {
          alert('Whoops Something went wrong!!');
        }
      },
      error: function (data) {
        alert(data.responseText);
      }
    });

    return false;
  });
});

// <!-- switch -->
$(document).ready(function(){
  $(".switch").find("input[type=checkbox]").on("change", function() {
    if($(this).prop('checked')) {
      $("#folderView").toggleClass('unshow');
      $("#tableView").toggleClass('unshow');
    } else {
      $("#folderView").toggleClass('unshow');
  $("#tableView").toggleClass('unshow');
    }
  });
});

$(document).ready(function(){
$("#slide-out").hide();
$('#first').hover(function(){
$("#altBut").show();
});
});

