document.querySelectorAll('.js-package-renew').forEach(el => {
  el.addEventListener('click', function(event) {
    setModal(event);
  });
});

function setModal(event) {
  let plan = document.querySelector('#plan');
  plan.value = event.target.dataset.plan;

  let sale_id = document.querySelector('#js-sale-id');
  sale_id.value = event.target.dataset.id;

}

function dataTableSearch(table, term) {
  table
    .column(5)
    .data()
    .search(term)
    .draw();
}

$(document).ready( function () {
  let table = $('#js-clients-sales').DataTable();

  $('#js-active').on( 'click', function (event) {
    dataTableSearch(table, event.target.innerText);
  });

  $('#js-inactive').on( 'click', function (event) {
    dataTableSearch(table, event.target.innerText);
  });

  $('#js-near-end').on( 'click', function (event) {
    dataTableSearch(table, event.target.innerText);
  });
});