/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */

function initUserValidation()
{
    $("form").materialid({
        fields:
        {
            email:{
                validators:{
                    notEmpty:{},
                    email:{}
                }
            },
            password:{
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