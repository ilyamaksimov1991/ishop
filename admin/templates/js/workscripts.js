$(document).ready(function(){

    /* ===Аккордеон=== */
    var openItem = false;
    if(jQuery.cookie("openItem") && jQuery.cookie("openItem") != 'false'){
        openItem = parseInt(jQuery.cookie("openItem"));
    }
    jQuery("#accordion").accordion({
        active: openItem,
        collapsible: true,
        autoHeight: false,
        header: 'span'
    });
    jQuery("#accordion span").click(function(){
        jQuery.cookie("openItem", jQuery("#accordion").accordion("option", "active"));
    });
    jQuery("#accordion > li").click(function(){
        jQuery.cookie("openItem", null);
        var link = jQuery(this).find('a').attr('href');
        window.location = link;
    });
    /* ===Аккордеон=== */
    
    // удаление 
      $('.del').click(function(){
        var res= confirm ("Подтвердите удаление");
        if (!res) return false;
      });   
    // удаление

    // при клике скрыть/раскрыть
    $('.toggle').click( function () {
        $(this).parent().next().slideToggle(500); // следущий элемент после  родителя открыть/скрыть за 500мсек

        if( $(this).parent().attr('class')== 'inf-down'){ // если класс = 'inf-down'
        $(this).parent().removeClass('inf-down'); // удалить класс
        $(this).parent().addClass('inf-up'); // добавить класс
        }else{
              // иначе
            $(this).parent().removeClass('inf-up'); //удалить класс
            $(this).parent().addClass('inf-down'); // добавить класс
        }
    });
    // при клике скрыть/раскрыть
    // добавление кнопки с добавлением картинок
     var max = 5;
     var min = 1;

     $("#del").attr('disabled',true); // заблокированная кнопка del

         $("#add").click(function(){ // при клике на кнопку
             var total= $("input[name='galleryimg[]']").length; // узнать колличество таких элементов
             if (total < max){
            $("#btnimg").append('<div><input type="file" name="galleryimg[]" /></div>'); // добить такие элементы
                 $("#del").attr('disabled',false); // разблокировка книпки удалить
             }
             if (total +1 == max){
                 $("#add").attr('disabled', true);// блокировка кнопки добавить
             }
            });

    $("#del").click(function(){
        var total= $("input[name='galleryimg[]']").length; // узнать колличество таких элементов
        if (total > min){
            $("#btnimg div:last-child").remove(); // удалить инпут
            $("#add").removeAttr('disabled'); // разблокировать добавление
        }
        if (total - 1 == min){
            $("#del").attr('disabled',true); // заюлокировать удаление
        }

    });

    // удаление картинок
    $(".del_image_show").on("click", function(){
        var res = confirm("Подтвердите удаление");
        if(!res) return false;

        var img = $(this).attr("alt"); // имя картинки
        var rel = $(this).attr("rel"); // 0 - базовая картинка, 1 - картинка галереи
        var goods_id = $("#goods_id").text(); // ID товара
        $.ajax({
            url: "./",
            type: "POST",
            data: {img: img, rel: rel, goods_id: goods_id},
            success: function(res){
                if(rel == 0){
                    // базовая картинка
                    $(".del_image_show1").fadeOut(500, function(){
                        $(".del_image_show1").empty().fadeIn(500).html(res);
                    });
                }else{
                    // картинка галереи
                    $(".slideimg").find("img[alt='" + img + "']").hide(500);
                }
            },
            error: function(){
                alert("Error");
            }
        });
    });
    // удаление картинок

});