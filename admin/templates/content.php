<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!");
//print_array($pages);
if($_SESSION['sacsess']){
    echo ($_SESSION['sacsess']);
    unset ($_SESSION['sacsess']);
    }
 ?>
<div class="content">
			<h2>Список страниц</h2>
            
			<a href="?view=add_page"><img class="add_some" src="<?php echo TEMPLATE_ADMIN ?>/images/add_page.jpg" alt="добавить страницу" /></a>
			<table class="tabl" cellspacing="1">

			  <tr>
				<th class="number">№</th>
				<th class="str_name">Название страницы</th>
				<th class="str_sort">Сортировка</th>
				<th class="str_action">Действие</th>
			  </tr>
              
              <?php $i=1; foreach($pages as $arr){?>
              
			  <tr>
				<td><? echo $i++; ?></td>
				<td class="name_page"><?php echo $arr['title']?></td>
				<td><?php echo $arr['position']?></td>
				<td><a href="?view=edit_page&page_id=<?php echo $arr['page_id']?>" class="edit">изменить</a>&nbsp; | 
                &nbsp;<a href="?view=content&delit_id=<?php echo $arr['page_id']?>" class="del" >удалить</a></td>
			  </tr>
              
              <?php } ?>
			</table>
			<a href="#"><img class="add_some" src="<?php echo TEMPLATE_ADMIN ?>/images/add_page.jpg" alt="добавить страницу" /></a>

		</div> <!-- .content -->
        </div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>