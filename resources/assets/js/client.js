/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */

function initClientValidation()
{
    $("form").materialid({
        fields:
        {
            name:{
                validators:{
                    notEmpty:{}
                }
            },
            nif:{
                validators:{
                    nif:{}
                }
            },
            email:{
                validators:{
                    email:{}
                }
            },
            phone:{
                validators:{
                    digits:{}
                }
            },
            mobile:{
                validators:{
                    digits:{}
                }
            },
            zip_code:{
                validators:{
                    length:{
                        exact:5,
                        msg:"Debe contener exactamente 5 caracteres"
                    }
                }
            },

        },
        config:{
            locale:"es_ES"
        }
    });
}