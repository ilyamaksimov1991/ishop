<?php defined('ISHOP') or die('Access denied'); ?>

<?php // print_array($cat);//echo $inf_id;//;
if(isset($_SESSION['add_category']['res'])){
    echo $_SESSION['add_category']['res'];
    unset($_SESSION['add_category']['res']);
} ?>
<div class="content">
<h2>Добавление категории/подкатегории</h2>
<form  method="post">

	<table class="add_edit_page" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="add-edit-txt">Название категории:</td>
		<td><input class="head-text" type="text" name="brand_name" value="<?php //echo ?>" /></td>
	  </tr>

      <tr>
		<td>Родительская категория:</td>

		<td>

            <select name="select">
                <option  value="0">Самостоятельная категория</option>
                <?php foreach ($cat as $kat => $array){
                    if ($array[0]){?>
                <option <?php //if($inf_id == $array[id] ) {echo 'selected';}?> value="<?php echo $kat ?>"><?php echo $array[0] ?></option>
                <?php }}?>
            </select>
        </td>
	  </tr>

	</table>

    <input type="image" src="<?=TEMPLATE_ADMIN?>/images/save_btn.jpg" />

</form>
<?php //unset ($_SESSION['add_informer']); // удаление при повтороном обновлении страницы?>
	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>