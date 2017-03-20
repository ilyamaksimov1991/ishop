<?php defined('ISHOP') or die('Access denied'); ?>
<div class="content">

    <?php
//print_array($count_products);
    if (!$navig_confirm_zakaz){
        echo "Нет необработанных заказов";
    }else {?>
	<h2>Новые заказы</h2>
         Не обработанные-<span class="class-zero"> заказ не обработан </span>   </br> </br>Oбработанные-<span class="class-one"> заказ обработан</span> </br></br>


<table class="tabl" cellspacing="1">
    <tr>
        <th class="number">№ заказа</th>
        <th class="str_name" style="width:280px;">Покупатель</th>
        <th class="str_sort">Дата</th>
        <th class="str_action">Просмотр</th>
    </tr>
<?php foreach ($navig_confirm_zakaz as $item){ if ($item['status']==='0'){ $class="class-zero";}else{ $class="class-one";}?>
<tr >
    <td class="<?=$class?>"><?=$item['order_id']?></td>
    <td class="<?=$class?>"><?=$item['name']?></td>
    <td class="<?=$class?>"><?=$item['date']?></td>
    <td class="<?=$class?>"><a href="?view=show_zak&amp;order_id=<?=$item['order_id']?>" class="edit">Просмотреть</a></td>
</tr>
<?php } ?>
</table>



<?php } //print_array($new_zakaz);?>
    <?php if($amount_page > 1) pagination1($page, $amount_page); ?>
	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>