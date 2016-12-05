/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */

function initProductValidation()
{
    $("form").materialid({
        fields:
        {
            name:{
                validators:{
                    notEmpty:{}
                }
            },
            price:{
                validators:{
                    numeric:{},
                    notEmpty:{}
                }
            }
        },
        config:{
            locale:"es_ES"
        }
    });
}