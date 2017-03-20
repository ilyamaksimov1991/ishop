<?php defined('ISHOP') or die('Access denied');
if(isset($_SESSION['add_news']['res'])){
    echo $_SESSION['add_news']['res'];
    unset($_SESSION['add_news']['res']);
} ?>
<div class="content">
<h2>Добавление новости:</h2>
<form action="" method="post">

	<table class="add_edit_page" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="add-edit-txt">Название новости:</td>
		<td><input class="head-text" type="text" name="title" value="<?php echo htmlspecialchars($_SESSION['add_news']['title'])?>" /></td>
	  </tr>
	  <tr>
		<td>Анонс:</td>
		<td><input class="head-text_news" type="text" name="anons" value="<?php echo htmlspecialchars($_SESSION['add_news']['anons'])?>" /></td>
	  </tr>
	  <tr>
		<td>Дата:</td>
		<td><input class="num-text_news" type="text" name="date" value="<?php echo ($_SESSION['add_news']['date'])?>" /></td>
	  </tr>
	   <tr>
		<td>Содержание страницы:</td>
		<td></td>
	  </tr>
	  <tr>
		<td colspan="2">
			<textarea id="editor1" class="full-text" name="text"><?php echo htmlspecialchars($_SESSION['add_news']['text'])?></textarea>
            <?php ?>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
</script>
		</td>
	  </tr>
	</table>
	
	<input type="image" src="<?=TEMPLATE_ADMIN?>/images/save_btn.jpg" /> 

</form>
    <?php unset($_SESSION['add_news']); // удаление при повтороном обновлении страницы?>
	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>