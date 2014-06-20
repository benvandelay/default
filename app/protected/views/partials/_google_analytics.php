<?php if(SiteHelper::getParam('google_tracking_id')): ?>
    
    <?php $parts = explode('.', Yii::app()->request->serverName); ?>
    <?php $sn    = $parts[1] . '.' . $parts[2]; ?>
    
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo SiteHelper::getParam('google_tracking_id'); ?>', '<?php echo $sn; ?>');
  ga('send', 'pageview');

</script>
<?php endif; ?>