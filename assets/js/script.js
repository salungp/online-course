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

$('.btn-print').on('click', function(e) {
  e.preventDefault();

  $('body').html($('.table'));
  window.print();
  location.reload();
});