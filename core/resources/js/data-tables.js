function dataTableSearch(table, term) {
  /*
  table
    .column(5)
    .data()
    .search(term)
    .draw();
    */
   console.log(table
    .column(5)
    .data()
    .search(term));
}

$(document).ready( function () {
  let table = $('#js-data-tables').DataTable();
  
  $('#js-inactive').on( 'click', function (event) {
    dataTableSearch(table, event.target.innerText);
  });
  $('#js-near-end').on( 'click', function (event) {
    dataTableSearch(table, event.target.innerText);
  });

  $('#js-pending').on( 'click', function (event) {
    dataTableSearch(table, event.target.innerText);
  });
  $('#js-inprogress').on( 'click', function (event) {
    dataTableSearch(table, event.target.innerText);
  });
  $('#js-complete').on( 'click', function (event) {
    dataTableSearch(table, event.target.innerText);
  });
});