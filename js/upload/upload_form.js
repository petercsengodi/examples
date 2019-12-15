function startImageUpload() {
  var formData = new FormData();
  formData.append('galleryImageToUpload', $('#galleryImageToUpload')[0].files[0]);
  formData.append('parent_id', currentGalleryId);
  formData.append('title', document.getElementById('imageTitle').value);
  formData.append('sector', currentSector);

  $.ajax({
    url : baseUrl + 'upload/receive_upload.php',
    type : 'POST',
    data : formData,
    processData: false,
    contentType: false,
    success : function(data) {
      resetGallery();
    }
  });
}

