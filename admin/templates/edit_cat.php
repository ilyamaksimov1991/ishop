<?php defined('ISHOP') or die('Access denied'); ?>

<?php
if(isset($_SESSION['edit_cat']['res'])){
    echo $_SESSION['edit_cat']['res'];
    unset($_SESSION['edit_cat']['res']);
} ?>
<div class="content">
<h2>Редактирование категории</h2>
<form  method="post">

	<table class="add_edit_page" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="add-edit-txt">Название категории:</td>
		<td><input class="head-text" type="text" name="brand_name" value="<?php echo $category_name ?>" /></td>
	  </tr>

      <tr>
		<td>Родительская категория:</td>

		<td>
           <?php  if(!isset($pod_category_isset)){?>
            <select name="select">
                <option  value="0">Самостоятельная категория</option>
                <?php foreach ($cat as $kat => $array){

                      if ($array[0]){?>
                <option  value="<?php echo $kat ?>"><?php echo $array[0] ?></option>
                <?php }}?>
            </select>
            <?php }else{
               echo '<p>Категория имеет подкатегории/ перемещать-запрещено</p>';
           }?>
        </td>
	  </tr>

	</table>

    <input type="image" src="<?=TEMPLATE_ADMIN?>/images/save_btn.jpg" />

</form>
<?php //print_array($cat);//unset ($_SESSION['add_informer']); // удаление при повтороном обновлении страницы?>
	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>