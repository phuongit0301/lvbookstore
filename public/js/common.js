//slug
$(document).ready(function(){
    slugs.run();
});

var slugs = {

    slugGenerate: function(title, slugTextbox) {
        title.on('keyup change', function() {
            var slug = slugs.removeAccent(title);
            slugTextbox.val(slug.toLowerCase());
        });
    },

    removeAccent: function(title)
    {
        var slug = title.val().toLowerCase();

        slug = slug.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ó|ò|ỏ|õ|ọ/gi, 'o');
        slug = slug.replace(/ư|ứ|ừ|ử|ữ|ự|ú|ù|ủ|ũ|ụ/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký t? ??c bi?t
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\:|\;|_/gi, '');
        slug = slug.replace(/\'|\"/gi, "-");
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');

        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        return slug;
    },

/*    proccessUploadFiles: function() {
        $(document).on('change', '#files, #images', function() {
            angular.element($("#frm")).scope().onUploadFileChange();
        });
    },*/

    setup: function() {
        var title = $('#name');
        var slugTextbox = $('#slug');
        this.slugGenerate(title, slugTextbox);
        //this.proccessUploadFiles();
    },
    run: function() {
        // Need to setup view first
        this.setup();
        // Other initialization 
    }

}

$(document).ready(function() {
    image.run();
});
var image = {

    processUploadAndShowMultiFile:function() {
        $(document).on('change', '#file-upload', function() {
            if (this.files) {
                $.each(this.files, function(index, file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#files-display').append('<div class="fixed-image-upload"><a href="#" class="display-image" data-toggle="modalImage"><img src="'+e.target.result+'"></a></div>');
                    }

                    reader.readAsDataURL(file);
                });
            }
        });
    },

    displayImageModal: function() {
        $(document).on('click', '.display-image', function() {
            var src = $(this).find('img').attr('src');
            if(src != '' || src != null || src !== undefined) {
                $('.modal-body').find('img').attr('src', src);
                $('.modal-display-image').modal('show');
            }
        });
    },

    setup: function() {
        this.processUploadAndShowMultiFile();
        this.displayImageModal();
    },
    run: function() {
        // Need to setup view first
        this.setup();
        // Other initialization 
    }
}