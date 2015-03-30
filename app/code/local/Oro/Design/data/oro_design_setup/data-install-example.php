<?php
/**
 * @category   Oro
 * @package    Oro_Design
 * @copyright  Copyright (c) 2015 Oro Inc. DBA MageCore (http://www.magecore.com)
 */
$installer = $this;

/**
 * ========== example for static block with two web sites ===========
 */
$collection = Mage::getResourceModel('cms/block_collection');
$collection->addFieldToFilter('identifier', 'home_bottom_text');
foreach ($collection as $block) {
    $block->delete();
}
$enContent = <<<EOD
<div class="accordion-box">
    <div class="top-content">
         <p>
              offers beautiful eye makeup, lipstick, face makeup and accessories. We use only the highest quality ingredients and guarantee you will enjoy our full line of beauty products for looks that last all day and night!
             <span class="opener">Read More ›››</span>
         </p>
    </div>
    <div class="bottom-content" style="display: none;">
        <p>Looking beautiful and feeling fabulous go hand-in-hand, and we have the tools to help you do both. Our products are essential for professional makeup artists, makeup lovers and beginners alike. You won’t find another brand that offers affordable makeup with as many vivid colors and textures as BH. If you want to make a statement with your look, consider one of our famous eyeshadow palettes and brow gels or gorgeous lip products, such as our lip glosses and lipsticks. In addition to our cosmetics, we offer a variety of accessories for application and storage including makeup brushes and makeup organizers. Our products include neutral shades for daytime looks and smoky bold shades for nighttime looks.</p>
        <p>We do our best to keep beauty lovers looking stunning 24/7. Connect with us on our social media channels to see some of our favorite styles and learn more about our products.</p>
    </div>
</div>
EOD;

$deContent = <<<EOD
<div class="accordion-box">
    <div class="top-content">
         content go here
         U can use ''
         or ""
    </div>
</div>
EOD;

$cmsBlocks = array(
    array(
        'title'         => 'Home page bottom content US',
        'identifier'    => 'home_bottom_text',
        'content'       => $enContent,
        'is_active'     => 1,
        'stores'        => 1
    ),
    array(
        'title'         => 'Home page bottom content DE',
        'identifier'    => 'home_bottom_text',
        'content'       => $deContent,
        'is_active'     => 1,
        'stores'        => 2
    )
);

foreach ($cmsBlocks as $data) {
    $block = Mage::getModel('cms/block')->load($data['identifier']);
    $staticBlock = Mage::getModel('cms/block')->setData($data);
    $staticBlock->save();
}

/**
 * ========== example for static page with one web site ===========
 */
$page = Mage::getModel('cms/page');
$page->load('about-us');
if (!$page->getId()) {
    $page->setIdentifier('about-us');
}
$page->setTitle('About Us');
$page->setIsActive(1);
$page->setStores(array(0));
$page->setRootTemplate('two_columns_left_bar');

$content    = <<<HTML
<div class="page-title">
    <h1>About Us</h1>
</div>
<h2>Our Story</h2>
<div class="clearfix">
    <div class="visual pull-right"><img src="{{skin url='images/std-demo.jpg'}}" alt="demo"/></div>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse accumsan rhoncus ex, vel eleifend diam vehicula sit amet. Pellentesque ut leo tristique, tincidunt erat at, suscipit turpis. Sed ultricies, mi eu egestas pretium, magna purus molestie metus, id tristique est ex vitae nibh. Praesent quam odio, facilisis quis imperdiet quis, cursus id neque. Donec malesuada eros nulla, sit amet ultrices lorem malesuada a. Etiam scelerisque, nulla quis vestibulum cursus, elit dui sodales mauris, et fermentum nulla erat sed dui. Nulla mi purus, rutrum ac tellus quis, luctus dapibus lorem. </p>
    <h3>Pellentesque eget dui et nulla rhoncus dapibus a ac libero. </h3>
    <ul>
        <li>Nam sit amet tempor nisi. </li>
        <li>Praesent eu velit id mauris ultricies malesuada eget viverra ante. </li>
        <li>Duis posuere sit amet sem non mollis. Integer blandit nulla ac commodo finibus. </li>
    </ul>
    <p>Nulla vel augue metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam venenatis diam velit, sed convallis leo imperdiet ut. Donec id massa at massa euismod hendrerit eget eu eros. Donec quis elit eu dapibus mattis in id lorem.</p>
</div>
<div class="separator"></div>
<h2>Nulla vel augue metus</h2>
<p>Morbi blandit nisi non enim fringilla mattis. Curabitur velit turpis, tempus at orci sed, facilisis aliquam mauris. Fusce nec erat eu nisi ullamcorper feugiat eget eget leo. Mauris sollicitudin non nunc non gravida. Integer nec magna vestibulum eros molestie faucibus. Sed ut accumsan sapien, vel laoreet ante. Vivamus et velit augue. Sed fringilla velit a tristique venenatis. Donec ultricies rhoncus diam. Vivamus tempor quam aliquet nisi mollis vulputate. Nulla facilisi. Cras convallis imperdiet tempus. Nam in magna at nulla tempus condimentum eu quis erat. Nulla dignissim dignissim est, tempor placerat nisi sollicitudin nec. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
<p>Etiam vehicula auctor mattis. In enim nisl, ultricies non ipsum eget, iaculis cursus mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean odio urna, pulvinar ut ornare eget, suscipit quis metus. Etiam in tincidunt nisl. Suspendisse vel elit sed eros egestas faucibus maximus sit amet lorem. Quisque volutpat diam sit amet mi feugiat, sed laoreet risus ultrices. Vivamus vel rhoncus urna. Donec iaculis elit in metus venenatis placerat. Donec aliquam purus quis enim hendrerit, non ultricies nibh aliquam. Ut pharetra augue eu est tincidunt, at consectetur mauris dignissim. Nunc porta, purus nec ornare faucibus, tellus mi tempor mi, vestibulum egestas nisi ligula et eros. In finibus felis nibh, non tempor ante rhoncus a. Vestibulum in nisi accumsan, varius quam nec, hendrerit elit.</p>
HTML;

$page->setContent($content);
$page->save();

/**
 * ========== example for static page change only layout template ===========
 */
$page = Mage::getModel('cms/page');
$page->load('customer-service');
if (!$page->getId()) {
    $page->setIdentifier('customer-service');
}
$page->setTitle('Customer Service');
$page->setIsActive(1);
$page->setStores(array(0));
$page->setRootTemplate('two_columns_left_bar');

$page->save();

/**
 * ========== example for option at admin panel  ===========
 */
$installer = $this;
$installer->setConfigData('design/header/logo_src', 'images/media/logo.png');
$installer->setConfigData('design/header/logo_alt', 'MySite.com');
$installer->setConfigData('design/header/logo_src_small', 'images/media/logo-small.png');
$installer->setConfigData('general/store_information/phone', '1-800-555-5555');
$installer->setConfigData('design/head/default_title', 'MySite');
$installer->setConfigData('design/header/welcome', 'Skip the trip to the big box stores');
$installer->setConfigData('design/footer/copyright', '&copy; 2015 MySite.com. All Rights Reserved.');