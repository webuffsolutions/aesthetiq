<div id="top-section">
    <!-- SVG shape with the same background color as the container below to create the illusion of a diagonal border -->
    <svg id="top-section-border" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#fff" points="0,100 100,0 100,100" />
    </svg>

    <div class="container">
        <div class="row p-5 justify-content-between">
            <div class="col-md-6 pb-4 text-center">
                <!-- <img src="https://picsum.photos/id/111/600/300" class="img-fluid" /> -->
                <?php
                $videoType = get_field('video_type');
                $videoFile = get_field('video_file');
                $youtubeUrl = get_field('youtube_url');

                if ($videoType == 'File') {
                    if ($videoFile) {
                        echo '<video autoplay controls> 
                            <source src="' . get_field('video_file') . '" type="video/mp4">
                        </video>';
                    } else {
                        echo '<video controls></video>';
                    }
                } else if ($videoType == 'URL') {
                    if ($youtubeUrl) {
                        echo '<iframe width="500" height="250" src="' . $youtubeUrl . '" style="border: 0; max-width: 100%;"></iframe>';
                    } else {
                        echo '<video controls></video>';
                    }
                } else {
                    echo '<video controls></video>';
                }
                ?>
            </div>
            <div class="col-md-6 pb-4 align-self-center text-center">
                <?php $pageLinkID = get_field_object('redirect_page_link', get_the_ID())['value']->ID; ?>

                <a href="<?php echo get_permalink($pageLinkID); ?>" class="btn btn-lg bg-header px-4 pt-3 rounded-0 text-white hvr-grow border-white text-uppercase">
                    <?php echo get_field('redirect_button_label'); ?> <i class="fas fa-play fa-sm pl-2"></i>
                </a>
            </div>
        </div>
    </div>

</div>