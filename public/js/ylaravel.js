var editor = new wangEditor('content');
editor.config.uploadImgUrl = '/posts/image/upload'
/*editor.config.uploadParams = {
    '_token': $('meta[name="csrf-token"]').attr('content')
};*/
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};

editor.create();