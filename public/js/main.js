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

  // Datatables
  $('#myDataTable').DataTable({})

})

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.fixed-action-btn');
  var instances = M.FloatingActionButton.init(elems, {
    direction: 'left'
  })
})
