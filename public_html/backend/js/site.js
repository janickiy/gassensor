$(() => {
  console.log('app site.js');

  $(":checkbox").prop('checked', false);// firefox kill caching checkboxes

  var summerNoteConfig = {
    height: 600,
    codemirror: { // codemirror options
      //theme: 'monokai'
      mode: "htmlmixed",
      lineNumbers: true
    },

    codeviewIframeFilter: false,

    toolbar: [
      ['style1', ['style']],
      ['style2', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']],
      ['insert', [
        'link',
        'picture',
        'video',
        'table',
        'hr',
      ]],
      ['codeview',],
      ['fullscreen',]
    ],

    callbacks: {
      onImageUpload: function(files) {
        console.log('onImageUpload!', arguments[1], files, this);
        summerNoteUpload(files, this);
      },
      onBlurCodeview: function () {//https://github.com/summernote/django-summernote/issues/127#issuecomment-714735251
        console.log('onBlurCodeview!');
        let codeviewHtml = $(this).summernote('code');
        $(this).val(codeviewHtml);
      }
    }

  };

  $('textarea[name="Page[content]"]').summernote(summerNoteConfig);

  kartikSummernoteBs5fix();

  $('.grid-view').on('change', ':checkbox[name=selection_all]', function() {
    console.log('!!!');
    const cnt = $(this).closest('.grid-view');
    const keys = cnt.yiiGridView('getSelectedRows');
    console.log(keys);

    var form = $('form.batch').toggleClass('d-none', !keys.length);
    $('input[name="data"]', form).val(JSON.stringify(keys));
  });

})



