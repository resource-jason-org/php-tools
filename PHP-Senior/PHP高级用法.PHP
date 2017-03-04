<?PHP


////////////// ArrayObject 1/////////////////////////////////////////////
$array = array('1' => 'one',
               '2' => 'two',
               '3' => 'three');

$arrayobject = new ArrayObject($array); //构造一个ArrayObject对象

for($iterator = $arrayobject->getIterator();//构造一个迭代器
    $iterator->valid();//检查是否还含有元素
    $iterator->next()) { //指向下个元素

    echo $iterator->key() . ' => ' . $iterator->current() . "\n";//打印数组元素
}


////////////////////// ArrayObject 2///////////////////////
$arrayobject = new ArrayObject();

$arrayobject[] = 'zero';
$arrayobject[] = 'one';
$arrayobject[] = 'two';

$iterator = $arrayobject->getIterator();

$iterator->next();
echo $iterator->key(); // 1

$iterator->rewind(); //重置指针到头部
echo $iterator->key(); // 0

/////////////////////////////////////////////




?>