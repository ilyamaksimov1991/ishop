<?php 
define ('ISHOP',TRUE);
session_start(); // старт сессии

if ($_GET['do'] == 'logaut'){
    unset ($_SESSION['auth']['admin']);
}

if (!$_SESSION['auth']['admin']){
# 1.подключение авторизации
include __DIR__."/auth/index.php"; }
//include $_SERVER['DOCUMENT_ROOT']."/admin/auth/index.php";
//include $_SERVER['DOCUMENT_ROOT']."/admin/auth/index.php"; // путь к корневой директории

//exit(__DIR__."/admin/auth/index.php");




include "../config.php"; // подключение к/фигурационного файла



// подключение файла функций из пользов части - понадобятся несколько функций (чтоб ново не писать)
include "../function/function.php"; 

// функции административной части
include "function/function.php";

# Получение колличества необработанных заказов
//$countzakaz = countzakaz();


// загрузка картинок AjaxUpload
if($_POST['id']){
    $id = (int)$_POST['id'];
    upload_gallery_img($id);
}

// удаление картинок
if($_POST['img']) {
    $res = del_img();
    exit($res);
}
$cat=mob_phohe(); // вывод для аккардиона

$pages = pages(); // вывод страни

#  ++++++++++ 1 связка к динамическому отображению страниц
//Получение динамической части страницы
if (empty($_GET['view'])){
    $view = 'hits';
   } else {
    $view= $_GET['view'];
}
# ++++++++++ 2 связка к динамическому отображению страниц
//связка с if если есть то делает то что указано
switch ($view){
    case 'show_zak':
       $order_id= (int)$_GET['order_id'];
       if ($order_id){
       $show_zakaz = show_zakaz($order_id);
       }
    break;
    case 'new_zakaz':
        $status="WHERE o.status='0'";
        $new_zakaz= new_zakaz($status);
        if ($_GET['confirm']){
            $id=$_GET['confirm'];
            $confirm_zakaz=confirm_zakaz($id);
            if ($_SESSION['sacsess']){
                header("Location:".PATH."admin/?view=new_zakaz");
                exit;
            }
        }
        break;

    case 'zakaz':
        //$status="ORDER BY status";
        //$new_zakaz=new_zakaz($status);



        # Показывать колличетсво товаров на странице
        $amount_products = 6;

        # Номер страницы
        if ($_GET['page']){
            $page=(int)$_GET['page']; // если существует-$_GET['page'], тогда то что указанно в $_GET['page'];
            if ($_GET['page']< 1){ // если $_GET['page'] меньше 1 тогда присвоить= 1
                $page = 1;
            }
        }else{ // если $_GET['page'] не сущетвут тогда тоже присвоить= 1
            $page=1;
        }




        # Всего колличество продуктов
        $count_products= count_summa();

        # всего колличество страниц округленные в большую сторону
        $amount_page = ceil($count_products/$amount_products);

        // ecли нет КОЛЛИЧЕСТВА СТРАНИЦ=Всего продуктов/ колличество товаров на страница то все равно=1
        if (!$amount_page)$amount_page=1;

        // если страница больше чем коолличестов страниц приравнять страницу к колличествам страниц
        if($page>$amount_page)$page=$amount_page;

        # С какого продукта показать
        $start_position= ($page-1)*$amount_products; //(№страницы - 1)*колличество показа на странице;

        $navig_confirm_zakaz = navig_confirm_zakaz($start_position,$amount_products);
    break;
     case 'content':
      if ($_GET['delit_id']){
        $id=(int)$_GET['delit_id'];
        delit_page($id);
        
        header("Location:".PATH."admin/");
        
        
        exit;
      }
     break;
      # Информеры
     case 'informers': /* Информеры*/
     $show_ihformers = show_ihformers();
          if ($id =  abs((int)$_GET['inf_id'])) {
              $delit_links = delit_links($id);
              if ($_SESSION['sacsess']){
                  header("Location:".PATH."admin/?view=informers");
                  exit;
              }
          }
              if ($id =  abs((int)$_GET['delite_id'])) {
                  $delite_informer = delite_informer($id);
                  if ($_SESSION['sacsess']){
                     header("Location:".PATH."admin/?view=informers");
                      exit;
                  }

          }
     break;

    case 'add_informers': /* добавить  информер*/
         if ($_POST){
            $add_informer = add_informer();
             if ($_SESSION['sacsess']){
                 header("Location:".PATH."admin/?view=informers");
                 exit;
         }}
        break;

    case 'add_links': /* добавить страницу в информеры*/

    if($_POST){$add_page_informers=add_page_informers();
        if ($_SESSION['sacsess']){
            header("Location:".PATH."admin/?view=informers");
            exit;
        }else if($_SESSION['add_page_informer']['res']){
                header("Location:".$_SERVER['REQUEST_URI']);
                exit;
        }
    }
    $inf_id= $_GET['inf_id'];
    break;

    case 'eddit_links': /* редактирование страницы Информера*/
        if ($_GET['inf_id']){
            $link_id =abs((int)$_GET['inf_id']);
        $show_link_page=show_link_page($link_id);
        }
        if ($_POST){
            $edit_links= edit_links($link_id);
            if ($_SESSION['sacsess']){
                header("Location:".PATH."admin/?view=informers");
                exit;
            }else if($_SESSION['change_page']['res']){
                header("Location:".$_SERVER['REQUEST_URI']);
                exit;
            }}
    break;

    case 'edit_informers': /* редактирование Информера*/
        if ($_GET['inf_id']){
       $id = abs((int)$_GET['inf_id']);
       $show_edit_informers =show_edit_informers($id);
        }
        if($_POST){
            $edit_informers = edit_informers($id);
            if ($_SESSION['sacsess']){
                header("Location:".PATH."admin/?view=informers");
                exit;
            }else if($_SESSION['change_page']['res']){
                header("Location:".$_SERVER['REQUEST_URI']);
                exit;
            }
        }
    break;

    case 'major_cat': // категории
        if ($_GET['delit_id']){
            $delit_id=$_GET['delit_id'];
            $pod_category_isset = $cat[$delit_id]['sub'];
            $delite_category = delite_category($delit_id,$pod_category_isset);
            if ($_SESSION['sacsess']){
                header("Location:".PATH."admin/?view=major_cat");
                exit;
        }}
    break;

    case 'add_cat': // добавить категорию
        if ($_POST) {
            $add_category = add_category();

        if ($_SESSION['sacsess']){
             header("Location:".PATH."admin/?view=major_cat");
                exit;
            }else if($_SESSION['add_category']['res']){
            header("Location:".$_SERVER['REQUEST_URI']);
            exit;
        }}
    break;
    case 'edit_cat': // редактировать категорию
        $cat_id = (int)$_GET['cat_id'];
        $podcat_id = (int)$_GET['id_podcat'];
        $id_cat = (int)$_GET['id_cat'];
         #########
         if ($cat_id){
          $category_name = $cat[$cat_id][0];
          $pod_category_isset = $cat[$cat_id]['sub'];

             if ($_POST){
                 $edit_category = edit_category($cat_id);
                 if ($_SESSION['sacsess']){
                     header("Location:".PATH."admin/?view=major_cat");
                     exit;
                 }else if($_SESSION['add_category']['res']){
                     header("Location:".$_SERVER['REQUEST_URI']);
                     exit;
                 }}
         ######
         }else if ( $id_cat ==  $podcat_id ){ // ели есть оба значение - для страницы с перехода из категорий либо одно значение для страницы из каталога
            $category_name = $cat[$id_cat][0];
             $pod_category_isset = $cat[$id_cat]['sub'];

             if ($_POST){
                 $edit_category = edit_category($id_cat);
                 if ($_SESSION['sacsess']){
                     header("Location:".PATH."admin/?view=cat&category=$id_cat");
                     exit;
                 }else if($_SESSION['add_category']['res']){
                     header("Location:".$_SERVER['REQUEST_URI']);
                     exit;
                 }}
           #######
          } else if ( $id_cat !=  $podcat_id){

          $category_name = $cat[$podcat_id]['sub'][$id_cat];
             if ($_POST){
                 $edit_category = edit_category($id_cat);
                 if ($_SESSION['sacsess']){
                     header("Location:".PATH."admin/?view=cat&category=$id_cat");
                     exit;
                 }else if($_SESSION['add_category']['res']){
                     header("Location:".$_SERVER['REQUEST_URI']);
                     exit;
                 }}
          }


    break;
    case 'cat'://  вывод товаров по категориям

        if ($_GET['delit_cat']){
            $delit_cat=$_GET['delit_cat'];
            $pod_category_isset = $cat[$delit_cat]['sub'];
            $delite_category = delite_category($delit_cat,$pod_category_isset);
            if ($_SESSION['sacsess']){
                header("Location:".PATH."admin/?view=cat");
                exit;
            }}
        $category= abs((int)$_GET['category']);

        $bread_crumbs = bread_crumbs($category); // показ хлебных крошек

        # Показывать колличетсво товаров на странице
        $amount_products = 6;

        # Номер страницы
        if ($_GET['page']){
            $page=$_GET['page']; // если существует-$_GET['page'], тогда то что указанно в $_GET['page'];
            if ($_GET['page']< 1){ // если $_GET['page'] меньше 1 тогда присвоить= 1
                $page = 1;
            }
        }else{ // если $_GET['page'] не сущетвут тогда тоже присвоить= 1
            $page=1;
        }




        # Всего колличество продуктов
        $count_products= count_products($category);

        # всего колличество страниц округленные в большую сторону
        $amount_page = ceil($count_products/$amount_products);

        // ecли нет КОЛЛИЧЕСТВА СТРАНИЦ=Всего продуктов/ колличество товаров на страница то все равно=1
        if (!$amount_page)$amount_page=1;

        // если страница больше чем коолличестов страниц приравнять страницу к колличествам страниц
        if($page>$amount_page)$page=$amount_page;

        # С какого продукта показать
        $start_position= ($page-1)*$amount_products; //(№страницы - 1)*колличество показа на странице;

        $show = show_phohe($category,$start_position,$amount_products);

    break;

    case 'add_product':
        $category=(int)$_GET['category'];

            if ($_POST){
                $add_product = add_product($category);
                if ($_SESSION['sacsess']){
                    header("Location:".PATH."admin/?view=cat&category=$category");
                    exit;
                }else if($_SESSION['add_product']['res']){
                    header("Location:".$_SERVER['REQUEST_URI']);
                    exit;
                }}
        if ($_GET['delit_cat']){
            $delit_cat=$_GET['delit_cat'];
            $pod_category_isset = $cat[$delit_cat]['sub'];
            $delite_category = delite_category($delit_cat,$pod_category_isset);
            if ($_SESSION['sacsess']){
                header("Location:".PATH."admin/?view=cat");
                exit;
            }}

        break;

    case 'edit_product':
        $goods_id = $_GET['goods_id'];
        $show_product_id = show_product_id($goods_id);
         # если есть картинка
        if ($show_product_id[0]['img'] AND ($show_product_id[0]['img'] != "no_image.jpg")){  // чтобы ее удалить
            $image = "<div class='del_image_product'><img rel='0' class='del_image_show' width='30px' src='".PRODUCTIMG."baseimg/".$show_product_id[0]['img']."' alt='".$show_product_id[0]['img']."'/></div>";
                $del="<span class='del_image'></br> щелкните по картинке чтобы удалить</span>";
        } else{ // а иначе
            $image = "<input type='file' name='baseimg' />"; // чтобы ее добавить
            $del="";
        }
        // если есть картинки галереи
        $imgslide = "";
        if ($show_product_id[0]['img_slide']){
            $image_slide = explode("|", $show_product_id[0]['img_slide']);

            for ($i=0; $i< count ($image_slide); $i++){
                $imgslide .= "<img rel='1' class='del_image_show' width='' src='".PRODUCTIMG."thumbs/".$image_slide[$i]."' alt='".$image_slide[$i]."'/>";

        }
            $del="<span class='del_image'></br> щелкните по картинке чтобы удалить</span>";
        }

        if ($_POST){
            $edit_product= edit_product($goods_id);
            if ($_SESSION['sacsess']){
                header("Location:".PATH."admin/?view=cat");
                exit;
            }else if($_SESSION['edit_product']['res']){
                header("Location:".$_SERVER['REQUEST_URI']);
                exit;
            }}
        break;
     case'edit_page': /* Редактирование страниц*/
     $page_id = ((int)$_GET['page_id']);
     $page_information = page_information($page_id);
     
     if ($_POST){
        $change_page=change_page($page_id);
        if ($_SESSION['sacsess']){
            header("Location:".PATH."admin/");
            exit;
        }else if($_SESSION['change_page']['res']){
            header("Location:".$_SERVER['REQUEST_URI']);
            exit;
        }
     }
     break;
     
     case 'add_page': /* добавление страницы*/
      if ($_POST){
        $add_page=add_page();
        if ($_SESSION['sacsess']){
            header("Location:".PATH."admin/");
            exit;
        }else if($_SESSION['add_page']['res']){
            header("Location:".$_SERVER['REQUEST_URI']);
            exit;
        }
        }
     break;
     case 'edit_news':
     if ($_GET['news_id']){
        $news_id= abs((int)$_GET['news_id']);
        $news=news($news_id);
     }
     if ($_POST){
       $edit_news = edit_news($news_id);
       if ($_SESSION['sacsess']){
            header("Location:".PATH."admin/?view=news");
            exit;
        }else if($_SESSION['add_news']['res']){
            header("Location:".$_SERVER['REQUEST_URI']);
            exit;
        }
     }
     break;
    
     case 'news': /* Новости*/
    if ($_GET['news_id']){
       $news_id= abs((int)$_GET['news_id']);
       $delit_news = delit_news($news_id);
        }
    
     
      # Показывать колличетсво товаров на странице
     $amount_products = 3;
      # Номер страницы
     if ($_GET['page']){
        $page= abs((int)$_GET['page']); // если существует-$_GET['page'], тогда то что указанно в $_GET['page'];
        if ($_GET['page']< 1){ // если $_GET['page'] меньше 1 тогда присвоить= 1
           $page = 1; 
        }
        }else{ // если $_GET['page'] не сущетвут тогда тоже присвоить= 1
          $page=1;  
        }
     
    # Всего колличество продуктов  
     $count_products= count_news();
    
     # всего колличество страниц округленные в большую сторону
     $amount_page = ceil($count_products/$amount_products);
     
     // ecли нет КОЛЛИЧЕСТВА СТРАНИЦ=Всего продуктов/ колличество товаров на страница то все равно=1  
     if (!$amount_page)$amount_page=1;
     
     // если страница больше чем коолличестов страниц приравнять страницу к колличествам страниц
     if($page>$amount_page)$page=$amount_page;
     
     # С какого продукта показать
     $start_position= ($page-1)*$amount_products; //(№страницы - 1)*колличество показа на странице;
     
     $arhive_news = news_show($start_position,$amount_products);
     break;
     
     case 'add_news': /* добавление новости*/
     if ($_POST){
        $add_news = add_news();
         if ($_SESSION['sacsess']){
            header("Location:".PATH."admin/?view=news");
            exit;
        }else if($_SESSION['add_news']['res']){
            header("Location:".$_SERVER['REQUEST_URI']);
            exit;
        }
     }
     break;
     
     
     default:
     $view= 'content';
      
}
include_once TEMPLATE_ADMIN.'/heder.php';

include_once TEMPLATE_ADMIN.'/leftbar.php';
//exit(TEMPLATE_ADMIN.'/leftbar.php');
//exit("http://cm92106.tmweb.ru".$_SERVER['DOCUMENT_ROOT']."/admin/auth/index.php");

# ++++++++++ 3 связка к динамическому отображению страниц
include_once TEMPLATE_ADMIN."/".$view.'.php';

?>