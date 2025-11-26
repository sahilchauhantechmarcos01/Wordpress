<?php
/* Template Name: Movies Live Search */
get_header();
?>

<style>
form{ display:flex; justify-content:flex-end; }
input.search{
    background-color:#fff;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
    padding:10px;
    width:40%;
    border:1px solid rgba(0,0,0,.17);
    border-radius:19px;
    font-size:16px;
    color:rgba(0,0,0,.72);
}
input.search:focus{ outline:none; border:1px solid rgba(0,0,0,.2); }
#res { margin-top:20px; }
.movie-card{ border:1px solid rgba(0,0,0,.2); padding:12px; margin-bottom:12px; border-radius:8px; background:#fafafa; }
</style>

<h1 class="movie-heading">All Movies</h1>

<form method="get" action="">
    <input id="search_m" class="search" type="text" name="movie_search" placeholder="Search Movies...">
</form>

<div id="res">
   
</div>

<script type="text/javascript">
jQuery(function($){
    var $input = $('#search_m');
    var $res   = $('#res');
    var timer  = null;

    function fetchResults(term) {
        $.ajax({
            url: "<?php echo esc_url( admin_url('admin-ajax.php') ); ?>",
            type: "POST",
            data: {
                action: "ajax_movie_search",
                search: term
            },
            success: function(response){
                $res.html(response);
            },
            error: function(xhr, status, err){
                $res.html('<p>There was an error. Check console for details.</p>');
            }
        });
    }

    $input.on('keyup', function(){
        var val = $(this).val();
        if (timer) clearTimeout(timer);
        timer = setTimeout(function(){
            fetchResults(val);
        }, 300);
    });

    fetchResults('');
});
</script>

<?php get_footer(); ?>
