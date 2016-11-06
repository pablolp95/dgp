/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */

$("#country").change(function()
{
    if($(this).find(":selected").val() == "ES") {
        $("#state").parent().parent().fadeIn();
        $(this).parent().parent().addClass("m6");
    } else {
        $("#state").parent().parent().hide();
        $(this).parent().parent().removeClass("m6");
    }
});
$("#e_country").change(function()
{
    if($(this).find(":selected").val() == "ES") {
        $("#e_state").parent().parent().fadeIn();
        $(this).parent().parent().addClass("m6");
    } else {
        $("#e_state").parent().parent().hide();
        $(this).parent().parent().removeClass("m6");
    }
});
$("#r_country").change(function()
{
    if($(this).find(":selected").val() == "ES") {
        $("#r_state").parent().parent().fadeIn();
        $(this).parent().parent().addClass("m6");
    } else {
        $("#r_state").parent().parent().hide();
        $(this).parent().parent().removeClass("m6");
    }
});