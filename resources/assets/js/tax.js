/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */
function initTaxValidation()
{
    $("form").materialid({
        fields:
        {
            name:{
                validators:{
                    notEmpty:{}
                }
            }
        },
        config:{
            locale:"es_ES"
        }
    });
}