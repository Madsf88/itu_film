<?php
/*
Template Name: Frontpage
*/
get_header(); ?>
<?php $cat_id = 4; //the certain category ID
    $latest_cat_post = new WP_Query( array('posts_per_page' => 1, 'category__in' => array($cat_id)));
    if( $latest_cat_post->have_posts() ) : while( $latest_cat_post->have_posts() ) : $latest_cat_post->the_post();
?>
    
<div id="backgroundImage" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>);"></div>
    
<div class="row <?php the_field('brightBg'); ?>">
    <div class="large-12 columns">
        <div id="title" class="fullHeight">
            <div class="heading">
                <h1 class="heading__h1"><?php the_title(); ?></h1>
                <h2 class="heading__h2"><?php the_field('date'); ?> at <?php  the_field('start_time'); ?> in <?php  the_field('location'); ?></h2>
            </div>
        </div>
        <div class="trailerIcon"></div>
        <div class="scrollDown"></div>
    </div>        
</div>
<div class="row">
    <div class="small-12 medium-7 large-6 columns small-centered movieInfo">
        <div class="panel">
            <link href="http://addtocalendar.com/atc/1.5/atc-style-blue.css" rel="stylesheet" type="text/css">
            <!-- 2. Include script -->
            <script type="text/javascript">(function () {
                    if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
                    if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
                        var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                        s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
                        s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
                        var h = d[g]('body')[0];h.appendChild(s); }})();
            </script>
             <script type="text/javascript"> 
                ( function( $ ) {
                    var imdbURL = "<?php the_field('imdb_url'); ?>";
                    var imdbURL = imdbURL.replace('http://','').replace('www.imdb.com/title/','').replace(imdbURL.substr(imdbURL.lastIndexOf('/')), '');
                    var imdbAPI = "http://www.omdbapi.com/?i="+imdbURL+"&plot=full&r=json";
                    $.getJSON(imdbAPI, function (json) {
                        var rating = json.imdbRating;
                        $('#rating').text(rating);

                        var director = json.Director;
                        $('#director').text(director);

                        var year = json.Year;
                        $('#year').text(year);
                        
                        var startTime = ("<?php  the_field('start_time'); ?>");
                        var duration = json.Runtime;
                        var duration = duration.replace(' min','');
                        var timePrase = addMinutes(startTime, duration);
                        $('#duration').text(startTime+" - "+timePrase);
                        
                    }); 
                    function addMinutes(time, minsToAdd) {
                      function D(J){ return (J<10? '0':'') + J};

                      var piece = time.split(':');

                      var mins = piece[0]*60 + +piece[1] + +minsToAdd;

                      return D(mins%(24*60)/60 | 0) + ':' + D(mins%60);  
                    }  

                } )( jQuery );
            </script>
            <dl>
                <dt>Director: </dt>
                <dd id="director"></dd>
                <dt>Running Time: </dt>
                <dd id="duration"></dd>
                <dt>IMDb rating: </dt>
                <dd id="rating"></dd>
                <dt>Year: </dt>
                <dd id="year"></dd>
            </dl>
            <ul>
                <li class="icons">
                    <script type="text/javascript">(function () {
                            if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
                            if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
                                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
                                s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
                                var h = d[g]('body')[0];h.appendChild(s); }})();
                    </script>
                    <link href="http://addtocalendar.com/atc/1.5/atc-style-menu-wb.css" rel="stylesheet" type="text/css">
                    <span class="addtocalendar atc-style-menu-wb">
                        <var class="atc_event">
                            <var class="atc_date_start">2015-05-04 12:00:00</var>
                            <var class="atc_date_end">2015-05-04 18:00:00</var>
                            <var class="atc_timezone">Europe/London</var>
                            <var class="atc_title">ITU.film: <?php the_title(); ?></var>
                            <var class="atc_description">Movie screening</var>
                            <var class="atc_location"><?php  the_field('location'); ?></var>
                            <var class="atc_organizer">ITU.film</var>
                            <var class="atc_organizer_email">film@itu.dk</var>
                        </var>
                        <a class="atcb-link" id="" tabindex="1"></a>
                    </span>
                </li>
                <li class="icons">
                    <a href="<?php the_field('facebook_event_link'); ?>" target="_blank"></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="small-12 medium-8 large-8 small-centered columns review">
        <div class="panel">
            <h1 class="review__h1"><?php the_field('review_title'); ?></h1>
            <?php the_content(); ?>
            This review was brought to you by <a href="../wp/archives/category/staff#authorid<?php the_author_ID(); ?>"><?php the_author(); ?></a>
        </div>
    </div>
</div>
<?php
    if(get_field('trailer_url'))
    {
        echo '<div class="trailerContainer" id="popupVid" data-url="' . get_field('trailer_url') . '"></div>';
    }

?>

<!--
<script>
    var yUrl = "<?php the_field('review_title'); ?>";
    youtube_parser(yUrl);
</script>
-->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
