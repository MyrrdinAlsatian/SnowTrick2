$(document).ready(function () {
    let $collectionHolderVideo;
    const $addVideoLiLink = $('#trickVideos');
    let youtubeRg = new RegExp('^(http(s)?:\\/\\/)?((w){3}.)?youtu(be|.be)?(\\.com)?\\/.+');
    let dailymotionRg = new RegExp(
        '^.+dailymotion.com\\/((video|hub)\\/([^_]+))?[^#]*(#video=([^_&]+))?/',
    );
    let vimeoRg = new RegExp('^(http(s)?:\\/\\/)?((w){3}.)?player.vimeo.com/video\\/.+');

    // Get the ul that holds the collection of tags
    $collectionHolderVideo = $('#trickVideos');

    $addTagButtonVideo = $('#addVideoUpload');

    $addTagButtonVideo.on('click', function (e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolderVideo, $addVideoLiLink);
    });

    let startIndexVideo = 0;

    function addTagForm($collectionHolder, $newLinkLi) {
        $('#trickVideos').data(
            'index',
            startIndexVideo + $('#trickVideos').find(':input').length,
        );
        // Get the data-prototype explained earlier
        let templateProto = $collectionHolder.data('prototype');
        // get the new index
        let index = $collectionHolder.data('widget-counter') || $collectionHolder.children().length;

        let newForm = templateProto;

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index) + '<hr/>';

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        let $newFormLi = $('<div></div>').append(newForm);
        $newLinkLi.append($newFormLi);
    }

    $(document).on('click', '.deleteVideo', function (e) {
        $(this).parent().parent().remove();
    });

    $(document).on('change', '.videoAddInput', function () {
        let totalVideo = $('#trickVideos div input').length - 1 + startIndexVideo;
        let notValid = 0;

        for (let i = 0; i <= totalVideo; i++) {
            let url = $('#trick_add_form_videos_' + i + '_url').val();
            if (typeof url == 'undefined') {
                url = $('#trick_edit_form_videos_' + i + '_url').val();
            }
            if (url !== '' && typeof url !== 'undefined') {
                let isYoutube = youtubeRg.test(url);
                let isDaily = dailymotionRg.test(url);
                let isVimeo = vimeoRg.test(url);
                if (!isYoutube && !isDaily && !isVimeo) {
                    notValid = notValid + 1;
                }
            }
        }
        if (notValid > 0) {
            alert(
                "Une Url fournis ne semble pas valide! Les vidéos accepté doivent provenir de Youtube, Dailymotion et Viméo.",
            );
        }
    });
});



