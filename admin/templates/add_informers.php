<?php defined('ISHOP') or die('Access denied'); ?>

<?php
if(isset($_SESSION['edit_informer']['res'])){
    echo $_SESSION['edit_informer']['res'];
    unset($_SESSION['edit_informer']['res']);
} ?>
<div class="content">
<h2>Добавление информера:</h2>
<form  method="post">

	<table class="add_edit_page" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="add-edit-txt">Название информера:</td>
		<td><input class="head-text" type="text" name="informer_name" value="<?php echo htmlspecialchars($_SESSION['edit_informer']['informer_name']) ?>" /></td>
	  </tr>
	  <tr>
		<td>Позиция информера:</td>
		<td><input class="num-text" type="text" name="informer_position" value="<?php echo htmlspecialchars($_SESSION['edit_informer']['informer_position']) ?>" /></td>
	  </tr>

	</table>
    <input type="image" src="<?=TEMPLATE_ADMIN?>/images/save_btn.jpg" />

</form>
    <?php unset($_SESSION['edit_informer']); ?>
	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>