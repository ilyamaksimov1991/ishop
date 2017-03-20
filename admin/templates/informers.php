<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!");
//print_array($show_ihformers);
if ($_SESSION['sacsess']){
    echo $_SESSION['sacsess'];
    unset ($_SESSION['sacsess']);

}
?>

<div class="content">
    <h2>Информеры</h2>
    <a href="?view=add_informers"><img class="add_some" src="<?php echo TEMPLATE_ADMIN?>/images/add_inf.jpg" alt="добавить информер" /></a>
    <div id="accordion_informers">
    <?php foreach($show_ihformers as $array){?>

        <div class="inf-down">

            <p class="toggle"></p>

            <h3><?php echo $array[0] // название информера?></h3>
            <p class="inf-link"><a href="?view=edit_informers&inf_id=<?php echo $array['id']?>" class="edit">изменить</a>&nbsp;
                | &nbsp;<a href="?view=informers&delite_id=<?php echo $array['id']?>" class="del">удалить</a></p>
        </div> <!-- .inf-down -->

        <div class="inf-page">
            <?php if (count($array['sub'])>0){?>
            <table class="inf-tabl" cellspacing="1">

                <tr>
                    <th class="number">№</th>
                    <th class="str_name">Название страницы</th>
                    <th class="str_sort">Сортировка</th>
                    <th class="str_action">Действие</th>
                </tr>
                <?php $z=1; $i=1; foreach($array['sub'] as $key => $item){?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td class="name_page"><?= $item?></td>
                            <td><?=$z++?></td>
                            <td><a href="?view=eddit_links&inf_id=<?php echo $key?>" class="edit">изменить</a>&nbsp; | &nbsp;<a href="?view=informers&inf_id=<?php echo $key?>" class="del">удалить</a></td>
                        </tr>
                 <?php }?>

            </table>
            <?php }else{ echo "Информеров пока нет </br></br>";}?>
            <a href="?view=add_links&inf_id=<?php echo $array['id']?>"><img class="add_some" src="<?php echo TEMPLATE_ADMIN?>/images/add_page_inf.jpg" alt="добавить страницу" /></a>

        </div> <!-- .inf-page-->

            <?php }?>
    </div>

    <a href="?view=add_informers"><img class="add_some" src="<?=TEMPLATE_ADMIN?>/images/add_inf.jpg" alt="добавить информер" /></a>

    <?php //print_array($show_ihformers);?>

</div> <!-- .content-main -->
</div>
</div> <!-- .karkas -->
</body>
</html>