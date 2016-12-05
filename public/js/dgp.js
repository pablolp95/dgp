/**
 * Created by pablo on 12/11/16.
 */
$(document).ready(function() {
    $('select').material_select();
    $('ul.tabs').tabs();
    $('.modal').modal();
});

function initClientValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            },
            nif: {
                validators: {
                    nif: {}
                }
            },
            email: {
                validators: {
                    email: {}
                }
            },
            phone: {
                validators: {
                    digits: {}
                }
            },
            mobile: {
                validators: {
                    digits: {}
                }
            },
            zip_code: {
                validators: {
                    length: {
                        exact: 5,
                        msg: "Debe contener exactamente 5 caracteres"
                    }
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initHome() {
    $(".button-collapse").sideNav()
}

function initInvoiceCreationHandlers() {
    function t(t) {
        s += parseInt(t.price), r == l - 1 && $("#total_amount").text(parseInt(s)), r++
    }

    function i() {
        var t = $("#percentage_discount").val(),
            i = $("#amount_discount").val(),
            a = s;
        "" != t && (a -= s * (t / 100)), "" != i && (a -= i), $("#total_amount").text(parseInt(a))
    }

    function a() {
        $.each(n, function(t, i) {
            "" != i && e(i, "producto")
        }), $.each(o, function(t, i) {
            "" != i && e(i, "servicio")
        })
    }

    function e(i, a) {
        $.ajax({
            url: "/api/" + a + "/" + i,
            method: "get",
            success: function(i) {
                t(i)
            },
            error: function(t, i, a) {
                404 == t.status && alert(a)
            }
        })
    }
    var n = $("#products_ids").val().split(","),
        o = $("#services_ids").val().split(","),
        s = 0,
        r = 0,
        l = 0;
    $("#get_total").click(function() {
        s = 0, r = 0, n = $("#products_ids").val().split(","), o = $("#services_ids").val().split(","), l = n.length + o.length, "" == n[0] && l--, "" == o[0] && l--, a()
    }), $("#apply_discounts").click(function() {
        i()
    })
}

function initInvoicingDataValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            },
            cliente_id: {
                validators: {
                    digits: {}
                }
            },
            aceptation_days: {
                validators: {
                    digits: {}
                }
            },
            percentage_discount: {
                validators: {
                    digits: {}
                }
            },
            amount_discount: {
                validators: {
                    numeric: {}
                }
            },
            e_nif: {
                validators: {
                    nif: {}
                }
            },
            r_nif: {
                validators: {
                    nif: {}
                }
            },
            e_zip_code: {
                validators: {
                    length: {
                        exact: 5,
                        msg: "Debe contener exactamente 5 caracteres"
                    }
                }
            },
            r_zip_code: {
                validators: {
                    length: {
                        exact: 5,
                        msg: "Debe contener exactamente 5 caracteres"
                    }
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initProductValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            },
            price: {
                validators: {
                    numeric: {},
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initProyectValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            },
            client_id: {
                validators: {
                    digits: {},
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initProyectAssociateInvoiceValidation() {
    $("form").materialid({
        fields: {
            invoice_id: {
                validators: {
                    digits: {},
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initProyectAssociateProposalValidation() {
    $("form").materialid({
        fields: {
            invoice_id: {
                validators: {
                    digits: {},
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initServiceValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            },
            price: {
                validators: {
                    numeric: {},
                    notEmpty: {}
                }
            },
            invoice_period: {
                validators: {
                    digits: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initTaxValidation() {
    $("form").materialid({
        fields: {
            name: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}

function initUserValidation() {
    $("form").materialid({
        fields: {
            email: {
                validators: {
                    notEmpty: {},
                    email: {}
                }
            },
            password: {
                validators: {
                    notEmpty: {}
                }
            }
        },
        config: {
            locale: "es_ES"
        }
    })
}
$("#country").change(function() {
    "ES" == $(this).find(":selected").val() ? ($("#state").parent().parent().fadeIn(), $(this).parent().parent().addClass("m6")) : ($("#state").parent().parent().hide(), $(this).parent().parent().removeClass("m6"))
}), $("#e_country").change(function() {
    "ES" == $(this).find(":selected").val() ? ($("#e_state").parent().parent().fadeIn(), $(this).parent().parent().addClass("m6")) : ($("#e_state").parent().parent().hide(), $(this).parent().parent().removeClass("m6"))
}), $("#r_country").change(function() {
    "ES" == $(this).find(":selected").val() ? ($("#r_state").parent().parent().fadeIn(), $(this).parent().parent().addClass("m6")) : ($("#r_state").parent().parent().hide(), $(this).parent().parent().removeClass("m6"))
});


//# sourceMappingURL=maps/ddsi.min.js.map