function previewImage() {
  const fileReader = new FileReader();
  fileReader.readAsDataURL(document.getElementById('image-upload').files[0]);

  fileReader.onload = function(e) {
    $('.image-upload-wrapper').css({
      'background': `url(${e.target.result}) center center no-repeat`,
      'background-size': 'cover'
    });
  }
}

$('a[href="'+location.href+'"]').parents().addClass('active');

$('#media').on('change', function(e) {
  const upload = '<input type="file" name="media" class="form-control">';
  const link = '<input type="text" name="media" class="form-control" placeholder="Masukkan link">';

  if (e.target.value == 'upload') {
    $('.media-target').html(upload);
  } else {
    $('.media-target').html(link);
  }
});

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

$('.delete-account').on('click', function(e) {
  e.preventDefault();
  swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      swalWithBootstrapButtons.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      )
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelled',
        'Your imaginary file is safe :)',
        'error'
      )
    }
  })
})