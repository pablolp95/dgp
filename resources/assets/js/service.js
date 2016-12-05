/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */

function initServiceValidation()
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
            },
            invoice_period:{
                validators:{
                    digits:{}
                }
            }
        },
        config:{
            locale:"es_ES"
        }
    });
}