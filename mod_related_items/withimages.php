<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_related
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$app    = JFactory::getApplication();
$tpath   = JURI::base(true).'/templates/'.$app->getTemplate().'/';
$pieces = explode(" ", $moduleclass_sfx);
$widthchoosen = $pieces[1];
$heightchoosen = $pieces[2];
$cropchoosen = $pieces[3].':'.$pieces[4];
if (empty($pieces[1])){
    $widthchoosen = '360';
}
 if ((empty($pieces[3])) and (empty($pieces[4]))){
    $cropchoosen = '16:9';
}


 if (empty($pieces[2])){
     $heightchoosen = '240';
}


?>
<div class="relatednews <?php echo $moduleclass_sfx; ?>">
  <?php foreach ($list as $item) :  ?>	
  <div class="col-md-12" itemscope itemtype="https://schema.org/Article">
      
    <div class="image_related_news col-md-12">
<?php

$thumbsnippet = $tpath.'html/mod_'.$module->name.'/assets/smart/image.php?width='.($widthchoosen).'&height='.($heightchoosen).'&cropratio='.($cropchoosen).'&image='.JURI::root();
        preg_match('/(?<!_)src=([\'"])?(.*?)\\1/',$item->introtext, $matches);
                ?>


       <?php
       if (empty($matches[2]) and (empty(json_decode($item->images)->image_fulltext))  and (!empty(json_decode($item->images)->image_intro)) ){
            echo  '<a href="'. $item->route.'" itemprop="url"><img src="'.$thumbsnippet.json_decode($item->images)->image_intro.'" class="resize" /></a>';
        }
       if (empty($matches[2]) and (!empty(json_decode($item->images)->image_fulltext))  and (empty(json_decode($item->images)->image_intro)) ){
            echo  '<a href="'. $item->route.'" itemprop="url"><img src="'.$thumbsnippet.json_decode($item->images)->image_fulltext.'" class="resize" /></a>';
        }
        if (empty($matches[2]) and (!empty(json_decode($item->images)->image_fulltext))  and (!empty(json_decode($item->images)->image_intro)) ){
            echo  '<a href="'. $item->route.'" itemprop="url"><img src="'.$thumbsnippet.json_decode($item->images)->image_intro.'" class="resize" /></a>';
        }
       if (!empty($matches[2]) and (empty(json_decode($item->images)->image_fulltext))  and (empty(json_decode($item->images)->image_intro)) ){
            echo  '<a href="'. $item->route.'" itemprop="url"><img src="'.$thumbsnippet.$matches[2].'" class="resize" /></a>';
        }
        ?>
    </div>    
    <div class="header_related_news col-md-12">

    <a href="<?php echo  $item->route; ?>" itemprop="url">

      <h4 itemprop="name">				
        <?php echo $item->title; ?>
      </h4>		</a>
      <?php if ($showDate) : ?>

      <div class="relateditem-date">
          <?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>
      </div>
      <?php endif;?>
         
    <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)); ?>" itemprop="url"> 			
      <span itemprop="category">				
        <?php echo $item->category_title; ?>

      </span>		</a>
     </div>

     
    <?php 
         /**   
         if (!empty($item->introtext)) {
			     $text = $item->introtext;
		      } else {
			$text = $item->texfull;
		}
         $maxLimit = 1.2*$moduleclass_sfx;
         $text = preg_replace("/\r\n|\r|\n/", " ", $text);
					// Next, replace <br /> tags with \n
					$text = preg_replace("/<BR[^>]*>/i", " ", $text);
					// Replace <p> tags with \n\n
					$text = preg_replace("/<P[^>]*>/i", " ", $text);
					// Strip all tags
					$text = strip_tags($text);
					// Truncate
					$text = substr($text, 0, $maxLimit);
					//$text = String::truncate($text, $maxLimit, '...', true);
					// Pop off the last word in case it got cut in the middle
					$text = preg_replace("/[.,!?:;]? [^ ]*$/", " ", $text);
					// Add ... to the end of the article.
					$text = trim($text) . '...' ;
					// Replace \n with <br />
					$text = str_replace("\n", " ", $text);
          
        echo $text;
           */
          ?> 
   

  </div>
  <?php endforeach; ?>
</div>