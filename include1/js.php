<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/countdown.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="js/gmaps.min.js"></script>
<script src="js/main.js"></script>
<script>
    $(document).ready(function () {
        var a=$('#search_text').val();

        $('#search_input_box').css('display', 'block');
        $('#qty').css('display', 'block');
        $('#languvage_select').css('display', 'block');
        // $('.nice-select').css('display', 'none');
    });

</script>

<script>
    $(document).on('click', '#search', function (e) {
        $('#search_input_box').css('display', 'block');
    });
    $(document).on('click', '#searchs', function (e) {
        $('#search_input_box').css('display', 'block');

        $('.search_input').css('display', 'block');
        var search_text = $('#search_text').val();
        if(search_text==''){
            return false;
            $('#search_input_box').css('display', 'block');
            $('.search_input').css('display', 'block');
        }else{
            window.location = 'search_product.php?search=' + search_text;
        }



    });
    $("#search_input_box").mouseover(function () {

        $("#search_input_box").css("background-color", "white");
        $("#search_input_box").css("border-color", "black");
        $("#search_input_box").css("border", "solid");
        // $("#search_text").css("color", "black");
        // $("#search").css("color", "blcksearch_text");
    });
    $("#search_input_box").mouseout(function () {
      $("#search_input_box").css("background-color", "white");
    });
    $(document).on('change', '#languvage_select', function (e) {
        var pro_ids = '<?php echo $pro_idss;?>';
        var search_g = '<?php echo $search_g;?>';
        var languvage_select = $(this).val();
        if ((pro_ids != 0) && (search_g)) {
            pro_ids = '?pro_id=' + pro_ids + '&lang=' + languvage_select+'&search='+search_g;
        } else if(pro_ids != 0) {
            pro_ids = '?pro_id=' + pro_ids + '&lang=' + languvage_select;

        }else if(search_g){
            pro_ids = '?lang=' + languvage_select+'&search='+search_g;
        }else{
            pro_ids = '?lang=' + languvage_select;
        }
        var file_name_url = '<?php echo $file_name_url;?>';
        window.location = file_name_url + pro_ids;


    });
</script>
<script>
    $(document).on('click', '#clear_text', function (e) {
        // alert();
        $('#search_text').val('');
        $('.tag_clicks').remove();
        $('.tagsget').hide();
    });
    $(document).on('click', '#searchs', function (e) {
        var search_text=$('#search_text').val();
        if(search_text){
            window.location = 'search_product.php?search=' + search_text;
        }else{
            alert('Place Enter Value ');
            $( "#search_text" ).focus();
            return false;
        }
    });
</script>
<script>
    $(document).on('keyup', '.task', function (event) {
        var availableTags = $(this).val();
        var is = $(this);
        if(availableTags!=''){
        $('#close_btn').show();
        }else{
            $('#close_btn').hide();
        }
        $('.tagsget').html();
        var length = $(this).val().length;
        var lang='<?php echo $lang; ?>';
        if (length > 2) {
            $.post('index.php', {
                tags: availableTags,
                lang: lang
            }, function (data) {
                // console.log(data);
                // alert(data);
                var obj = $.parseJSON(data);
                $('.tagsget').html('');
                $.each(obj, function(key,value){
                    console.log(value);
                    // alert("output: "+key+" value "+value);
                    if (value !== null && availableTags !== '') {
                        is.closest(".container").find('.tagsget').show();
                        var value_split=value.split(',')
                        for (var i = 0; i < value_split.length; i++)
                        {

                                is.closest(".container").find('.tagsget').append("<p style=' background-color: #f9f9ff;color: black;padding: 2px; font-size: 16px; cursor: pointer;margin-bottom: 5px;text-align: left;max-width: 200px;font-weight: bold;' class='tag_clicks' > " + value_split[i] + "</p>");

                        }
                    } else {
                        $('.tagsget').hide();
                        event.preventDefault();
                    }


                });

                // alert(obj);


            });
        }
    });

    $(document).on('click', '.tag_clicks', function () {
        var vals = $.trim($(this).text());
        // alert(vals);
        window.location.href = 'search_product.php?search=' + vals;
    });

    $(document).on('keyup ', '.task', function () {
        // alert('abc');
        var availableTags=$(this).val();
        if(availableTags!=''){
            $('#close_btn').show();
        }else{
            $('#close_btn').hide();
        }
        $('.tag_clicks').remove();
        $('.tagsget').hide();
    });
    // function checkdub()
    // {
    //     $('.divc').remove();
    //     $.each($('.task_append'), function (index1, item1) {
    //         var iss = $(this);
    //         var count = 0;
    //         var select_project = $(this).find(".select1").val();
    //         var input_task = $.trim($(this).find(".task").val());
    //         var con_pro_task = select_project + input_task.toString().toLowerCase();
    //         console.log('firsteach :' + con_pro_task);
    //         $.each($('.task_append').not(iss), function (index2, item2) {
    //             count = $('.divc').size();
    //             var select_project1 = $(this).find(".select1").val();
    //             var input_task1 = $.trim($(this).find(".task").val());
    //             var con_pro_task1 = select_project1 + input_task1.toString().toLowerCase();
    //             if (input_task !== '' && input_task1 !== '') {
    //                 if (con_pro_task == con_pro_task1) {
    //                     console.log('secound:' + con_pro_task1);
    //                     if (count > 2) {
    //                         $(this).find('.task').parent().find(".divc").remove();
    //                     }
    //                     $(this).find(".task").parent().append('<span style="color:red" class="divc"> Task Name  Exist </span> ');
    //                 }
    //             }
    //         });
    //     });
    // }
</script>
