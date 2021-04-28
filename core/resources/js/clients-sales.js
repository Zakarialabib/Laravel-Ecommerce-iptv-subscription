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