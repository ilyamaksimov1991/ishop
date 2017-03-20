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
    
    /* ===Пересчет в корзине=== */
    $('.table-input').each(function(){ // перебрать все элементы нужных параметров;
        var start_number = $(this).val(); // начальное значение value;
        
        $(this).change(function(){ // при изменении поля;
            var new_number = $(this).val(); // новое значение value;
            var question = "Пересчитать корзину?";
            var answer = confirm(question); // ответ пользователя. Если 'да' == 1 если 'нет' == null 
           
           if (answer){ // если да
               var id =  $(this).attr('id'); // в переменную id вставить значение атрубута id 
               var res = id.substr(2); // вырезать первые 2 символа потому что начинается id =id3;
                
                if (!parseInt(new_number)){// если не число 
                new_number = start_number; // подставляет начальное значение
                 $(this).attr('value',new_number); 
                }else{ //если число 
                    new_number = parseInt(new_number); // подставь толко числа   
                } 
                
               window.location='?view=cart&good_id='+ res +'&value=' + new_number; // оправить параметры на страницу
               
           }else{ //если нажмет нет
            $(this).val(start_number) // если нажал нет то кладу переменную начального значения
           }
            
        })
        
    })
    /* ===Пересчет в корзине=== */
    /* ===Клавиша ENTER Пересчет в корзине - отмена действия=== */
    $('.table-input').keypress(function(e){ // нажатая клавиша- передаю объект
      if (e.which == 13){// код клавиши ENTER 
       return false; // отмена действия 
     }   
    })
    /* ===Клавиша ENTER Пересчет в корзине=== */

    /*===Галерея товаров===*/
    $("a[rel='galery']").fancybox(function (){

    })
     /* var ImgArr, ImgLen;
    //Предварительная загрузка
    function Preload (url)
    {
       if (!ImgArr){
           ImgArr=new Array();
           ImgLen=0;
       }
       ImgArr[ImgLen]=new Image();
       ImgArr[ImgLen].src=url;
       ImgLen++;
    }
    $('.item_thumbs a').each(function(){
       Preload( $(this).attr('href') );
    })


    //обвес клика по превью
    $('.item_thumbs a').click(function(e){
       e.preventDefault();
       if(!$(this).hasClass('active')){
           var target = $(this).attr('href');

           $('.item_thumbs a').removeClass('active');
           $(this).addClass('active');

           $('.item_img img').fadeOut('fast', function(){
               $(this).attr('src', target).load(function(){
                   $(this).fadeIn();
               })
           })
       }
    });
    $('.item_thumbs a:first').trigger('click');*/
    /* ===Галерея товаров=== */
    
    /* === всплывающая сортировка === */
    $('#sort_clic').toggle(
        function(){
         $('.sort_hidden').css({'visibility': 'visible'});   
        },
        function(){
            $('.sort_hidden').css({'visibility':'hidden'}); 
    }
    );
    /* ===  всплывающая сортировка === */
    
});