<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!");
//print_array($news);
if($_SESSION['sacsess']){
    echo ($_SESSION['sacsess']);
    unset ($_SESSION['sacsess']);
   }
 ?>
<div class="content">
			<h2>Список новостей</h2>
            
			<a href="?view=add_news"><img class="add_some" src="<?php echo TEMPLATE_ADMIN ?>/images/add_news.jpg" alt="добавить страницу" /></a>
			<table class="tabl" cellspacing="1">

			  <tr>
				<th class="number">№</th>
				<th class="str_name">Название страницы</th>
				<th class="str_sort">Дата</th>
				<th class="str_action">Действие</th>
			  </tr>
              
              <?php $i=1; foreach($arhive_news as $arr){?>
              
			  <tr>
				<td><? echo $i++; ?></td>
				<td class="name_page"><?php echo $arr['title']?></td>
				<td><?php echo $arr['date']?></td>
				<td><a href="?view=edit_news&news_id=<?php echo $arr['news_id']?>" class="edit">изменить</a>&nbsp; | 
                &nbsp;<a href="?view=news&news_id=<?php echo $arr['news_id']?>" class="del" >удалить</a></td>
			  </tr>
              
              <?php } ?>
			</table>
			<a href="?view=add_news"><img class="add_some" src="<?php echo TEMPLATE_ADMIN ?>/images/add_news.jpg" alt="добавить страницу" /></a>
<?php
if($amount_page > 1){ pagination($page,$amount_page);}
?>
		</div> <!-- .content -->
        </div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>