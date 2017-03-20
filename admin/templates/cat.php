<?php defined('ISHOP') or die('Access denied'); ?>
<div class="content">
    <h2>Редактирование каталога</h2>
    <?php
    if(isset($_SESSION['sacsess'])){
        echo $_SESSION['sacsess']."</br>";
        unset($_SESSION['sacsess']);
    }
   // print_array($countzakaz );
    ?>

    <a href="?view=add_cat"><img class="add_kategory" src="<?=TEMPLATE_ADMIN?>/images/add_kategory.jpg" alt="добавить категорию" /></a>
    <div class="crosh">

            <?php if(count($bread_crumbs)>1){?>
        <p class="crosh-left"><a href="<?php echo PATH ?>" >Мобильные телефоны</a> / <a href="?view=cat&category=<?php echo $bread_crumbs[0]['brand_id'] ?>">
                <?php echo $bread_crumbs[0]['brand_name'] ?></a> / <span><?php echo $bread_crumbs[1]['brand_name'] ?></span></p>
        <?php } ?>
        <?php if(count($bread_crumbs)== 1){?>
        <p class="crosh-left"><a href="<?php echo PATH ?>" >Мобильные телефоны</a> / <span><?php echo $bread_crumbs[0]['brand_name'] ?></span></p>
        <?php } ?>
        <p class="crosh-right"><a href="?view=edit_cat&id_cat=<?php  echo $category ?>&id_podcat=<?php echo $bread_crumbs[0]['brand_id']?>" class="edit">изменить категорию</a>&nbsp;
            | &nbsp;<a href="?view=cat&delit_cat=<?php echo $category ?>" class="del">удалить категорию</a></p>
    </div>

    <a href="?view=add_product&category=<?php  echo $category ?>"><img class="add_some" src="<?=TEMPLATE_ADMIN?>/images/add_product.jpg" alt="добавить продукт" /></a>

    <?php if($show): // если есть товары?>
        <?php
        $col = 3; // количество ячеек в строке
        $row = ceil((count($show)/$col)); // количество рядов
        $start = 0;
        ?>
        <table class="tabl-kat" cellspacing="1">
            <?php for($i = 0; $i < $row; $i++): // цикл вывода рядов ?>
                <tr>
                    <?php for($k = 0; $k < $col; $k++): // цикл вывода ячеек ?>
                        <td>
                            <?php if($show[$start]): // если есть товар ?>
                                <h2><?php echo $show[$start]['name'] ?></h2>
                               <div class="prod-tabl">
                                <img src="<?=PRODUCTIMG?>baseimg/<?php echo $show[$start]['img'] ?>" alt="" />
                                </div>
                                <p><a href="?view=edit_product&amp;goods_id=<?php echo $show[$start]['goods_id'] ?>" class="edit">изменить</a>&nbsp; | &nbsp;<a href="?view=del_product&amp;goods_id=<?php echo $show[$start]['goods_id'] ?>" class="del">удалить</a></p>
                            <?php else: // если нет товара ?>
                                &nbsp;
                            <?php endif; // перенос внутрь ячейки ?>
                            <?php $start++; ?>
                        </td>
                    <?php endfor; // конец цикла вывода ячеек ?>
                </tr>
            <?php endfor; // конец цикла вывода рядов ?>
        </table>
    <?php else: // если нет товаров ?>
        <p>Здесь товаров пока нет </p></br>
    <?php endif; // конец условия: если есть товары ?>
    <a href="?view=add_product&category=<?php  echo $category ?>"><img class="add_some" src="<?=TEMPLATE_ADMIN?>/images/add_product.jpg" alt="добавить продукт" /></a>
    <?php if($amount_page > 1) pagination1($page, $amount_page); ?>
</div> <!-- .content -->
</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>