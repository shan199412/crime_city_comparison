(function ($) {
    $(document).ready(function () {
        // modify the data into appropriate structure
        var citylist = [];


        // When drop down changed
        // $('#city_b').on('change', function () {
        //     $('input:checkbox').prop('checked', false);
        //     citylist = [];
        //     $('.svg2').hide();
        //     $('.alert1').hide();
        //     $('.diagram_title').hide();
        //     $('.result').hide();
        //
        //
        //     if ($('#city_b').val() !== "0") {
        //         // Reset checkbox
        //         $('#checkbox').children().show();
        //         // Hide the selected city from checkbox based on id
        //         $('#checkbox').children('#' + $('#city_b').val()).hide();
        //
        //         // Show section3
        //         $('.section3_b').fadeIn()
        //
        //         // auto scroll down to section3
        //         $('html, body').animate({
        //             scrollTop: $("div.section3_b").offset().top
        //         }, 1000)
        //
        //     } else {
        //         $('.result').hide()
        //         $('.section3_b').hide()
        //         $('.diagram_title').hide()
        //         // reset checkbox
        //     }
        // });

        // Limit number of click in checkbox to 3
        $('input:checkbox').on('change', function () {
            $('.alert1').hide()
            $('.result').hide()
            $('.svg2c').hide()
            $('.diagram_title').hide()
            $('#drop_cri').hide();

            if ($('input:checkbox:checked').length > 4) {
                $(this).prop('checked', false)
            }
        });
        //each city has specific text summary
        // var citysummary = {
        //     "Ballarat": $('.citys1').html(),
        //     "Greater Bendigo": $('.citys2').html(),
        //     "Greater Geelong": $('.citys3').html(),
        //     "Greater Shepparton": $('.citys4').html(),
        //     "Horsham": $('.citys5').html(),
        //     "Latrobe": $('.citys6').html(),
        //     "Mildura": $('.citys7').html(),
        //     "Wangaratta": $('.citys8').html(),
        //     "Warrnambool": $('.citys9').html(),
        //     "Wodonga": $('.citys10').html()
        // }
        // //the choice of city
        // var tenCities = ["", "Ballarat",
        //     "Greater Bendigo",
        //     "Greater Geelong",
        //     "Greater Shepparton",
        //     "Horsham",
        //     "Latrobe",
        //     "Mildura",
        //     "Wangaratta",
        //     "Warrnambool",
        //     "Wodonga"]

        //the function for click submit button
        $('.submit_button_b').on('click', function () {

            citylist = []
            // 2. get cities from checkbox list

            $("input:checkbox:checked").each(function () {
                citylist.push($(this).attr('id'));
            });
            if (citylist.length === 1 || citylist.length === 0) {
                $('.alert1').show()
            } else {
                //show the information which user selected

                // $('.result').empty();
                // citylist.forEach(function (id) {
                //     $('.result').append(citysummary[tenCities[id]])
                // })
                // $('.result').fadeIn();

                $('.diagram_title').fadeIn();
                $('#drop_cri').fadeIn();
                secondGraph(citylist);
                $('.svg2c').fadeIn();
            }

            $('html, body').animate({
                scrollTop: $("div.crime_res").offset().top
            }, 1000)

        })

    })
})(jQuery);