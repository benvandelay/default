<div class="socials">
    <a href="/contact" target="_blank" class="icon icon-mail"></a>
    <?php 
        echo SiteHelper::getParam('facebook') != '' ? Chtml::link('', SiteHelper::getParam('facebook'), array('class' => 'icon icon-facebook')) : '';
        echo SiteHelper::getParam('github') != '' ? Chtml::link('', SiteHelper::getParam('github'), array('class' => 'icon icon-github')) : '';
        echo SiteHelper::getParam('twitter') != '' ? Chtml::link('', SiteHelper::getParam('twitter'), array('class' => 'icon icon-twitter')) : '';
        echo SiteHelper::getParam('vimeo') != '' ? Chtml::link('', SiteHelper::getParam('vimeo'), array('class' => 'icon icon-vimeo')) : '';
    ?>
</div>