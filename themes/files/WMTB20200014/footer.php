<?php
$googleId = ifEmptyText(get_query_var('googleId'));
?>
<script src="<?php echo get_template_directory_uri()?>/assets/js/jquery.min.js"></script>
<script src="//q.zvk9.com/Model15/assets/js/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri()?>/assets/js/common.js"></script>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58cb62ef8263e70012464e1a&product=inline-share-buttons"></script>
<script>

</script>
<?php if( ifEmptyText($googleId) !== '') {
    echo $googleId;
}?>
