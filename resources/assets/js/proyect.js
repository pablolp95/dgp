/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */

function initProyectValidation()
{
    $("form").materialid({
        fields:
        {
            name:{
                validators:{
                    notEmpty:{}
                }
            },
            client_id:{
                validators:{
                    digits:{},
                    notEmpty:{}
                }
            }
        },
        config:{
            locale:"es_ES"
        }
    });
}

function initProyectAssociateInvoiceValidation()
{
    $("form").materialid({
        fields:
        {
            invoice_id:{
                validators:{
                    digits:{},
                    notEmpty:{}
                }
            }
        },
        config:{
            locale:"es_ES"
        }
    });
}
function initProyectAssociateProposalValidation()
{
    $("form").materialid({
        fields:
        {
            invoice_id:{
                validators:{
                    digits:{},
                    notEmpty:{}
                }
            }
        },
        config:{
            locale:"es_ES"
        }
    });
}