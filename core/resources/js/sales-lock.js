axios.defaults.headers.common["X-CSRF-TOKEN"] = document
.querySelector('meta[name="csrf-token"]')
.getAttribute("content");

document.querySelectorAll('.sale-lock').forEach(lock => {
  lock.addEventListener('click', function(event){
    toggleLock(event);
  });
});

function toggleLock(event) {
  const saleId = event.target.dataset.id;
  const status = event.target.dataset.status;
  swal({
    title: "Are you sure?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willUnlock) => {
    if (willUnlock) {
      axios.post('/admin/sales/lock', {
        sale_id: saleId,
        status: !status,
      })
      .then((response) => {
        if (response.status === 200) {
          event.target.setAttribute('data-status', !status);
          event.target.classList.toggle('translate-x-6');
          event.target.classList.toggle('translate-x-0');
          event.target.parentNode.classList.toggle('bg-green-400');
          event.target.parentNode.classList.toggle('bg-gray-300');
        }
      })
      .catch((error) => {
        swal("Error Try again", {
          icon: "error",
        });
      });
    }
  });
}