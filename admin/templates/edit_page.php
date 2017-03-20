<?php defined('ISHOP') or die('Access denied'); ?>

<?php
if(isset($_SESSION['change_page']['res'])){
    echo $_SESSION['change_page']['res'];
    unset($_SESSION['change_page']['res']);
} ?>	<div class="content">
<h2>Редактирование страницы</h2>
<form action="" method="post">
	<?php foreach ($page_information as $arr){?>
	<table class="add_edit_page" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="add-edit-txt">Название страницы:</td>
		<td><input class="head-text" type="text" name="title" value="<?php echo $arr['title']?>" /></td>
	  </tr>
	  <tr>
		<td>Ключевые слова:</td>
		<td><input class="head-text" type="text" name="keywords" value="<?=htmlspecialchars($arr['keywords'])?>" /></td>
	  </tr>
      <tr>
		<td>Описание:</td>
		<td><input class="head-text" type="text" name="description" value="<?=htmlspecialchars($arr['description'])?>" /></td>
	  </tr>
	  <tr>
		<td>Позиция страницы:</td>
		<td><input class="num-text" type="text" name="position" value="<?=$arr['position']?>" /></td>
	  </tr>
	   <tr>
		<td>Содержание страницы:</td>
		<td></td>
	  </tr>
	  <tr>
		<td colspan="2">
			<textarea id="editor1" class="full-text" name="text"><?php echo $arr['text']?></textarea>
            <?php }?>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
</script>
		</td>
	  </tr>
	</table>
	
	<input type="image" src="<?=TEMPLATE_ADMIN?>/images/save_btn.jpg" /> 

</form>

	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>