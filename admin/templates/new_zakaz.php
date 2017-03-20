<?php defined('ISHOP') or die('Access denied'); ?>
<div class="content">


        <h2>Новые заказы <span class="class-zero"> Необработанные заказы</span></p></h2>
    <?php

    if ($_SESSION['sacsess']){
        echo $_SESSION['sacsess']."</br>";
        unset ($_SESSION['sacsess']);
    }
    if (!$new_zakaz){
        echo "Нет необработанных заказов";
    }else {?>

        <table class="tabl" cellspacing="1">
    <tr>
        <th class="number">№ заказа</th>
        <th class="str_name" style="width:280px;">Покупатель</th>
        <th class="str_sort">Дата</th>
        <th class="str_action">Просмотр</th>
    </tr>
<?php foreach ($new_zakaz as $item){?>
<tr>
    <td class="class-zero"><?=$item['order_id']?></td>
    <td class="class-zero"><?=$item['name']?></td>
    <td class="class-zero"><?=$item['date']?></td>
    <td class="class-zero"><a href="?view=show_zak&amp;order_id=<?=$item['order_id']?>" class="edit">Просмотреть</a></td>
</tr>
<?php } ?>
</table>



<?php }?>
	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>