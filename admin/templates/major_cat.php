<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!");

if($_SESSION['sacsess']){
    echo ($_SESSION['sacsess']);
    unset ($_SESSION['sacsess']);
    }
 ?>
<div class="content">
			<h2>Список категорий</h2>
            
			<a href="?view=add_cat"><img class="add_some" src="<?php echo TEMPLATE_ADMIN ?>/images/add_kategory.jpg" alt="добавить страницу" /></a>
			<table class="tabl" cellspacing="1">

			  <tr>
				<th class="number">№</th>
				<th class="str_name">Название категорий</th>

				<th class="str_action">Действие</th>
			  </tr>

                <?php $i=1; foreach ($cat as $key=> $arr){?>
                <?php  if ($arr[0]){?>
              
			  <tr>
				<td><? echo $i++; ?></td>
				<td class="name_page"><?php echo $arr[0]?></td>
				<td><a href="?view=edit_cat&cat_id=<?php echo $key?>" class="edit">изменить</a>&nbsp; |
                &nbsp;<a href="?view=major_cat&delit_id=<?php echo $key?>" class="del" >удалить</a></td>
			  </tr>
              
              <?php }} ?>
			</table>
			<a href="#"><img class="add_some" src="<?php echo TEMPLATE_ADMIN ?>/images/add_kategory.jpg" alt="добавить страницу" /></a>
<?php//print_array($cat); ?>
		</div> <!-- .content -->
        </div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>