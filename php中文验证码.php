<?php

Header("Content-type: image/PNG");
$str = "一乙二十丁厂七卜人入八九几儿了力乃刀又三于干亏士工土才寸下大丈与万上小口山千乞川亿个勺久凡及夕丸么广亡门义之尸弓己已子卫也女飞刃习叉马乡丰王井开夫天无元专云扎艺木五支厅不太犬区历尤友匹车巨牙屯比互切瓦止少日中冈贝内水见午牛手毛气升长仁什片仆化仇币仍仅斤爪反介父从今凶分乏公仓月氏勿欠风丹匀乌凤勾文六方火为斗忆订计户认心尺引丑巴孔队办以允予劝双书幻玉刊示末未击打巧正扑扒功扔去甘世古节本术可丙左厉右石布龙平灭轧东卡北占业旧帅归且旦目叶甲申叮电号田由史只央兄叼叫另叨叹四生失禾丘付仗代仙们仪白仔他斥瓜乎丛令用甩印乐句匆册犯外处冬鸟务包饥主市立闪兰半汁汇头汉宁穴它讨写让礼训必议讯记永司尼民出辽奶奴加召皮边发孕圣对台矛纠母幼丝式刑动扛寺吉扣考托老执巩圾扩扫地扬场耳共芒亚芝朽朴机权过臣再协西压厌在有百存而页匠夸夺灰达列死成夹轨邪划迈毕至此贞师尘尖劣光当早吐吓虫曲团同吊吃因吸吗屿帆岁回岂刚则肉网年朱先丢舌竹迁乔伟传乒乓休伍伏优伐延件任伤价份华仰仿伙伪自血向似后行舟全会杀合兆企众爷伞创肌朵杂危旬旨负各名多争色壮冲冰庄庆亦刘齐交次衣产决充妄闭问闯羊并关米灯州汗污江池汤忙兴宇守宅字安讲军许论农讽设访寻那迅尽导异孙阵阳收阶阴防奸如妇好她妈戏羽观欢买红纤级约纪驰巡";
$imgWidth = 140;
$imgHeight = 40;
$authimg = imagecreate($imgWidth,$imgHeight);
$bgColor = ImageColorAllocate($authimg,145,255,245);
$fontfile = "simhei.ttf";
$white=imagecolorallocate($authimg,234,185,95);
imagearc($authimg, 150, 8, 20, 20, 75, 170, $white);
imagearc($authimg, 180, 7,50, 30, 75, 175, $white);
imageline($authimg,20,20,180,30,$white);
imageline($authimg,20,18,170,50,$white);
imageline($authimg,25,50,80,50,$white);
$noise_num = 800;
$line_num = 20;
imagecolorallocate($authimg,0xff,0xff,0xff);
$rectangle_color=imagecolorallocate($authimg,0xAA,0xAA,0xAA);
$noise_color=imagecolorallocate($authimg,0x00,0x00,0x00);
$font_color=imagecolorallocate($authimg,0x00,0x00,0x00);
$line_color=imagecolorallocate($authimg,0x00,0x00,0x00);
for($i=0;$i<$noise_num;$i++){
imagesetpixel($authimg,mt_rand(0,$imgWidth),mt_rand(0,$imgHeight),$noise_color);
}
for($i=0;$i<$line_num;$i++){
imageline($authimg,mt_rand(0,$imgWidth),mt_rand(0,$imgHeight),mt_rand(0,$imgWidth),mt_rand(0,$imgHeight),$line_color);
}
$randnum=rand(0,mb_strlen($str,"UTF-8")-4);
if($randnum%2)$randnum+=1;
$str = mb_substr($str,$randnum,4,"UTF-8");
ImageTTFText($authimg, 20, 0, 16, 30, $font_color, $fontfile, $str);
ImagePNG($authimg);
ImageDestroy($authimg);
