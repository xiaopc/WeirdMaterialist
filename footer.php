<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Materialist
 */
?>
    </div>

    <footer class="page-footer light-blue darken-2">
      <div class="container">
        <div class="row">
    		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>	
    		<div class="col l4 s12">
    			<?php dynamic_sidebar( 'sidebar-1' ); ?>				
    		</div>
    		<?php endif; ?>
    		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>	
    		<div class="col l4 s12">
    			<?php dynamic_sidebar( 'sidebar-2' ); ?>				
    		</div>
    		<?php endif; ?>
    		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>	
    		<div class="col l4 s12">
    			<?php dynamic_sidebar( 'sidebar-3' ); ?>				
    		</div>
    		<?php endif; ?>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
          &copy; 2016 <?php bloginfo( 'name' ); ?>
          <span class="grey-text text-lighten-4 right">使用 <?php printf( __( '%s', 'materialist' ), 'WordPress' ); ?>, <a class="amber-text lighten-3" href="https://xiaopc.org/theme">主题</a></span>
        </div>
      </div>
    </footer>

    <div id="topbtn" class="btn btn-floating btn-large waves-effect waves-light blue lighten-1 right"><i class="material-icons">arrow_upward</i></div>
</div>

<script type='text/javascript' src='//cdn.bootcss.com/materialize/0.97.7/js/materialize.min.js'></script>
<?php wp_footer(); ?>
<script>
window.onload = function(){
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-23646862-3', 'auto');
  ga('send', 'pageview');
};
</script>
</body>
</html>
