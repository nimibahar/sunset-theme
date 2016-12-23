jQuery(document).ready( function($){

    var mediaUploader;

    $( '#upload-button' ).on('click', function(e) {
        e.preventDefault();
        //Check if a mediaUploader is defined, open it and return (go back/out) from the function:
        if( mediaUploader ){
            mediaUploader.open();
            return;
        }
        //If no mediaUploader is define, define it:
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Profile Picture',
            button: {
                text: 'Choose Picture'
            },
            multipe: false
        });
        //In the event of selecing a media file for your media uploader:
        //(1) Save the selected media item as a JSON file in order to be able to work with it
        //(2) Assign the JSON file's url into a pre defined div with the relevant id
        //(3) Access a div's css and change the background-image value.
        mediaUploader.on('select', function(){
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#profile-pic').val(attachment.url);
            $('#profile-picture-preview').css('background-image', 'url(' + attachment.url + ')');
        });

        mediaUploader.open();

    });

    $( '#remove-picture' ).on('click', function(e){
        e.preventDefault();
        var answer = confirm("Are you sure you want to remove your profile picture?");
        if( answer == true ){
            $('#profile-pic').val('');
            $('.jen-sunset-general-form').submit();
        }
        return;
    });

});
