	</div>
	</div>
</section>

<footer id="footer">
	<div class="row">
		<?php do_action('foundationPress_before_footer'); ?>
		<?php dynamic_sidebar("footer-widgets"); ?>
		<?php do_action('foundationPress_after_footer'); ?>
		<p>&copy; Copyright <?php bloginfo('name'); ?>. <a href="http://ww.dealerfire.com/" target="_blank">Automotive Marketing by DEALERFIRE</a>.</p>
	</div>
</footer>
<a class="exit-off-canvas"></a>
	
  <?php do_action('foundationPress_layout_end'); ?>
  </div>
</div>
<?php wp_footer(); ?>
<?php do_action('foundationPress_before_closing_body'); ?>
</body>
</html>