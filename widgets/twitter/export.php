  Crows.default_tag='<?=$hashtags[0];?>';
  Crows.twitter=[<?
  $i=0;
  foreach($hashtags as $hashtag){
    if($i>0){echo(',');}
    echo("'".$hashtag."'");
      $i++;
  }
  ?>];
  Crows.twitter_account='<?=$twitter_account;?>';
