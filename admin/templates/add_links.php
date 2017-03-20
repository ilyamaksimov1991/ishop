<?php defined('ISHOP') or die('Access denied'); ?>

<?php //echo $inf_id;//print_array($_SESSION);
if(isset($_SESSION['add_page_informer']['res'])){
    echo $_SESSION['add_page_informer']['res'];
    unset($_SESSION['add_page_informer']['res']);
} ?>
<div class="content">
<h2>Добавление страницы в информеры</h2>
<form  method="post">

	<table class="add_edit_page" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="add-edit-txt">Название страницы:</td>
		<td><input class="head-text" type="text" name="link_name" value="<?php //echo ?>" /></td>
	  </tr>
	  <tr>
		<td>Описание страницы:</td>
		<td><input class="head-text" type="text" name="description" value="<?php echo htmlspecialchars($_SESSION['add_page_informer']['description']) ?>" /></td>
	  </tr>
        <tr>
            <td>Ключевые слова:</td>
            <td><input class="head-text" type="text" name="keywords" value="<?php echo htmlspecialchars($_SESSION['add_page_informer']['keywords']) ?>" /></td>
        </tr>
      <tr>
		<td>Информер:</td>

		<td>

            <select name="select">
                <?php foreach (show_ihformers() as $array){?>
                <option <?php if($inf_id == $array[id] ) {echo 'selected';}?> value="<?php echo $array[id] ?>"><?php echo $array[0] ?></option>
                <?php }?>
            </select>
        </td>
	  </tr>
	  <tr>
		<td>Позиция страницы:</td>
		<td><input class="num-text" type="text" name="links_position" value="<?php echo htmlspecialchars($_SESSION['add_page_informer']['links_position']) ?>" /></td>
	  </tr>
	   <tr>
		<td>Содержание страницы:</td>
		<td></td>
	  </tr>
	  <tr>
		<td colspan="2">
			<textarea id="editor1" class="full-text" name="text"><?php echo htmlspecialchars($_SESSION['add_page_informer']['text']) ?></textarea>
            <?php //}?>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
</script>
		</td>
	  </tr>
	</table>

    <input type="image" src="<?=TEMPLATE_ADMIN?>/images/save_btn.jpg" />

</form>
<?php //unset($_SESSION['add_page_informer']); // удаление при повтороном обновлении страницы?>
	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>