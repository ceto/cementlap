<footer class="content-info" role="contentinfo">
  <div class="footer-sidebar">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <section class="widget widget-mc">
      <h3><?php _e('Feliratkozás hírlevelünkre','root') ?></h3>
      <!-- Begin MailChimp Signup Form -->
      <!--link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css"-->
      <div id="mc_embed_signup">
      <form action="http://marrakeshcementlap.us5.list-manage1.com/subscribe/post?u=f75f449c913cf58fb513b4418&amp;id=7fa0ff2925" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
      <div class="mc-field-group">
        <label for="mce-EMAIL"><?php _e('Email cím','root') ?></label>
        <input type="email" value="" placeholder="johndoe@example.com" name="EMAIL" class="required email" id="mce-EMAIL">
      </div>
        <div id="mce-responses" class="clear">
          <div class="response" id="mce-error-response" style="display:none"></div>
          <div class="response" id="mce-success-response" style="display:none"></div>
        </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;"><input type="text" name="b_f75f449c913cf58fb513b4418_7fa0ff2925" value=""></div>
        <div class="clear"><input type="submit" value="<?php _e('Feliratkozás','root'); ?>" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
      </form>
        </div>

      </section>
  </div>
  <div class="footer-copy">
    © 2014 Marrakesh Bt. | Design & Site by <a href="http://hydrogene.hu">HYDROGENE</a>
  </div>
  <a href="#" class="tothetop"><i class="ion-ios7-arrow-thin-up"></i></a>
</footer>
<?php wp_footer(); ?>
