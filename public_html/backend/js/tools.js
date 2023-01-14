console.log('tools.js');

function kartikSummernoteBs5fix() {
  // improves vendor/kartik-v/yii2-editors/src/assets/lib/js/kv-summernote-bs5.js
  var el = $('.note-editor');
  el.find('[data-toggle=dropdown]').off('click').on('click', function (e) {
    var $t = $(this);
    if (!$t.attr('data-bs-toggle')) {
        $t.tooltip('dispose').attr('title', $t.attr('data-bs-original-title')).removeAttr('data-bs-original-title');
        $t.removeAttr('data-toggle').attr({'data-bs-toggle': 'dropdown'});
        $t.dropdown().trigger('click').off('hidden.bs.dropdown').on('hidden.bs.dropdown', function () {
            $t.dropdown('dispose').removeAttr('data-bs-toggle').attr({'data-toggle': 'dropdown'});
            $t.tooltip('hide');
        });
    }
  });
  el.find('[data-dismiss=modal]').each(function () {
      $(this).removeAttr('data-dismiss').attr('data-bs-dismiss', 'modal');
  });
  el.find('.form-control-file').addClass('form-control').prev('label').addClass('form-label');
}

summerNoteUpload = (files, textarea) => {

  var data = new FormData();
  data.append("image", files[0]);
  $.ajax({
      url: '/backend/site/upload',
      cache: false,
      contentType: false,
      processData: false,
      data: data,
      type: "post",
      success: function(resp) {
          console.log(resp);
          var image = $('<img>').attr('src', resp);
          $(textarea).summernote("insertNode", image[0]);
      },
      error: function(data) {
          console.log(data);
      }
  });

}
