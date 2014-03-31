<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:100,300,400,700,900,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

  <?php wp_head(); ?>
<script type="text/javascript" charset="utf-8">
 $(function() { $('body').hide().show(); });
</script>
<script type="text/javascript">
WebFontConfig = {
  google: { families: ['Alegreya+Sans'] },
    fontinactive: function (fontFamily, fontDescription) {
   //Something went wrong! Let's load our local fonts.
    WebFontConfig = {
      custom: { families: ['Alegreya+Sans'],
      urls: ['font-one.css']
    }
  };
  loadFonts();
  }
};

function loadFonts() {
  var wf = document.createElement('script');
  wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
}

(function () {
  //Once document is ready, load the fonts.
  loadFonts();
  })();

</script>
<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
</head>
