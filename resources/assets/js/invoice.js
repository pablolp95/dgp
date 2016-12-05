/**
 * Handcrafted with ♥ Beebit Solutions
 * Real coffee was used in this project development
 * Licensed under MIT License
 * contacto@beebit.es
 */

function initInvoiceCreationHandlers()
{
    var productos = $("#products_ids").val().split(',');
    var servicios = $("#services_ids").val().split(',');
    var amount = 0;
    var total_finished = 0;
    var total_queries = 0;

    $("#get_total").click(function()
    {
        amount = 0;
        total_finished = 0;
        productos = $("#products_ids").val().split(',');
        servicios = $("#services_ids").val().split(',');
        total_queries = productos.length + servicios.length;
        if(productos[0] == "")
            total_queries --;
        if(servicios[0] == "")
            total_queries --;

        updateAmountTotal();
    });

    $("#apply_discounts").click(function()
    {
        applyDiscounts();
    });

    function addToAmount(p)
    {
        amount += parseInt(p.price);
        if(total_finished == total_queries-1) {
            $("#total_amount").text(parseInt(amount));
        }
        total_finished++;

    }

    function applyDiscounts()
    {
        var percentage_discount = $("#percentage_discount").val();
        var amount_discount = $("#amount_discount").val();
        var discounted_amount = amount;

        if(percentage_discount != "")
            discounted_amount -= (amount*(percentage_discount/100));

        if(amount_discount != "")
            discounted_amount -= amount_discount;


        $("#total_amount").text(parseInt(discounted_amount));
    }

    function updateAmountTotal()
    {
        $.each(productos,function(k,v) {
            if(v != "")
                ajaxCallApi(v,"producto");
        });

        $.each(servicios,function(k,v){
            if(v != "")
                ajaxCallApi(v,"servicio");
        });
    }
    function ajaxCallApi(id,elem)
    {
        $.ajax({
            url:"/api/"+elem+"/"+id,
            method:"get",
            success:function(data) {
                addToAmount(data);
            },
            error:function (xhr, ajaxOptions, thrownError){
                if(xhr.status==404) {
                    alert(thrownError);
                }
            }
        })
    }
}

function initInvoicingDataValidation()
{
    $("form").materialid({
        fields:
        {
            name:{
                validators:{
                    notEmpty:{}
                }
            },
            cliente_id:{
                validators:{
                    digits:{}
                }
            },
            aceptation_days:{
                validators:{
                    digits:{}
                }
            },
            percentage_discount:{
                validators:{
                    digits:{}
                }
            },
            amount_discount:{
                validators:{
                    numeric:{}
                }
            },
            e_nif:{
                validators:{
                    nif:{}
                }
            },
            r_nif:{
                validators:{
                    nif:{}
                }
            },
            e_zip_code:{
                validators:{
                    length:{
                        exact:5,
                        msg:"Debe contener exactamente 5 caracteres"
                    }
                }
            },
            r_zip_code:{
                validators:{
                    length:{
                        exact:5,
                        msg:"Debe contener exactamente 5 caracteres"
                    }
                }
            }
        },
        config:{
            locale:"es_ES"
        }
    });
}




