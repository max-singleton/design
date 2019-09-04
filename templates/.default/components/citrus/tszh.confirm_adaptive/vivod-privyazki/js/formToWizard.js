/* Created by jankoatwarpspeed.com */

(function ($) {
    $.fn.formToWizard = function (options) {
        options = $.extend({}, options);

        var element = $("div#SignupForm");

        var steps = $(element).find("fieldset");
        var count = steps.size();
        var submmitButtonName = "#" + options.submitButton;

        $(submmitButtonName).hide();

        // 2
        $(element).before("<ul id='steps'></ul>");

        steps.each(function (i) {
            $(this).wrap("<div id='step" + i + "'></div>");
            $(this).append("<p id='step" + i + "commands' style='text-align:right'></p>");

            // 2
            var name = $(this).find("legend").html();
            $("#steps").append("<li id='stepDesc" + i + "'  class='hiddden' style='text-align: center' >" + BX.message('STEP_TITLE') + (i + 1) + "<span>" + name + "</span></li>");
            if ($('#steps').find('li').hasClass("current"))
            {
                $('#steps').find('li').removeClass('hidden')
            }
            else
            {
                $('#steps').find('li').addClass('hidden')
            }
            if (i == 0) {
                createNextButton(i);
                selectStep(i);
            } else if (i == count - 1) {
                $("#step" + i).hide();
                //createPrevButton(i);
            } else if (i == 2) {
                $("#step" + i).hide();
                /*createPrevButton(i);*/
            } else {
                $("#step" + i).hide();
                createPrevButton(i);
                createNextButton(i);
            }
        });

        function createPrevButton(i) {
            var stepName = "step" + i;
            $("#" + stepName + "commands").append("<button  id='" + stepName + "Prev' class='form-variable__button form-variable__saved link-theme-default' '>< " + BX.message('PREV_TITLE') + "</button>");
            $("#" + stepName + "Prev").bind("click", function (e) {
                e.preventDefault();
                $("#progress").progressbar("option", "value", $("#progress").progressbar("option", "value") - 25);
                $("#" + stepName).hide();
                $("#step" + (i - 1)).show();
                $(submmitButtonName).hide();
                selectStep(i - 1);
            });
        }

        function createNextButton(i) {
            var stepName = "step" + i;
            $("#" + stepName + "commands").append("<button  id='" + stepName + "Next' class='form-variable__button form-variable__saved link-theme-default' >" + BX.message('NEXT_TITLE') + " ></button>");
            $("#" + stepName + "Next").bind("click", function (e) {
                e.preventDefault();
                $("#progress").progressbar("option", "value", $("#progress").progressbar("option", "value") + 25);
                $("#" + stepName).hide();
                $("#step" + (i + 1)).show();
                if (i + 2 == count)
                    $(submmitButtonName).show();
                selectStep(i + 1);
            });
        }

        function selectStep(i) {
            $("#steps li").removeClass("current");
            $("#stepDesc" + i).addClass("current");
        }

        $("#progress").progressbar({
            change: function () {
                //update amount label when value changes
                $("#amount").text($("#progress").progressbar("option", "value") + "%");
            }
        });

        $("#step0Next").click(function () {
            var data = {
                'action': 'tostep2',
                'name': $('input[name=radio]:checked').val()
            };
            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: templateFolder + "/ajax/confirmSteps.php",
                    data: data,
                    success: function (data) {
                        $("#result2").html(data);
                    }
                });
            }, 2000);
        });

        $("#step1Next").click(function () {
            var data = {
                'action': 'tostep3',
                'regcode': $('#codr').attr('value'),
                'password': $('#pass').attr('value'),
                'check': $('#check').attr('value'),
            };
            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: templateFolder + "/ajax/confirmSteps.php",
                    data: data,
                    success: function (data) {
                        $("#result3").html(data);
                    }
                });
            }, 2000);
        });

        $("#step0Next").click(function () {
            $("#loading").show();
            $("fieldset").css('opacity', '0')
        });

        $("#step1Next").click(function () {
            $("#loading").show();
            $("fieldset").css('opacity', '0')
        });

        $("#loading").ajaxStop(function () {
            $(this).hide();
            $("fieldset").css('opacity', '1')
        });
    };
})(jQuery);