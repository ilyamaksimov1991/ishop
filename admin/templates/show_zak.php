<?php defined('ISHOP') or die('Access denied'); ?>
<div class="content">

    <?php if (!$show_zakaz){
    echo "<div class='Text-reg-error'>Заказа с таким номером нет!</div>";
    }else{ if ($show_zakaz[0]['status']==0){ $class="<span class='class-zero'> Не обработан</span>";}else{ $class="<span class='class-one'> Обработан</span>";}?>
    <h2>Заказ № <?=$order_id?> <?=$class?> </h2>



        <p>
<?php if ($show_zakaz[0]['status']==0){?>
                <a class="edit" href="?view=new_zakaz&amp;confirm=<?=$order_id?>">Подтвердить заказ</a> |
<?php }?>
            <a class="del" href="">Удалить заказ</a>
        </p>

        <br />
        <table class="tabl" cellspacing="1">
            <tr>
                <th class="number">№</th>
                <th class="str_name" style="width:280px;">Название товара</th>
                <th class="str_sort">Цена</th>
                <th class="str_action">Количество</th>
            </tr>
            <?php $i=1; $total_sum=""; foreach ($show_zakaz as $item){?>
                <tr>
                    <td><?=$i++?></td>
                    <td class="name_page"><?=$item['name_phone']?></td>
                    <td><?php  echo $item['price']?></td>
                    <td><?php $total_sum += $item['price']*$item['quantity'] ;echo $item['quantity']?></td>
                </tr>
             <?php }?>
        </table>

        <h2>Общая цена заказа: <span class="show_zakaz" ><?=$total_sum?></span></h2>


        <h2>Дата заказа: <span class="show_zakaz"><?=$show_zakaz[0]['date']?></span></h2>
        <h2>Способ доставки: <span class="show_zakaz"><?=$show_zakaz[0]['name']?></span></h2>

        <h2>Данные покупателя:</h2>

        <table class="tabl" cellspacing="1">
            <tr>
                <th class="number" style="width:140px;">ФИО</th>
                <th class="str_name" style="width:200px;">Адрес</th>
                <th class="str_sort">Для связи</th>
                <th class="str_action">Примечание</th>
            </tr>

            <tr>
                <td><?=$show_zakaz[0]['customer']?></td>
                <td class="name_page"><?=$show_zakaz[0]['address']?></td>
                <td>Email: <?=$show_zakaz[0]['email']?><br />Телефон: <?=$show_zakaz[0]['phone']?></td>
                <td style="text-align:left;"><?=$show_zakaz[0]['prim']?></td>
            </tr>

        </table>
<?php } //print_array($show_zakaz)?>

</div> <!-- .content -->
</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>