/*** Code for image upload ***/
var image_field;
jQuery(function($){
    $(document).on('click', 'input.select-img', function(evt){
        image_field = $(this).siblings('.img');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });
    if(image_field != null){
        window.send_to_editor = function(html) {
            imgurl = $('img', html).attr('src');
            image_field.val(imgurl);
            tb_remove();
        }
    }
});
/*** Code for image upload ends ***/